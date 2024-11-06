<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::controller(SiteController::class)->group(function () {
    Route::get('/', 'home');
    Route::get('/site', 'home');
    Route::get('/noticias', 'noticias');
    Route::get('/noticias/{chave}', 'noticiasbyid');
    Route::get('/classificacao', 'classificacao');
    Route::get('/classificacao/{chave}', 'classificacaobyid');

//    Route::put('/cadastro/salvar', 'salvarCadastro');
//    Route::get('/definirperfil', 'definirPerfil');
//    Route::get('/usuario/definirPerfil/{chave}', 'salvarDefinirPerfil');
//    Route::get('/usuario/definirPerfilInicial/{chave}', 'salvarDefinirPerfilInicial');
});
