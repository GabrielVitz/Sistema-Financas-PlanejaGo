<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create () {
        return view('auth.create');
    }

    public function store (Request $request) {
        $data = $request->validate([
            'name' => 'required|min:3',
            'data_nascimento' => 'required|date',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ], [
            'name.min'                  => 'Insira um nome maior que 3 caracteres',
            'name.required'             => 'Esse campo é obrigatório',
            'data_nascimento.required'  => 'Informe uma data',
            'data_nascimento.date'      => 'Informe uma data válida',
            'email.required'            => 'Esse campo de Email é obrigatório',
            'email.email'               => 'Insira um Email valido',
            'email.unique'              => 'Já existe alguém cadastrado com esse email',
            'password.required'         => 'A senha é um Campo obrigatório',
            'password.min'              => 'A senha deve ter no mínimo 8 caracteres',
            'password_confirmation'     => 'Digite a mesma senha',
        ]);
        
        $user = User::create([
            'name' => $data['name'],
            'data_nascimento' => $data['data_nascimento'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'log_data_inclusao' => Carbon::now(),
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('user.dashboard')->with('success', 'Cadastro realizado e logado com sucesso!');
    }
}
