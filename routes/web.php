<?php

use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/empleados', function (){
//     return view('empleados.index');
// });

// //             ruta que se digitará                 clase         funcion en el navegador
// Route::get('empleado/create', [EmpleadoController::class, 'create']);

// Nos permite acceder a todas las clases del controlador empleado
Route::resource('empleados', EmpleadoController::class)->middleware('auth');

// quitar opción de registro y recordar contraseña
Auth::routes(['register'=>false, 'reset'=>false]);

Route::get('/home', [EmpleadoController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'], function (){
    Route::get('/', [EmpleadoController::class, 'index'])->name('home');
});