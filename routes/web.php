<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PainelController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::controller(SiteController::class)->group(function () {
    Route::get('/', 'home');
    Route::get('/site', 'home');
    Route::get('/jogos', 'jogos');
    Route::get('/noticias', 'noticias');
    Route::get('/noticias/{chave}', 'noticiasbyid');
    Route::get('/galeria/{chave}', 'galeriabyid');
    Route::get('/classificacao', 'classificacao');
    Route::get('/classificacao/{chave}', 'classificacaobyid');

//    Route::put('/cadastro/salvar', 'salvarCadastro');
//    Route::get('/definirperfil', 'definirPerfil');
//    Route::get('/usuario/definirPerfil/{chave}', 'salvarDefinirPerfil');
//    Route::get('/usuario/definirPerfilInicial/{chave}', 'salvarDefinirPerfilInicial');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/auth/login', 'login');
    Route::put('/auth/login', 'logar');
    Route::get('/auth/logout', 'deslogar');
});

Route::controller(PainelController::class)->group(function () {
    Route::get('/painel/', 'geral');
    Route::get('/painel/geral', 'geral');
    Route::get('/painel/noticias', 'noticias');
    Route::get('/painel/noticias/{chave}', 'noticiasbyid');
    Route::get('/painel/jogos', 'jogos');
});
