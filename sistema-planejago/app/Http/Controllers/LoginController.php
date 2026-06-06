<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lancamento;

class LoginController extends Controller
{
    public function index () {
        return view('auth.login');
    }

    public function store (Request $request) {
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Esse campo de Email é obrigatório',
            'email.email' => 'Insira um Email valido',
            'password' => 'A senha é um Campo obrigatório'
        ]);

        $credentials = $request->only('email', 'password');
       
     if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            return redirect()->intended(route('user.dashboard'));
        }

        return back()->withErrors([
            'error' => 'Email ou senha inválidos'
        ])->onlyInput('email');
    }

    public function destroy (Request $request) {
        Auth::logout();

        // $request->session->invalidation();
        // $request->session->regenerateToken();

        return redirect()->route('login.index');
    }
}
