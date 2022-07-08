<?php

use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Controle dos endereços
Route::apiResource('enderecos', AddressController::class);

//Busca por CEP
Route::get('/enderecos/busca-cep/{cep}', AddressController::class.'@busca');

//Busca por logradouro
Route::get('/busca-enderecos/rua/{street?}', AddressController::class.'@buscaLogradouro');
