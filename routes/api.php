<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RolController;
use App\Http\Controllers\Api\EmpresaController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ContratoController;
use App\Http\Controllers\Api\MaquinariaController;
use App\Http\Controllers\Api\MaterialController;
use App\Http\Controllers\Api\RutaController;
use App\Http\Controllers\Api\AcuerdoAlquilerController;
use App\Http\Controllers\Api\AcuerdoFletesController;
use App\Http\Controllers\Api\AcuerdoMovimientosController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\RegistroController;
use App\Http\Controllers\Api\SelectController;
use App\Http\Controllers\Api\InformeController;
use App\Http\Controllers\Api\SalaryController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::controller(RolController::class)->group(function () {
        Route::post('/roles', 'create');
        Route::get('/roles/{id}', 'show');
        Route::put('/roles/{id}', 'update');
        Route::patch('/roles/{id}', 'edit');
        Route::delete('/roles/{id}', 'destroy');
    });


    Route::controller(EmpresaController::class)->group(function () {
        Route::post('/empresas', 'create');
        Route::get('/empresas/{nit}', 'show');
        Route::put('/empresas/{nit}', 'update');
        Route::patch('/empresas/{nit}', 'edit');
        Route::delete('/empresas/{nit}', 'destroy');
    });

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


    Route::controller(ContratoController::class)->group(function () {
        Route::post('/contratos', 'create');
        Route::get('/contratos/{id}', 'show');
        Route::put('/contratos/{id}', 'update');
        Route::patch('/contratos/{id}', 'edit');
        Route::delete('/contratos/{id}', 'destroy');
    });


    Route::controller(MaquinariaController::class)->group(function () {
        Route::post('/maquinarias', 'create');
        Route::get('/maquinarias/{id}', 'show');
        Route::put('/maquinarias/{id}', 'update');
        Route::patch('/maquinarias/{id}', 'edit');
        Route::delete('/maquinarias/{id}', 'destroy');
    });


    Route::controller(MaterialController::class)->group(function () {
        Route::post('/materiales', 'create');
        Route::get('/materiales/{id}', 'show');
        Route::put('/materiales/{id}', 'update');
        Route::patch('/materiales/{id}', 'edit');
        Route::delete('/materiales/{id}', 'destroy');
    });


    Route::controller(RutaController::class)->group(function () {
        Route::post('/rutas', 'create');
        Route::get('/rutas/{id}', 'show');
        Route::put('/rutas/{id}', 'update');
        Route::patch('/rutas/{id}', 'edit');
        Route::delete('/rutas/{id}', 'destroy');
    });


    Route::controller(AcuerdoAlquilerController::class)->group(function () {
        Route::post('/acuerdos/alquiler', 'create');
        Route::get('/acuerdos/alquiler/{id}', 'show');
        Route::put('/acuerdos/alquiler/{id}', 'update');
        Route::patch('/acuerdos/alquiler/{id}', 'edit');
        Route::delete('/acuerdos/alquiler/{id}', 'destroy');
    });


    Route::controller(AcuerdoFletesController::class)->group(function () {
        Route::post('/acuerdos/fletes', 'create');
        Route::get('/acuerdos/fletes/{id}', 'show');
        Route::put('/acuerdos/fletes/{id}', 'update');
        Route::patch('/acuerdos/fletes/{id}', 'edit');
        Route::delete('/acuerdos/fletes/{id}', 'destroy');
    });


    Route::controller(AcuerdoMovimientosController::class)->group(function () {
        Route::post('/movimientos/fletes', 'create');
        Route::get('/movimientos/fletes/{id}', 'show');
        Route::put('/movimientos/fletes/{id}', 'update');
        Route::patch('/movimientos/fletes/{id}', 'edit');
        Route::delete('/movimientos/fletes/{id}', 'destroy');
    });


    Route::controller(RegistroController::class)->group(function () {
        Route::post('/registros', 'create');
        Route::get('/registros/{id}', 'show');
        Route::put('/registros/{id}', 'update');
        Route::patch('/registros/{id}', 'edit');
        Route::delete('/registros/{id}', 'destroy');
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

    Route::controller(InformeController::class)->group(function () {
        Route::post('/informes/alquiler', 'alquilerExcel');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::post('/category', 'create');
        Route::get('/category/{id}', 'show');
        Route::put('/category/{id}', 'update');
        Route::patch('/category/{id}', 'edit');
        Route::delete('/category/{id}', 'destroy');
    });

    Route::controller(SalaryController::class)->group(function () {
        Route::post('/salarios', 'create');
        Route::get('/salarios/{id}', 'show');
        Route::put('/salarios/{id}', 'update');
        Route::patch('/salarios/{id}', 'edit');
        Route::delete('/salarios/{id}', 'destroy');
    });

    Route::controller(ExpenseController::class)->group(function () {
        Route::post('/gastos', 'create');
        Route::get('/gastos/{id}', 'index');
        Route::get('/gasto/{id}', 'show');
        Route::put('/gastos/{id}', 'update');
        Route::patch('/gastos/{id}', 'edit');
        Route::delete('/gastos/{id}', 'destroy');
    });
});