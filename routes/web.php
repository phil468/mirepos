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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/membresiahome', 'HomeController@Membresiaindex')->name('membresiahome');
Route::get('/eventhome', 'HomeController@Eventindex')->name('eventhome');

/**************************************
	*
	*	
	* Functions: Controladores de CHAT
	*
	*
	***************************************/

//require __DIR__.'/auth.php';

Route::get('auth/user', function () {

	if(auth()->check()){

		return response()->json([
			'authUser' => auth()->user()
		]);

		return null;

	}

});

Route::get('chat/{chat}', 'ChatController@show')->name('chat.show');

Route::get('chat/with/{user}', 'ChatController@chat_with')->name('chat.with');

Route::get('chat/{chat}/get_users', 'ChatController@get_users')->name('chat.get_users');

Route::get('chat/{chat}/get_messages', 'ChatController@get_messages')->name('chat.get_messages');

Route::post('message/sent', 'MessageController@sent')->name('message.sent');

Route::get('clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::middleware(['auth'])->group(function(){
	
	/**************************************
	*
	*	
	* Functions: Controladores de ROLES
	*
	*
	***************************************/

	Route::post('acceso/roles/store','RoleController@store')->name('acceso.roles.store')
	->middleware('permission:acceso.roles.create');

	Route::get('acceso/roles','RoleController@index')->name('acceso.roles.index')
	->middleware('permission:acceso.roles.index');	

	Route::get('acceso/roles/create','RoleController@create')->name('acceso.roles.create')
	->middleware('permission:acceso.roles.create');

	Route::put('acceso/roles/{role}','RoleController@update')->name('acceso.roles.update')
	->middleware('permission:acceso.roles.edit');

	Route::get('acceso/roles/{role}','RoleController@show')->name('acceso.roles.show')
	->middleware('permission:acceso.roles.show');

	Route::delete('acceso/roles/{role}','RoleController@destroy')->name('acceso.roles.destroy')
	->middleware('permission:acceso.roles.destroy');

	Route::get('acceso/roles/{role}/edit','RoleController@edit')->name('acceso.roles.edit')
	->middleware('permission:acceso.roles.edit');

	Route::get('acceso/usuario/{usuario}/assignRol','UserController@assignRol')->name('acceso.usuario.assignRol');

	Route::get('acceso/usuario','UserController@index')->name('acceso.usuario.index');
	
	/**************************************
	*
	*	
	* Functions: Controladores de PERMISO
	*
	*
	***************************************/

	Route::post('acceso/permisos/store','PermissionController@store')->name('acceso.permisos.store')
	->middleware('permission:acceso.permisos.create');

	Route::get('acceso/permisos','PermissionController@index')->name('acceso.permisos.index')
	->middleware('permission:acceso.permisos.index');	

	Route::get('acceso/permisos/create','PermissionController@create')->name('acceso.permisos.create')
	->middleware('permission:acceso.permisos.create');

	Route::put('acceso/permisos/{permisos}','PermissionController@update')->name('acceso.permisos.update')
	->middleware('permission:acceso.permisos.edit');

	Route::get('acceso/permisos/{permisos}','PermissionController@show')->name('acceso.permisos.show')
	->middleware('permission:acceso.permisos.show');

	Route::delete('acceso/permisos/{permisos}','PermissionController@destroy')->name('acceso.permisos.destroy')
	->middleware('permission:acceso.permisos.destroy');

	Route::get('acceso/permisos/{permisos}/edit','PermissionController@edit')->name('acceso.permisos.edit')
	->middleware('permission:acceso.permisos.edit');


	/**************************************
	*
	*	
	* Functions: Controladores de USUARIO
	*
	*
	***************************************/

	Route::post('acceso/usuario/store','UserController@store')->name('acceso.usuario.store')
	->middleware('permission:acceso.usuario.create');

	Route::get('acceso/usuario','UserController@index')->name('acceso.usuario.index')
	->middleware('permission:acceso.usuario.index');

	Route::put('acceso/usuario/{usuario}/assignRol','UserController@rolAssigned')->name('acceso.usuario.rolAssigned')
	->middleware('permission:acceso.usuario.assignRol');	

	Route::get('acceso/usuario/{usuario}/assignRol','UserController@assignRol')->name('acceso.usuario.assignRol')
	->middleware('permission:acceso.usuario.assignRol');

	Route::put('acceso/usuario/{usuario}/assignSede','UserController@sedeAssigned')->name('acceso.usuario.sedeAssigned')
	->middleware('permission:acceso.usuario.assignSede');	

	Route::get('acceso/usuario/{usuario}/assignSede','UserController@assignSede')->name('acceso.usuario.assignSede')
	->middleware('permission:acceso.usuario.assignSede');

	Route::get('acceso/usuario/create','UserController@create')->name('acceso.usuario.create')
	->middleware('permission:acceso.usuario.create');

	Route::put('acceso/usuario/{usuario}','UserController@update')->name('acceso.usuario.update')
	->middleware('permission:acceso.usuario.edit');

	Route::put('acceso/usuario/{usuario}/password','UserController@password')->name('acceso.usuario.password')
	->middleware('permission:acceso.usuario.password');

	Route::get('acceso/usuario/{usuario}','UserController@show')->name('acceso.usuario.show')
	->middleware('permission:acceso.usuario.show');

	Route::delete('acceso/usuario/{usuario}','UserController@destroy')->name('acceso.usuario.destroy')
	->middleware('permission:acceso.usuario.destroy');

	Route::get('acceso/usuario/{usuario}/edit','UserController@edit')->name('acceso.usuario.edit')
	->middleware('permission:acceso.usuario.edit');

	/**************************************
	*
	*	
	* Functions: Controladores de CATEGORIA
	*
	*
	***************************************/

	Route::post('producto/categoria/store','CategoriaController@store')->name('producto.categoria.store')
	->middleware('permission:producto.categoria.create');

	Route::get('producto/categoria','CategoriaController@index')->name('producto.categoria.index')
	->middleware('permission:producto.categoria.index');	

	Route::get('producto/categoria/create','CategoriaController@create')->name('producto.categoria.create')
	->middleware('permission:producto.categoria.create');

	Route::put('producto/categoria/{categoria}','CategoriaController@update')->name('producto.categoria.update')
	->middleware('permission:producto.categoria.edit');

	Route::get('producto/categoria/{categoria}','CategoriaController@show')->name('producto.categoria.show')
	->middleware('permission:producto.categoria.show');

	Route::delete('producto/categoria/{categoria}','CategoriaController@destroy')->name('producto.categoria.destroy')
	->middleware('permission:producto.categoria.destroy');

	Route::get('producto/categoria/{categoria}/edit','CategoriaController@edit')->name('producto.categoria.edit')
	->middleware('permission:producto.categoria.edit');

	/**************************************
	*
	*	
	* Functions: Controladores de PRODUCTO
	*
	*
	***************************************/

	Route::post('producto/producto/store','ProductoController@store')->name('producto.producto.store')
	->middleware('permission:producto.producto.create');

	Route::get('producto/producto','ProductoController@index')->name('producto.producto.index')
	->middleware('permission:producto.producto.index');	

	Route::get('producto/producto/create','ProductoController@create')->name('producto.producto.create')
	->middleware('permission:producto.producto.create');

	Route::put('producto/producto/{producto}','ProductoController@update')->name('producto.producto.update')
	->middleware('permission:producto.producto.edit');

	Route::get('producto/producto/{producto}','ProductoController@show')->name('producto.producto.show')
	->middleware('permission:producto.producto.show');

	Route::delete('producto/producto/{producto}','ProductoController@destroy')->name('producto.producto.destroy')
	->middleware('permission:producto.producto.destroy');

	Route::get('producto/producto/{producto}/edit','ProductoController@edit')->name('producto.producto.edit')
	->middleware('permission:producto.producto.edit');

	/**************************************
	*
	*	
	* Functions: Controladores de SEDES
	*
	*
	***************************************/

	Route::post('poder_judicial/sedes/store','SedesController@store')->name('poder_judicial.sedes.store')
	->middleware('permission:poder_judicial.sedes.create');

	Route::get('poder_judicial/sedes','SedesController@index')->name('poder_judicial.sedes.index')
	->middleware('permission:poder_judicial.sedes.index');	

	Route::get('poder_judicial/sedes/create','SedesController@create')->name('poder_judicial.sedes.create')
	->middleware('permission:poder_judicial.sedes.create');

	Route::put('poder_judicial/sedes/{sedes}','SedesController@update')->name('poder_judicial.sedes.update')
	->middleware('permission:poder_judicial.sedes.edit');

	Route::get('poder_judicial/sedes/{sedes}','SedesController@show')->name('poder_judicial.sedes.show')
	->middleware('permission:poder_judicial.sedes.show');

	Route::delete('poder_judicial/sedes/{sedes}','SedesController@destroy')->name('poder_judicial.sedes.destroy')
	->middleware('permission:poder_judicial.sedes.destroy');

	Route::get('poder_judicial/sedes/{sedes}/edit','SedesController@edit')->name('poder_judicial.sedes.edit')
	->middleware('permission:poder_judicial.sedes.edit');

	/******************************************
	*
	*	
	* Functions: Controladores de PERMANENCIAS
	*
	*
	*******************************************/

	Route::post('poder_judicial/permanencias/store','PermanenciasController@store')->name('poder_judicial.permanencias.store')
	->middleware('permission:poder_judicial.permanencias.create');

	Route::get('poder_judicial/permanencias','PermanenciasController@index')->name('poder_judicial.permanencias.index')
	->middleware('permission:poder_judicial.permanencias.index');	

	Route::get('poder_judicial/permanencias/create','PermanenciasController@create')->name('poder_judicial.permanencias.create')
	->middleware('permission:poder_judicial.permanencias.create');

	Route::put('poder_judicial/permanencias/{permanencias}','PermanenciasController@update')->name('poder_judicial.permanencias.update')
	->middleware('permission:poder_judicial.permanencias.edit');

	Route::get('poder_judicial/permanencias/{permanencias}','PermanenciasController@show')->name('poder_judicial.permanencias.show')
	->middleware('permission:poder_judicial.permanencias.show');

	Route::delete('poder_judicial/permanencias/{permanencias}','PermanenciasController@destroy')->name('poder_judicial.permanencias.destroy')
	->middleware('permission:poder_judicial.permanencias.destroy');

	Route::get('poder_judicial/permanencias/{permanencias}/edit','PermanenciasController@edit')->name('poder_judicial.permanencias.edit')
	->middleware('permission:poder_judicial.permanencias.edit');

	/******************************************
	*
	*	
	* Functions: Controladores de INSTANCIAS
	*
	*
	*******************************************/

	Route::post('poder_judicial/instancias/store','InstanciasController@store')->name('poder_judicial.instancias.store')
	->middleware('permission:poder_judicial.instancias.create');

	Route::get('poder_judicial/instancias','InstanciasController@index')->name('poder_judicial.instancias.index')
	->middleware('permission:poder_judicial.instancias.index');	

	Route::get('poder_judicial/instancias/create','InstanciasController@create')->name('poder_judicial.instancias.create')
	->middleware('permission:poder_judicial.instancias.create');

	Route::put('poder_judicial/instancias/{instancias}','InstanciasController@update')->name('poder_judicial.instancias.update')
	->middleware('permission:poder_judicial.instancias.edit');

	Route::get('poder_judicial/instancias/{instancias}','InstanciasController@show')->name('poder_judicial.instancias.show')
	->middleware('permission:poder_judicial.instancias.show');

	Route::delete('poder_judicial/instancias/{instancias}','InstanciasController@destroy')->name('poder_judicial.instancias.destroy')
	->middleware('permission:poder_judicial.instancias.destroy');

	Route::get('poder_judicial/instancias/{instancias}/edit','InstanciasController@edit')->name('poder_judicial.instancias.edit')
	->middleware('permission:poder_judicial.instancias.edit');

	/**********************************************
	*
	*	
	* Functions: Controladores de ESPECIALIDADES
	*
	*
	***********************************************/

	Route::post('poder_judicial/especialidades/store','EspecialidadesController@store')->name('poder_judicial.especialidades.store')
	->middleware('permission:poder_judicial.especialidades.create');

	Route::get('poder_judicial/especialidades','EspecialidadesController@index')->name('poder_judicial.especialidades.index')
	->middleware('permission:poder_judicial.especialidades.index');	

	Route::get('poder_judicial/especialidades/create','EspecialidadesController@create')->name('poder_judicial.especialidades.create')
	->middleware('permission:poder_judicial.especialidades.create');

	Route::put('poder_judicial/especialidades/{especialidades}','EspecialidadesController@update')->name('poder_judicial.especialidades.update')
	->middleware('permission:poder_judicial.especialidades.edit');

	Route::get('poder_judicial/especialidades/{especialidades}','EspecialidadesController@show')->name('poder_judicial.especialidades.show')
	->middleware('permission:poder_judicial.especialidades.show');

	Route::delete('poder_judicial/especialidades/{especialidades}','EspecialidadesController@destroy')->name('poder_judicial.especialidades.destroy')
	->middleware('permission:poder_judicial.especialidades.destroy');

	Route::get('poder_judicial/especialidades/{especialidades}/edit','EspecialidadesController@edit')->name('poder_judicial.especialidades.edit')
	->middleware('permission:poder_judicial.especialidades.edit');


	/******************************************
	*
	*	
	* Functions: Controladores de PRESUPUESTO
	*
	*
	*******************************************/

	Route::post('poder_judicial/presupuesto/store','PresupuestoController@store')->name('poder_judicial.presupuesto.store')
	->middleware('permission:poder_judicial.presupuesto.create');

	Route::get('poder_judicial/presupuesto','PresupuestoController@index')->name('poder_judicial.presupuesto.index')
	->middleware('permission:poder_judicial.presupuesto.index');	

	Route::get('poder_judicial/presupuesto/create','PresupuestoController@create')->name('poder_judicial.presupuesto.create')
	->middleware('permission:poder_judicial.presupuesto.create');

	Route::put('poder_judicial/presupuesto/{presupuesto}','PresupuestoController@update')->name('poder_judicial.presupuesto.update')
	->middleware('permission:poder_judicial.presupuesto.edit');

	Route::get('poder_judicial/presupuesto/{presupuesto}','PresupuestoController@show')->name('poder_judicial.presupuesto.show')
	->middleware('permission:poder_judicial.presupuesto.show');

	Route::delete('poder_judicial/presupuesto/{presupuesto}','PresupuestoController@destroy')->name('poder_judicial.presupuesto.destroy')
	->middleware('permission:poder_judicial.presupuesto.destroy');

	Route::get('poder_judicial/presupuesto/{presupuesto}/edit','PresupuestoController@edit')->name('poder_judicial.presupuesto.edit')
	->middleware('permission:poder_judicial.presupuesto.edit');

	/******************************************
	*
	*	
	* Functions: Controladores de OOJJ
	*
	*
	*******************************************/

	Route::post('poder_judicial/oojj/store','OOJJController@store')->name('poder_judicial.oojj.store')
	->middleware('permission:poder_judicial.oojj.create');

	Route::get('poder_judicial/oojj','OOJJController@index')->name('poder_judicial.oojj.index')
	->middleware('permission:poder_judicial.oojj.index');	

	Route::get('poder_judicial/oojj/create','OOJJController@create')->name('poder_judicial.oojj.create')
	->middleware('permission:poder_judicial.oojj.create');

	Route::put('poder_judicial/oojj/{oojj}','OOJJController@update')->name('poder_judicial.oojj.update')
	->middleware('permission:poder_judicial.oojj.edit');

	Route::get('poder_judicial/oojj/{oojj}','OOJJController@show')->name('poder_judicial.oojj.show')
	->middleware('permission:poder_judicial.oojj.show');

	Route::delete('poder_judicial/oojj/{oojj}','OOJJController@destroy')->name('poder_judicial.oojj.destroy')
	->middleware('permission:poder_judicial.oojj.destroy');

	Route::get('poder_judicial/oojj/{oojj}/edit','OOJJController@edit')->name('poder_judicial.oojj.edit')
	->middleware('permission:poder_judicial.oojj.edit');

	/***********************************************
	*
	*	
	* Functions: Controladores de Reporte Cierre
	*
	*
	************************************************/

	Route::get('producto/reporte_cierre','ExcelImportController@index')->name('producto.reporte_cierre.index')
	->middleware('permission:producto.reporte_cierre.index');

	Route::post('producto/reporte_cierre/import','ExcelImportController@import')->name('producto.reporte_cierre.import');

	/******************************************
	*
	*	
	* Functions: Controladores de Pedidos
	*
	*
	*******************************************/

	Route::post('pedidos/pedidos/store','PedidoController@store')->name('pedidos.pedidos.store')
	->middleware('permission:pedidos.pedidos.create');

	Route::get('pedidos/pedidos','PedidoController@index')->name('pedidos.pedidos.index')
	->middleware('permission:pedidos.pedidos.index');	

	Route::get('pedidos/pedidos/create','PedidoController@create')->name('pedidos.pedidos.create')
	->middleware('permission:pedidos.pedidos.create');

	Route::get('pedidos/pedidos/{pedidos}','PedidoController@show')->name('pedidos.pedidos.show')
	->middleware('permission:pedidos.pedidos.show');

	Route::get('pedidos/pedidos/seguimiento/{pedidos}','PedidoController@seguimiento')->name('pedidos.pedidos.seguimiento')
	->middleware('permission:pedidos.pedidos.seguimiento');

	Route::delete('pedidos/pedidos/{pedidos}','PedidoController@destroy')->name('pedidos.pedidos.destroy')
	->middleware('permission:pedidos.pedidos.destroy');

	Route::delete('pedidos/pedidos/{pedidos}/rechazar','PedidoController@rechazar')->name('pedidos.pedidos.rechazar')
	->middleware('permission:pedidos.pedidos.rechazar');

	Route::post('pedidos/pedidos/subir_pecosa/{pedidos}','PedidoController@subir_pecosa')->name('pedidos.pedidos.subir_pecosa')
	->middleware('permission:pedidos.pedidos.subir_pecosa');

	/******************************************
	*
	*	
	* Functions: Controladores de Pecosa
	*
	*
	*******************************************/

	
	Route::get('pedidos/pecosa','PedidoController@indexPecosa')->name('pedidos.pecosa.index')
	->middleware('permission:pedidos.pecosa.index');	

	Route::get('pedidos/pecosa/pedido','PecosaController@index')->name('pedidos.pecosa.pedido')
	->middleware('permission:pedidos.pecosa.pedido');	

	Route::post('pedidos/pecosa','PecosaController@store')->name('pedidos.pecosa.store')
	->middleware('permission:pedidos.pecosa.create');
	
	Route::get('pedidos/pecosa/create','PecosaController@create')->name('pedidos.pecosa.create')
	->middleware('permission:pedidos.pecosa.create');

	Route::delete('pedidos/pecosa/{pecosa}','PecosaController@destroy')->name('pedidos.pecosa.destroy')
	->middleware('permission:pedidos.pecosa.destroy');

	Route::post('pedidos/pecosa/subir_pecosa/{pecosa}','PecosaController@subir_pecosa')->name('pedidos.pecosa.subir_pecosa')
	->middleware('permission:pedidos.pecosa.subir_pecosa');

	Route::get('pedidos/pecosa/{pecosa}','PecosaController@show')->name('pedidos.pecosa.show')
	->middleware('permission:pedidos.pecosa.show');

	/******************************************
	*
	*	
	* Functions: Controladores de Transporte
	*
	*
	*******************************************/

	
	Route::get('pedidos/transporte','TransporteController@index')->name('pedidos.transporte.index')
	->middleware('permission:pedidos.transporte.index');	

	Route::get('pedidos/transporte/{pedido}/create','RutaController@assignRuta')->name('pedidos.transporte.create')
	->middleware('permission:pedidos.transporte.create');

	Route::put('pedidos/transporte/{pedido}/create','RutaController@rutaAssigned')->name('pedidos.transporte.store')
	->middleware('permission:pedidos.transporte.create');	

	Route::get('pedidos/transporte/ver_rutas','TransporteController@ver_rutas')->name('pedidos.transporte.ver_rutas')
	->middleware('permission:pedidos.transporte.ver_rutas');

	Route::get('pedidos/transporte/ruta_asignada','RutaController@ruta_asignada')->name('pedidos.transporte.ruta_asignada')
	->middleware('permission:pedidos.transporte.ruta_asignada');	

	Route::delete('pedidos/transporte/{transporte}','RutaController@entrega')->name('pedidos.transporte.entrega')
	->middleware('permission:pedidos.transporte.entrega');	

	Route::get('pedidos/transporte/ejemplo','TransporteController@ejemplo')->name('pedidos.transporte.ejemplo')
	->middleware('permission:pedidos.transporte.ejemplo');	
	
	/******************************************
	*
	*	
	* Functions: Controladores de Reportes
	*
	*
	*******************************************/

	Route::get('reportes/consumo_mensual/oojj','ReporteController@oojj')->name('reportes.consumo_mensual.oojj')
	->middleware('permission:reportes.consumo_mensual.oojj');

	Route::get('reportes/consumo_mensual/oojj_producto/{id}/{id1}','ReporteController@producto')->name('reportes.consumo_mensual.oojj_producto')->middleware('permission:reportes.consumo_mensual.oojj_producto');

	Route::get('reportes/consumo_anual/oojj','ReporteController@anual_oojj')->name('reportes.consumo_anual.oojj')
	->middleware('permission:reportes.consumo_anual.oojj');

	Route::get('reportes/consumo_anual/top_producto','ReporteController@top_producto')->name('reportes.consumo_anual.top_producto')
	->middleware('permission:reportes.consumo_anual.top_producto');
	
	Route::get('reportes/consumo_anual/producto_oojj/{id}','ReporteController@producto_oojj')->name('reportes.consumo_anual.producto_oojj')
	->middleware('permission:reportes.consumo_anual.producto_oojj');

	Route::get('reportes/consumo_mensual/total_pedidos_mes','ReporteController@total_pedidos_mes')->name('reportes.consumo_mensual.total_pedidos_mes')
	->middleware('permission:reportes.consumo_mensual.total_pedidos_mes');

	Route::get('reportes/consumo_mensual/pedido_mensual_producto/{id}','ReporteController@pedido_mensual_producto')->name('reportes.consumo_mensual.pedido_mensual_producto')
	->middleware('permission:reportes.consumo_mensual.pedido_mensual_producto');

	Route::get('reportes/consumo_mensual/pedidos_oojj_mes','ReporteController@pedidos_oojj_mes')->name('reportes.consumo_mensual.pedidos_oojj_mes')
	->middleware('permission:reportes.consumo_mensual.pedidos_oojj_mes');
	
	Route::get('reportes/consumo_mensual/pedido_mensual_oojj/{id}','ReporteController@pedido_mensual_oojj')->name('reportes.consumo_mensual.pedido_mensual_oojj')
	->middleware('permission:reportes.consumo_mensual.pedido_mensual_oojj');

	/******************************************
	*
	*	
	* Functions: Controladores de Calendario
	*
	*
	*******************************************/
	Route::get('fullcalendar','FullCalendarController@index')->name('fullcalendar')
	->middleware('permission:fullcalendar');

	/******************************************
	*
	*	
	* Functions: Controladores de SHOP
	*
	*
	*******************************************/
	Route::get('pedidos/shop','ShopController@index')->name('pedidos.shop.index')
	->middleware('permission:pedidos.shop.index');

	Route::get('cart', 'ShopController@cart')->name('pedidos.shop.cart')
	->middleware('permission:pedidos.shop.cart');
 
	Route::get('add-to-cart/{id}', 'ShopController@addToCart');

	Route::patch('update-cart', 'ShopController@update');
 
	Route::delete('remove-from-cart', 'ShopController@remove');

});
 