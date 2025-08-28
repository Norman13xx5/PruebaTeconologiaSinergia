<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SelectController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::controller(PatientController::class)->group(function () {
        Route::post('/pacientes', 'create');
        Route::get('/pacientes/{id}', 'show');
        Route::put('/pacientes/{id}', 'update');
        Route::patch('/pacientes/{id}', 'edit');
        Route::delete('/pacientes/{id}', 'destroy');
    });


    Route::controller(UserController::class)->group(function () {
        Route::post('/usuarios', 'create');
        Route::get('/usuarios/{id}', 'show');
        Route::put('/usuarios/{id}', 'update');
        Route::patch('/usuarios/{id}', 'edit');
        Route::delete('/usuarios/{id}', 'destroy');
    });

    Route::controller(SelectController::class)->group(function () {
        Route::get('/select/typesids', 'typeidAll');
        Route::get('/select/genres', 'genreAll');
        Route::get('/select/departments', 'departmentAll');
        Route::get('/select/municipalities', 'municipalitytAll');
        Route::get('/select/municipality/{id}', 'municipality');
        Route::get('/select/roles', 'rolAll');
        Route::get('/select/category', 'categoryAll');
        Route::get('/select/tp-maquinarias', 'tpMaquinariaAll');
        Route::get('/select/maquinarias', 'maquinariaAll');
        Route::get('/select/contratos', 'contratoAll');
        Route::get('/select/rutas', 'rutaAll');
        Route::get('/select/materiales', 'materialAll');
    });
});