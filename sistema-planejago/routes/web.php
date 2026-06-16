<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LancamentoController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\UserController;

// 1. Tela de apresentação / Landing Page (Pública)
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. Rotas para usuários NÃO logados (Visitantes - Criação de conta e Login)
Route::middleware('guest')->group(function () {

    Route::controller(LoginController::class)->group(function() {
        Route::get('/auth/login', 'index')->name('login');
        Route::post('/login', 'store')->name('login.store');
    });

    Route::get('/auth/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    
});

// 3. Rotas de autenticação (Usuários Logados)
Route::middleware('auth')->group(function () {
    
    // Rotas gerais do usuário
    Route::get('/home', [LoginController::class, 'index'])->name('user.home');
    Route::post('/logout', [LoginController::class, 'destroy'])->name('login.destroy');

    // Dashboard
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('user.dashboard');

    // Calculadora (Sem código repetido)
    Route::get('/calculadora', function () {
        return view('home.calculadora');
    })->name('calculadora');

    // Lançamentos
    Route::prefix('lancamentos')->controller(LancamentoController::class)->group(function () {
        Route::get('/', 'index')->name('user.lancamentos');
        Route::delete('/deletar/{id}', 'deletar')->name('lancamentos.deletar');
        
        // Despesas
        Route::post('/despesa', 'criaDespesa')->name('lancamentos.criaDespesa');
        Route::post('/atualizar-status/{id}', 'atualizarStatus')->name('lancamentos.atualizarStatus');
        Route::post('/despesa/editar/{id}', 'editarDespesa')->name('lancamentos.editarDespesa');
        Route::post('/despesa/ver/{id}', 'verDespesa')->name('lancamentos.verDespesa');
        
        // Receitas
        Route::post('/receita', 'criaReceita')->name('lancamentos.criaReceita');
        Route::post('/receita/editar/{id}', 'editarReceita')->name('lancamentos.editarReceita');
        Route::post('/receita/ver/{id}', 'verReceita')->name('lancamentos.verReceita');
    });

    // Relatório
    Route::get('/relatorio', [RelatorioController::class, 'index'])->name('relatorio.index');
});