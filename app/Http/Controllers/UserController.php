<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

    public function delete($id) {
        User::findOrFail($id)->delete();
        return back();
    }
    

}