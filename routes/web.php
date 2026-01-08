<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\DocumentoRecibidoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*******************************************************************************************
 * 
 * 
 * RUTA DE BIENVENIDA
 * 
 * 
 ******************************************************************************************/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function () {
    return redirect()->route('login');
});

/*******************************************************************************************
 * 
 * 
 * PROTEGEMOS TODAS LAS RUTAS
 * 
 * 
 ******************************************************************************************/

 Auth::routes([
    'register' => false, // Desactiva el registro de nuevos usuarios
    'reset' => false, // Desactiva la recuperación de contraseña
    'verify' => false,   // Desactiva la verificación de email
]);

/*******************************************************************************************
 * 
 * 
 * PROTEGEMOS TODAS LAS RUTAS
 * 
 * 
 ******************************************************************************************/

Route::middleware(['auth'])->group(function () 
{

  Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

  /*******************************************************************************************
   * 
   * 
   * MODULO DE AREA
   * 
   * 
   ******************************************************************************************/

  // Ruta para mostrar el Dashboard
  Route::get('admin/indexArea', [AreaController::class, 'index'])->name('indexArea');

  // Ruta para mostrar el formulario de crear un nuevo registro
  Route::get('admin/createArea', [AreaController::class, 'create'])->name('createArea');

  // Ruta para guardar la informacion en la DB
  Route::post('admin/storeArea',[AreaController::class,'store'])->name('storeArea');

  // Ruta para mostrar los datos del registro
  Route::get('admin/showArea/{id}',[AreaController::class,'show'])->name('showArea');

  // Ruta para editar los datos 
  Route::get('admin/editArea/{id}',[AreaController::class,'edit'])->name('editArea');

  // Ruta para actualizar los datos
  Route::put('admin/updateArea/{id}',[AreaController::class,'update'])->name('updateArea');

  // Ruta para eliminar los datos
  Route::get('admin/deleteArea/{id}',[AreaController::class,'delete'])->name('deleteArea');

  /*******************************************************************************************
   * 
   * 
   * MODULO DE USUARIOS
   * 
   * 
   ******************************************************************************************/

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

  // Ruta para mostrar el perfil del Usuario
  Route::get('admin/usuarios/miPerfil/{id}',[UsuarioController::class,'miPerfil'])->name('miPerfil');


  /*******************************************************************************************
   * 
   * 
   * MODULO DE DOCUMENTOS
   * 
   * 
    ******************************************************************************************/

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
  Route::put('admin/firmarDocumento/{id}', [DocumentoController::class, 'firmar'])->name('firmarDocumento');

  // Ruta para mostrar los documentos pendientes de firma
  Route::get('admin/pendientesFirmarDocumento',[DocumentoController::class, 'pendientesFirmar'])->name('pendientesFirmarDocumento');

  // Ruta para mostrar los documentos que el usuario que inicio sesion redacto
  Route::get('admin/misDocumentos',[DocumentoController::class, 'misDocumentos'])->name('misDocumentos');

  
  /*******************************************************************************************
   * 
   * 
   * DOCUMENTOS RECIBIDOS
   * 
   * 
    ******************************************************************************************/

  Route::get('admin/documentosRecibidos',[DocumentoRecibidoController::class, 'documentosRecibidos'])->name('documentosRecibidos');

  Route::get('admin/documentosRecibidosTurnados',[DocumentoRecibidoController::class, 'documentosRecibidosTurnados'])->name('documentosRecibidosTurnados');

  Route::get('admin/documentosRecibidosTurnadosRespuestaCreate/{id}',[DocumentoRecibidoController::class, 'documentosRecibidosTurnadosRespuestaCreate'])->name('documentosRecibidosTurnadosRespuestaCreate');

  Route::put('admin/documentosRecibidosTurnadosRespuestaStore/{id}',[DocumentoRecibidoController::class, 'documentosRecibidosTurnadosRespuestaStore'])->name('documentosRecibidosTurnadosRespuestaStore');

  Route::get('admin/documentosRecibidosAtendidos',[DocumentoRecibidoController::class, 'documentosRecibidosAtendidos'])->name('documentosRecibidosAtendidos');

  Route::get('admin/documentosRecibidosCreate',[DocumentoRecibidoController::class, 'documentosRecibidosCreate'])->name('documentosRecibidosCreate');

  Route::post('admin/documentosRecibidosStore',[DocumentoRecibidoController::class, 'documentosRecibidosStore'])->name('documentosRecibidosStore');

  Route::get('admin/documentosRecibidosTurnar/{id}',[DocumentoRecibidoController::class, 'documentosRecibidosTurnar'])->name('documentosRecibidosTurnar');

  Route::post('admin/documentosRecibidosTurnarStore/{id}',[DocumentoRecibidoController::class, 'documentosRecibidosTurnarStore'])->name('documentosRecibidosTurnarStore');

  Route::get('admin/documentosRecibidosCargar/{id}',[DocumentoRecibidoController::class, 'documentosRecibidosCargar'])->name('documentosRecibidosCargar');

  Route::put('admin/documentosRecibidosCargarStore/{id}',[DocumentoRecibidoController::class, 'documentosRecibidosCargarStore'])->name('documentosRecibidosCargarStore');

  Route::get('admin/documentosRecibidosShow/{id}',[DocumentoRecibidoController::class, 'documentosRecibidosShow'])->name('documentosRecibidosShow');

  Route::get('documentos-recibidos/{id}/ver',[DocumentoRecibidoController::class, 'verDocumento'])->name('verDocumento');

  Route::get('documentos-recibidos-respuesta/{id}/ver',[DocumentoRecibidoController::class, 'verDocumentoRespuesta'])->name('verDocumentoRespuesta');


  /*******************************************************************************************
   * 
   * 
   * CONFIGURACION PARA TITULAR DE UNIDAD
   * 
   * 
    ******************************************************************************************/

  // Ruta para mostrar las jefaturas a su cargo
  Route::get('admin/miUnidad',[AreaController::class,'miUnidad'])->name('miUnidad');

});

