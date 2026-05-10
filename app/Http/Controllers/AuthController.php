<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function showLogin() {
        return view('login');
    }

    public function showRegister() {
        return view('register');
    }

    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6'
    ],[
        'name.required' => 'El nombre es obligatorio',
        'name.max' => 'El nombre no puede tener más de 100 caracteres',

        'email.required' => 'El correo es obligatorio',
        'email.email' => 'El correo no es válido',
        'email.unique' => 'Este correo ya está registrado',

        'password.required' => 'La contraseña es obligatoria',
        'password.min' => 'La contraseña debe tener al menos 6 caracteres'
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password,
        'failed_attempts' => 0,
        'role' => 'user'
        
    ]);
    $account = Account::create([
        'user_id' => $user->id,
        'account_number' => rand(10000000, 99999999),
        'balance' => 100
    ]);
        

    return redirect('/login');
}

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where(
            'email',
            $request->email
        )->first();

        if (!$user) {

            return back()->with(
                'error',
                'Usuario no existe'
            );
        }

        if (
            $user->lock_until &&
            now()->lt($user->lock_until)
        ) {

            return back()->with(
                'error',
                'Cuenta bloqueada temporalmente'
            );
        }

        if (
            Auth::attempt(
                $credentials,
                $request->has('remember')
            )
        ) {

            $request->session()->regenerate();

            $user->failed_attempts = 0;
            $user->lock_until = null;

            $user->save();

            return redirect('/dashboard')
                ->with(
                    'success',
                    'Bienvenido/a de nuevo'
                );
        }

        $user->failed_attempts++;

        if ($user->failed_attempts >= 3) {

            $user->lock_until =
                now()->addMinutes(5);
        }

        $user->save();

        return back()->with(
            'error',
            'Credenciales incorrectas'
        );
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}