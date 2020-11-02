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
Route::post('empresas/corporativos/{corporativo}', 'EmpresaController@store');

Route::apiResource('empresas', 'EmpresaController')->except('store');

// Contactos
Route::post('contactos/corporativos/{corporativo}', 'ContactoController@store');

Route::apiResource('contactos', 'ContactoController')->except('store');

// Documentos
Route::post('documentos/corporativos/{corporativo}', 'DocumentoController@store');

Route::apiResource('documentos', 'DocumentoController')->except('store');

// Documentos archivos
Route::post('documentoarchivos/corporativos/{corporativo}/documentos/{documento}', 
            'DocumentoArchivoController@store');

Route::apiResource('documentoarchivos', 'DocumentoArchivoController')->only(['update', 'destroy']); 