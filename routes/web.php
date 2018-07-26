<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','Auth\LoginController@showLoginForm')->middleware('guest');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');




Route::middleware(['auth'])->group(function(){
  //Roles
  Route::post('roles/store', 'RoleController@store')->name('roles.store')->middleware('permission:roles.create');
  Route::get('roles', 'RoleController@index')->name('roles.index')->middleware('permission:roles.index');
  Route::get('roles/create', 'RoleController@create')->name('roles.create')->middleware('permission:roles.create');
  Route::put('roles/{role}', 'RoleController@update')->name('roles.update')->middleware('permission:roles.edit');
  Route::get('roles/{role}', 'RoleController@show')->name('roles.show')->middleware('permission:roles.show');
  Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy')->middleware('permission:roles.destroy');
  Route::get('roles/{role}', 'RoleController@edit')->name('roles.edit')->middleware('permission:roles.edit');

  //Justificaciones
  Route::post('alumno/store', 'JustificacionController@store')->name('justificacion.store')->middleware('permission:justificacion.create');
  //Route::get('justificaciones', 'JustificacionController@index')->name('justificacion.index')->middleware('permission:roles.index');
  Route::get('alumno/create', 'JustificacionController@create')->name('justificacion.create')->middleware('permission:justificacion.create');
  Route::put('justificaciones/{role}', 'JustificacionController@update')->name('justificacion.update')->middleware('permission:justificacion.edit');
  Route::get('justificaciones/{role}', 'JustificacionController@show')->name('justificacion.show')->middleware('permission:justificacion.show');
  Route::get('justificaciones/{role}', 'JustificacionController@edit')->name('justificacion.edit')->middleware('permission:justificacion.edit');

  //Usuarios

  Route::get('users', 'UserController@index')->name('users.index')->middleware('permission:users.index');
  Route::put('users/{role}', 'UserCon troller@update')->name('users.update')->middleware('permission:users.edit');
  Route::get('users/{role}', 'UserController@show')->name('users.show')->middleware('permission:users.show');
  Route::get('users/{role}', 'UserController@edit')->name('users.edit')->middleware('permission:users.edit');

});







//-----------------------------------------------RUTAS DEL ADMINISTRADOR-----------------------------------------------------

Route::get('/administrador/index', function () {
    return view('administrador.index');
});

Route::get('/administrador/registroCoordinadores', function () {
    return view('administrador.registroCoordinadores');
});

Route::get('/administrador/perfil', function () {
    return view('administrador.perfil');
});

Route::get('/administrador/estadisticas1', function () {
    return view('administrador.estadisticas1');
});

Route::get('/administrador/estadisticas2', function () {
    return view('administrador.estadisticas2');
});

Route::get('/administrador/estadisticas3', function () {
    return view('administrador.estadisticas3');
});

Route::get('/administrador/estadisticas4', function () {
    return view('administrador.estadisticas4');
});
//-----------------------------------------------RUTAS DEL ALUMNO-----------------------------------------------------

Route::get('/alumno/index','JustificacionController@index')->name('alumno');
Route::get('/alumno/nuevaJustificacion','JustificacionController@create');
Route::post('/alumno/store', 'JustificacionController@store');



Route::get('/alumno/misJustificaciones', function () {
    return view('alumno.misJustificaciones');
});


Route::get('/alumno/perfil', function () {
    return view('alumno.perfil');
});




//-----------------------------------------------RUTAS DEL COORDINADOR-----------------------------------------------------

Route::get('/coordinador/index', function () {
    return view('coordinador.index');
});

Route::get('/coordinador/misJustificaciones', function () {
    return view('coordinador.misEstadisticas');
});

Route::get('/coordinador/perfil', function () {
    return view('coordinador.perfil');
});

Route::get('/coordinador/perfil', function () {
    return view('coordinador.perfil');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
