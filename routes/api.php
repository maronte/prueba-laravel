<?php

use Illuminate\Http\Request;
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

// Corporativos
Route::apiResource('corporativos', 'CorporativoController');

// Empresas
Route::apiResource('empresas', 'EmpresaController')->except('store');

Route::apiResource('corporativos.empresas', 'CorporativoEmpresaController')->only('store');

// Contactos
Route::apiResource('contactos', 'ContactoController')->except('store');

Route::apiResource('corporativos.contactos', 'CorporativoContactoController')->only('store');

// Documentos