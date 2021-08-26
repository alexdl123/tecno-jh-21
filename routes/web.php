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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    //----Configuracion
    Route::get('/configuraciones', 'Configuracion@index')->name('configuraciones');
    Route::post('/configuraciones/fuente', 'Configuracion@fuente')->name('fuente');
    Route::post('/configuraciones/tamano', 'Configuracion@tamano')->name('tamano');
    Route::post('/configuraciones/tema', 'Configuracion@tema')->name('tema');
    //------Categoria
    Route::get('/categorias', 'CategoriaController@index')->name('categorias')->middleware('permission:ver categoria');
    Route::get('/categorias/create', 'CategoriaController@create')->name('categorias_create')->middleware('permission:crear categoria');
    Route::get('/categorias/show/{id}', 'CategoriaController@show')->name('categorias_show')->middleware('permission:ver categoria');
    Route::get('/categorias/edit/{id}', 'CategoriaController@edit')->name('categorias_edit')->middleware('permission:editar categoria');
    Route::post('/categorias/store', 'CategoriaController@store')->name('categorias_store')->middleware('permission:crear categoria');
    Route::post('/categorias/update/{id}', 'CategoriaController@update')->name('categorias_update')->middleware('permission:editar categoria');
    Route::post('/categorias/destroy/{id}', 'CategoriaController@destroy')->name('categorias_delete')->middleware('permission:eliminar categoria');
    //------Bitacora
    Route::get('/bitacoras', 'BitacoraController@index')->name('bitacoras')->middleware('permission:ver bitacora');
    //------Plan
    Route::get('/planes', 'PlanController@index')->name('planes')->middleware('permission:ver plan');
    Route::get('/planes/create', 'PlanController@create')->name('planes_create')->middleware('permission:crear plan');
    Route::get('/planes/edit/{id}', 'PlanController@edit')->name('planes_edit')->middleware('permission:editar plan');
    Route::post('/planes/store', 'PlanController@store')->name('planes_store')->middleware('permission:crear plan');
    Route::post('/planes/update/{id}', 'PlanController@update')->name('planes_update')->middleware('permission:editar plan');
    Route::post('/planes/destroy/{id}', 'PlanController@destroy')->name('planes_delete')->middleware('permission:eliminar plan');

    Route::get('/huespedes', 'HuespedController@index')->name('huespedes')->middleware('permission:ver huesped');
    Route::post('/huespedes/update/{id}', 'HuespedController@update')->name('huespedes_update')->middleware('permission:editar huesped');
    Route::get('/huespedes/create', 'HuespedController@create')->name('huespedes_create')->middleware('permission:crear huesped');
    Route::get('/huespedes/edit/{id}', 'HuespedController@edit')->name('huespedes_edit')->middleware('permission:editar huesped');
    Route::get('/huespedes/show/{id}', 'HuespedController@show')->name('huespedes_show')->middleware('permission:ver huesped');
    Route::post('/huespedes/store', 'HuespedController@store')->name('huespedes_store')->middleware('permission:crear huesped');
    Route::post('/huespedes/destroy/{id}', 'HuespedController@destroy')->name('huespedes_delete')->middleware('permission:eliminar huesped');
    
    Route::get('/habitaciones', 'HabitacionController@index')->name('habitaciones')->middleware('permission:ver habitacion');
    Route::get('/habitaciones/create', 'HabitacionController@create')->name('habitaciones_create')->middleware('permission:crear habitacion');
    Route::get('/habitaciones/edit/{id}', 'HabitacionController@edit')->name('habitaciones_edit')->middleware('permission:editar habitacion');
    Route::get('/habitaciones/show/{id}', 'HabitacionController@show')->name('habitaciones_show')->middleware('permission:ver habitacion');
    Route::post('/habitaciones/store', 'HabitacionController@store')->name('habitaciones_store')->middleware('permission:crear habitacion');
    Route::post('/habitaciones/update/{id}', 'HabitacionController@update')->name('habitaciones_update')->middleware('permission:editar habitacion');
    Route::post('/habitaciones/destroy/{id}', 'HabitacionController@destroy')->name('habitaciones_delete')->middleware('permission:eliminar habitacion');

    Route::get('/ingreso_salida', 'IngresoSalidaController@index')->name('ingreso_salida_index');
    Route::get('/ingreso_salida/create/{id}', 'IngresoSalidaController@create')->name('ingreso_salida_create');
    Route::post('/ingreso_salida', 'IngresoSalidaController@store')->name('ingreso_salida_store');

    Route::get('/usuarios', 'UserController@index')->name('usuarios')->middleware('permission:ver personal');
    Route::get('/usuarios/create', 'UserController@create')->name('usuarios_create')->middleware('permission:crear personal');
    Route::get('/usuarios/edit/{id}', 'UserController@edit')->name('usuarios_edit')->middleware('permission:editar personal');
    Route::get('/usuarios/show/{id}', 'UserController@show')->name('usuarios_show')->middleware('permission:ver personal');
    Route::post('/usuarios/store', 'UserController@store')->name('usuarios_store')->middleware('permission:crear personal');
    Route::post('/usuarios/update/{id}', 'UserController@update')->name('usuarios_update')->middleware('permission:editar personal');
    Route::post('/usuarios/destroy/{id}', 'UserController@destroy')->name('usuarios_delete')->middleware('permission:eliminar personal');

    Route::get('/reservas', 'ReservaController@index')->name('reservas')->middleware('permission:ver reserva');
    Route::get('/reservas/create', 'ReservaController@create')->name('reservas_create')->middleware('permission:crear reserva');
    Route::get('/reservas/show/{id}', 'ReservaController@show')->name('reservas_show')->middleware('permission:ver reserva');
    Route::post('/reservas/store', 'ReservaController@store')->name('reservas_store')->middleware('permission:crear reserva');
    Route::post('/reservas/destroy/{id}', 'ReservaController@destroy')->name('reservas_delete')->middleware('permission:eliminar reserva');

    Route::get('/reportes', 'ReporteController@index')->name('reportes')->middleware('permission:ver reporte');

    Route::get('/promociones', 'PromocionController@index')->name('promociones')->middleware('permission:ver promocion');
    Route::get('/promociones/create', 'PromocionController@create')->name('promociones_create')->middleware('permission:crear promocion');
    Route::get('/promociones/edit/{id}', 'PromocionController@edit')->name('promociones_edit')->middleware('permission:editar promocion');
    Route::post('/promociones/store', 'PromocionController@store')->name('promociones_store')->middleware('permission:crear promocion');
    Route::post('/promociones/update/{id}', 'PromocionController@update')->name('promociones_update')->middleware('permission:editar promocion');
    Route::post('/promociones/destroy/{id}', 'PromocionController@destroy')->name('promociones_delete')->middleware('permission:eliminar promocion');

    Route::post('/buscar', 'UserController@buscar')->name('buscar');

    Route::get('/mensajes', 'MensajeController@index')->name('mensajes');
    Route::get('/mensajes/create', 'MensajeController@create')->name('mensajes_create');
    Route::post('/mensajes', 'MensajeController@store')->name('mensajes_store');
    Route::get('/mensajes/{id}/edit', 'MensajeController@edit')->name('mensajes_edit');
    Route::post('/mensajes/{id}', 'MensajeController@update')->name('mensajes_update');
    Route::post('/mensajes/destroy/{id}', 'MensajeController@destroy')->name('mensajes_delete');

    Route::get('/comentarios', 'ComentarioController@index')->name('comentarios');
    Route::get('/comentarios/create', 'ComentarioController@create')->name('comentarios_create');
    Route::post('/comentarios', 'ComentarioController@store')->name('comentarios_store');
    Route::get('/comentarios/{id}/edit', 'ComentarioController@edit')->name('comentarios_edit');
    Route::post('/comentarios/{id}', 'ComentarioController@update')->name('comentarios_update');
    Route::post('/comentarios/destroy/{id}', 'ComentarioController@destroy')->name('comentarios_delete');
});
//->middleware('permission:ver usuario');