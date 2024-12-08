<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/**
 * 
 * 
 * MODULO DE AREA
 * 
 * 
 */

// Ruta para mostrar el Dashboard
Route::get('admin/indexArea', [AreaController::class, 'index'])->name('indexArea');

// Ruta para mostrar el formulario de crear un nuevo registro
Route::get('admin/createArea', [AreaController::class, 'create'])->name('createArea');

// Ruta para guardar la informacion en la DB
Route::post('admin/storeArea',[AreaController::class,'store'])->name('storeArea');

/**
 * 
 * 
 * MODULO DE USUARIOS
 * 
 * 
 */

// Ruta para mostrar el Dashboard
Route::get('admin/indexUsuario',[UsuarioController::class, 'index'])->name('indexUsuario');

// Ruta para crear usuarios
Route::get('admin/createUsuario',[UsuarioController::class, 'create'])->name('createUsuario');

// Ruta para guardar la informacion en la DB
Route::post('admin/storeUsuario',[UsuarioController::class, 'store'])->name('storeUsuario');

// Ruta para mostrar los detalles del usuario
Route::get('admin/showUsuario/{id}',[UsuarioController::class, 'show'])->name('showUsuario');

// Ruta para editar los datos del usuario
Route::get('admin/editUsuario/{id}',[UsuarioController::class, 'edit'])->name('editUsuario');

// Ruta para actualizar los datos del usuario
Route::put('admin/updateUsuario/{id}',[UsuarioController::class,'update'])->name('updateUsuario');

// Ruta para eliminar un usuario
Route::get('admin/deteleUser/{id}',[UsuarioController::class,'delete'])->name('deleteUsuario');


/**
 * 
 * 
 * MODULO DE CREACION DE DOCUMENTOS
 * 
 * 
 */

 // Ruta para mostrar el dashboard
Route::get('admin/indexDocumento',[DocumentoController::class,'index'])->name('indexDocumento');

// Ruta para crear un nuevo documento
Route::get('admin/createDocumento',[DocumentoController::class,'create'])->name('createDocumento');

// Ruta para guardar la informacion en la DB
Route::post('admin/storeDocumento',[DocumentoController::class,'store'])->name('storeDocumento');

// Ruta para mostrrar los detalles del documento
Route::get('admin/showDocumento/{id}',[DocumentoController::class,'show'])->name('showDocumento');

// Ruta para generar el PDF
Route::get('admin/pdfDocumento/{id}', [DocumentoController::class, 'pdf'])->name('pdfDocumento');

// Ruta para foirmar el documento
Route::post('admin/firmarDocumento', [DocumentoController::class, 'firmar'])->name('firmarDocumento');

// Ruta para mostrar los documentos pendientes de firma
Route::get('admin/pendientesFirmarDocumento',[DocumentoController::class, 'pendientesFirmar'])->name('pendientesFirmarDocumento');