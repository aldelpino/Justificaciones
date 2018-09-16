<?php
Route::get('/', function(){
    return redirect('/login');
});

Auth::routes();

Route::group(['prefix' => 'api/v1', 'middleware' => 'auth:api'], function () {
    // Route::post('/short', 'UrlMapperController@store');
    Route::post('alumno/store', 'JustificacionController@store');
    // Route::post('/short', 'UrlMapperController@store');
    // Route::post('alumno/store', 'JustificacionController@store');
});

Route::group(['middleware' => 'auth'], function(){
    // Alumno
    Route::group(['prefix' => 'alumno'], function(){
        Route::get('/index','AlumnoController@index')->name('alumno');
        Route::get('/nuevaJustificacion','JustificacionController@create')->name('alumno');
        Route::get('/revisarJustificacion','JustificacionController@revisar')->name('alumno');
        Route::post('/image/upload/store','SubirImagenController@upload')->name('subirimagen.filestore')->middleware('auth:web');
        Route::post('/store', 'JustificacionController@store')->name('justificacion.store')->middleware('auth:web');
        Route::get('/create', 'JustificacionController@create')->name('justificacion.create')->middleware('permission:justificacion.create');
        Route::get('/cambiarContrasena', 'ContrasenaController@index')->name('contrasena.create')->middleware('auth:web');
        Route::post('/contrasena/cambiar', 'ContrasenaController@cambiar')->name('contrasena.create')->middleware('auth:web');
    });

    Route::get('asignaturas/get/{asignaturaId}', 'JustificacionController@getAsignaturas');

    // Administrador
    Route::get('/administrador/index','AdministradorController@index')->name('administrador');

    // Coordinador
    Route::get('/coordinador/index','CoordinadorController@index')->name('coordinador');

    //Justificaciones

    // Route::post('alumno/store', 'JustificacionController@store')->name('justificacion.store')->middleware('can:post');
    // Route::get('justificaciones', 'JustificacionController@index')->name('justificacion.index')->middleware('permission:roles.index');
    // Route::get('/changePassword','HomeController@showChangePasswordForm');

    // Route::get('justificaciones/{role}', 'JustificacionController@show')->name('justificacion.show')->middleware('permission:justificacion.show');
    // Route::get('coordinador/edicion/{id}', 'JustificacionController@edit')->name('justificacion.edit')->middleware('auth:web');
    // Route::post('coordinador/update/{id}', 'JustificacionController@update')->name('justificacion.update')->middleware('auth:web');

    Route::put('justificaciones/{role}', 'JustificacionController@update')->name('justificacion.update')->middleware('permission:justificacion.edit');
    Route::get('justificaciones/{role}', 'JustificacionController@show')->name('justificacion.show')->middleware('permission:justificacion.show');
    Route::get('justificaciones/{role}', 'JustificacionController@edit')->name('justificacion.edit')->middleware('permission:justificacion.edit');
    Route::put('users/{role}', 'UserController@update')->name('users.update')->middleware('permission:users.edit');
    Route::get('users/{role}', 'UserController@show')->name('users.show')->middleware('permission:users.show');
    Route::get('users/{role}', 'UserController@edit')->name('users.edit')->middleware('permission:users.edit');
});







//-----------------------------------------------RUTAS DEL ADMINISTRADOR-----------------------------------------------------

// Route::get('/administrador/index', function () {
//     return view('administrador.index');
// });

// Route::get('/administrador/registroCoordinadores', function () {
//     return view('administrador.registroCoordinadores');
// });

// Route::get('/administrador/perfil', function () {
//     return view('administrador.perfil');
// });

// Route::get('/administrador/estadisticas1', function () {
//     return view('administrador.estadisticas1');
// });

// Route::get('/administrador/estadisticas2', function () {
//     return view('administrador.estadisticas2');
// });

// Route::get('/administrador/estadisticas3', function () {
//     return view('administrador.estadisticas3');
// });

// Route::get('/administrador/estadisticas4', function () {
//     return view('administrador.estadisticas4');
// });
//-----------------------------------------------RUTAS DEL ALUMNO-----------------------------------------------------

// Route::get('/alumno/nuevaJustificacion','JustificacionController@create');
// Route::post('/alumno/store', 'JustificacionController@store');



// Route::get('/alumno/misJustificaciones', function () {
//     return view('alumno.misJustificaciones');
// });


// Route::get('/alumno/perfil', function () {
//     return view('alumno.perfil');
// });




//-----------------------------------------------RUTAS DEL COORDINADOR-----------------------------------------------------

// Route::get('/coordinador/index', function () {
//     return view('coordinador.index');
// });

// Route::get('/coordinador/misJustificaciones', function () {
//     return view('coordinador.misEstadisticas');
// });

// Route::get('/coordinador/perfil', function () {
//     return view('coordinador.perfil');
// });

// Route::get('/coordinador/perfil', function () {
//     return view('coordinador.perfil');
// });
