<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;


// Home inicial
Route::get('/', [HomeController::class, 'index'])->name('home');

// Página pública de notícia individual
// Usada em: route('noticias.show', $noticia)
Route::get('/noticias/{noticia}', [NoticiaController::class, 'show'])
    ->name('noticias.show');

// Página de Livros
Route::view('/livros', 'livros')->name('livros');

// Login / Logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


//login

Route::middleware('auth_fake')->group(function () {

    // Editar Home
    Route::get('/home/editar', [HomeController::class, 'edit'])->name('home.edit');
    Route::post('/home/editar', [HomeController::class, 'update'])->name('home.update');

    // ✅ LISTA DE USUÁRIOS
    //Route::get('/usuarios', [UsuarioController::class, 'index'])
      //  ->name('usuarios.index');

    // ✅ FORMULÁRIO DE CRIAÇÃO
    Route::get('/usuarios/novo', [UsuarioController::class, 'create'])
        ->name('usuarios.create');

    // ✅ RECEBE O FORM E GRAVA NO BANCO
    Route::post('/usuarios', [UsuarioController::class, 'store'])
        ->name('usuarios.store');
});

