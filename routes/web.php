<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::controller(SiteController::class)->group(function () {
    Route::get('/', 'home');
    Route::put('/site', 'home');
    Route::put('/noticias', 'noticias');
    Route::put('/noticias/{chave}', 'noticiasbyid');
    Route::put('/classificacao', 'classificacao');
    Route::put('/classificacao/{chave}', 'classificacaobyid');

//    Route::put('/cadastro/salvar', 'salvarCadastro');
//    Route::get('/definirperfil', 'definirPerfil');
//    Route::get('/usuario/definirPerfil/{chave}', 'salvarDefinirPerfil');
//    Route::get('/usuario/definirPerfilInicial/{chave}', 'salvarDefinirPerfilInicial');
});
