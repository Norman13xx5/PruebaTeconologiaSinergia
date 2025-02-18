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

    Route::get('/permisos/{rol}/{id}', function ($rol, $id) {
        return view('cuentas/roles/permisos', compact('rol', 'id'));
    })->name('permisos');

    Route::get('/acuerdos', function () {
        return view('operaciones/acuerdos/acuerdos');
    })->name('acuerdos');

    // Route::get('/registros', function () {
    //     return view('operaciones/registros/registros');
    // })->name('registros');

    // Route::get('/informes', function () {
    //     return view('operaciones/informes/informes');
    // })->name('informes');

    // // Rutas de Serverside protegidas
    // Route::get('/roles', [RolController::class, 'index'])->name('roles');
    Route::get('/pacientes', [EmpresaController::class, 'index'])->name('pacientes');
    // Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios');
    // Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    // Route::get('/contratos', [ContratoController::class, 'index'])->name('contratos');
    // Route::get('/maquinarias', [MaquinariaController::class, 'index'])->name('maquinarias');
    // Route::get('/materiales', [MaterialController::class, 'index'])->name('materiales');
    // Route::get('/rutas', [RutaController::class, 'index'])->name('rutas');
    // Route::get('/acuerdos/clientes/alquiler', [AcuerdoController::class, 'alquilerCliente'])->name('acuerdos.clientes.alquiler');
    // Route::get('/acuerdos/proveedores/alquiler', [AcuerdoController::class, 'alquilerProveedor'])->name('acuerdos.proveedores.alquiler');
    // Route::get('/acuerdos/clientes/fletes', [AcuerdoController::class, 'fleteCliente'])->name('acuerdos.clientes.fletes');
    // Route::get('/acuerdos/proveedores/fletes', [AcuerdoController::class, 'fleteProveedor'])->name('acuerdos.proveedores.fletes');
    // Route::get('/acuerdos/clientes/movimientos', [AcuerdoController::class, 'movimientoCliente'])->name('acuerdos.clientes.movimientos');
    // Route::get('/acuerdos/proveedores/movimientos', [AcuerdoController::class, 'movimientoProveedor'])->name('acuerdos.proveedores.movimientos');
    // Route::get('/registros/alquiler', [RegistroController::class, 'alquiler'])->name('registros.alquiler');
    // Route::get('/registros/fletes', [RegistroController::class, 'flete'])->name('registros.fletes');
    // Route::get('/registros/movimientos', [RegistroController::class, 'movimiento'])->name('registros.movimientos');
    // Route::get('/salarios', [SalaryController::class, 'index'])->name('salarios');
    // Route::get('/categorias', [CategoryController::class, 'index'])->name('categorias');
    // Route::get('/gastos/{id}', [ExpenseController::class, 'index'])->name('gastos');
});