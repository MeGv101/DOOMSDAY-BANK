<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Account;

class UserController extends Controller{

    public function index() {
        $users = User::where('role', '!=', 'admin')->get();
        return view('users.index', compact('users'));
    }
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ], [
            'name.required' => 'El nombre es obligatorio',
            'email.required' => 'El correo es obligatorio',
            'email.unique' => 'El correo ya existe',
            'password.min' => 'Mínimo 6 caracteres'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'user'
        ]);

        $account = Account::create([
            'user_id' => $user->id,
            'account_number' => rand(10000000, 99999999),
            'balance' => 100
        ]);
        return redirect('/users')->with('success', 'Usuario creado');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $account = Account::where('user_id', $user->id)->first();
        return view('users.edit', compact('user', 'account'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|max:100',

            'email' =>
                'required|email|unique:users,email,' . $user->id,

            'balance' => 'required|numeric|min:0',

            'account_number' => 'required'
        ], [

            'name.required' =>
                'El nombre es obligatorio',

            'name.max' =>
                'Máximo 100 caracteres',

            'email.required' =>
                'El correo es obligatorio',

            'email.email' =>
                'Correo inválido',

            'email.unique' =>
                'Ese correo ya está registrado',

            'balance.required' =>
                'El saldo es obligatorio',

            'balance.numeric' =>
                'El saldo debe ser numérico',

            'balance.min' =>
                'El saldo no puede ser negativo',

            'account_number.required' =>
                'El número de cuenta es obligatorio'
        ]);

        $user->name = $request->name;

        $user->email = $request->email;

        $user->save();

        $account = Account::where(
            'user_id',
            $user->id
        )->first();

        $account->balance = $request->balance;

        $account->account_number =
            $request->account_number;

        $account->save();

        return redirect('/users')
            ->with(
                'success',
                'Usuario actualizado correctamente'
            );
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        $account = Account::where(
            'user_id',
            $user->id
        )->first();

        if ($account) {

            Transaction::where(
                'account_id',
                $account->id
            )->delete();

            $account->delete();
        }

        $user->delete();

        return back()->with(
            'success',
            'Usuario eliminado'
        );
    }
    

}