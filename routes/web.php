<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\web\PatientController;


Route::get('/', function () {
    return view('login/login');
})->name('login');

Route::middleware(['auth:sanctum', 'check.api.token'])->group(function () {

    // Rutas de vistas protegidas
    Route::get('/home', function () {
        return view('home/home');
    })->name('home');

    Route::get('/pacientes', [PatientController::class, 'index'])->name('pacientes');

});