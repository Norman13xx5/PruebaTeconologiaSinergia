<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\web\RolController;
use App\Http\Controllers\web\EmpresaController;
use App\Http\Controllers\web\UserController;
use App\Http\Controllers\web\ContratoController;
use App\Http\Controllers\web\MaquinariaController;
use App\Http\Controllers\web\MaterialController;
use App\Http\Controllers\web\RutaController;
use App\Http\Controllers\web\AcuerdoController;
use App\Http\Controllers\web\RegistroController;
use App\Http\Controllers\web\SalaryController;
use App\Http\Controllers\web\CategoryController;
use App\Http\Controllers\web\ExpenseController;


Route::get('/', function () {
    return view('login/login');
})->name('login');

Route::middleware(['auth:sanctum', 'check.api.token'])->group(function () {

    // Rutas de vistas protegidas
    Route::get('/home', function () {
        return view('home/home');
    })->name('home');

    // Route::get('/permisos/{rol}/{id}', function ($rol, $id) {
    //     return view('cuentas/roles/permisos', compact('rol', 'id'));
    // })->name('permisos');

    // Route::get('/acuerdos', function () {
    //     return view('operaciones/acuerdos/acuerdos');
    // })->name('acuerdos');
    Route::get('/pacientes', [EmpresaController::class, 'index'])->name('pacientes');

});