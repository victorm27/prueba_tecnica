<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('empleados.index');
});

Route::resource('empleados', App\Http\Controllers\EmpleadoController::class);
Route::resource('areas', App\Http\Controllers\AreaController::class);
Route::resource('roles', App\Http\Controllers\RolController::class);
