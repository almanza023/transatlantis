<?php

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('orders', 'OrderController', ['except' => [
    'destroy', 'show', 'create', 
]]);

Route::resource('provider', 'ProviderController', ['except' => [
    'destroy',
]]);

Route::resource('product', 'ProductController', ['except' => [
    'destroy',
]]);

Route::resource('driver', 'DriverController', ['except' => [
    'destroy',
]]);

Route::resource('vehicle', 'VehicleController', ['except' => [
    'destroy', 'show',
]]);

Route::resource('typepayment', 'TypePaymentController', ['except' => [
    'destroy', 'show', 'create', 'edit',
]]);

Route::resource('timepayment', 'TimePaymentController', ['except' => [
    'destroy', 'show', 'create', 'edit',
]]);

Route::resource('orderstatus', 'OrderStatusController', ['except' => [
    'destroy', 'show', 'create', 'edit',
]]);

Route::resource('typeprovider', 'TypeProviderController', ['except' => [
    'destroy', 'show', 'create', 'edit',
]]);

Route::resource('category', 'CategoryController', ['except' => [
    'destroy', 'show', 'create', 'edit',
]]);

Route::resource('typeunit', 'TypeUnitController', ['except' => [
    'destroy', 'show', 'create', 'edit',
]]);

Route::resource('despacho', 'DespachoController', ['except' => [
    'destroy', 'show', 'create',
]]);


Route::resource('customers', 'CustomerController', ['except' => [
    'destroy', 'create',
]]);

Route::resource('purchase', 'PurchaseController', ['only' => [
    'index', 
]]);


Route::resource('quotation', 'QuotationController',  ['except' => [
    'destroy', 'edit',
]]);


Route::resource('user', 'UserController',  ['except' => [
    'show',
]]);
Route::resource('driver_vehicle', 'DriverVehicleController', ['except' => [
    'destroy', 'show'
]]);


Route::resource('permisos', 'PermisoController');

// VISTAS CREATE
Route::get('despacho/create/{id}', 'DespachoController@create')->name('despacho.create');
Route::get('purchase/create/{id}', 'PurchaseController@create')->name('purchase.create');
Route::get('orders/show/{id}', 'OrderController@show')->name('orders.show');
Route::get('orders/create', 'OrderController@create')->name('orders.create');



// ESTADOS
Route::get('provider/estado/{id}', 'ProviderController@changeStatus')->name('provider.status');
Route::get('product/estado/{id}', 'ProductController@changeStatus')->name('product.status');
Route::get('driver/estado/{id}', 'DriverController@changeStatus')->name('driver.status');


// AJAX

// POST
Route::group(['middleware' => ['cors']], function () {
    Route::post('domicile/save', 'DomicileController@saveDomicile')->name('domicile.save');
    Route::post('purchase/save', 'OrderController@savePurchase')->name('purchase.save');
    Route::post('schedule/save', 'OrderController@saveSchedule')->name('schedule.save');
    Route::post('orders/discount', 'OrderController@saveDiscount')->name('orders.discount');
    Route::post('orders/entrega', 'OrderController@saveEntregas')->name('save.entregas');
});
Route::post('orders/invoice', 'OrderController@saveInvoice')->name('save.invoice');

// GET
Route::get('orders/approve/{id}', 'OrderController@approveOrder')->name('orders.approve');
Route::get('orders/deny/{id}', 'OrderController@denyOrder')->name('orders.deny');
Route::get('change/municipalities/{id}', 'OrderController@changeMunicipalities');
Route::get('change/domiciles/{id}', 'OrderController@changeDomiciles')->name('domicile.change');
Route::get('orders/filter', 'OrderController@filter')->name('orders.filter');
Route::get('orders/filter/agendados', 'OrderController@filterAgendados')->name('orders.filter-agendados');
Route::get('quations/filter', 'OrderController@filterQuotation')->name('quotations.filter');

Route::get('orders/details/{id}', 'OrderController@showDetail')->name('orders.detail');
Route::get('orders/change', 'OrderController@getOrders')->name('orders.change'); // Para clonar
Route::get('order/reporte', 'OrderController@getReporteOrders')->name('orders.report'); // Para clonar
Route::get('agendados', 'OrderController@getAgendados')->name('agendados'); // Para clonar
Route::get('entregas/conductores', 'OrderController@showEntregasConductor')->name('entregas.conductor'); // Para clonar
Route::get('estadistica/estado-pedidos', 'EstadisticaController@index')->name('estadistica'); // Para clonar
Route::get('consultar/estado-pedidos', 'EstadisticaController@consulta')->name('estadistica.consultar'); // Para clonar
Route::get('clonar/{id}', 'OrderController@clonar')->name('clonar');
Route::get('historial/orden/{id}', 'OrderController@history')->name('order.history')->middleware('role:super-admin');;
Route::get('schedule/edit/{id}', 'OrderController@editSchedule')->name('schedule.edit')->middleware('role:super-admin');
Route::post('schedule/update', 'OrderController@updateSchedule')->name('schedule.update')->middleware('role:super-admin');
Route::get('perfil/{id}', 'HomeController@getPerfil')->name('perfil');
Route::get('order/total/{id}', 'OrderController@getOrderTotal')->name('order.total');
Route::post('perfil', 'HomeController@updatePassword')->name('update.password');
Route::get('quotation/approve/{id}', 'QuotationController@edit')->name('quotation.edit');
Route::get('pedidos/facturar', 'OrderController@getFacturados')->name('order.facturar');

Route::get('proveedores/prodcutos', 'ProviderController@getProductos')->name('provider.productos');


// REPORTES

Route::get('purchase/reporte/{id}', 'PurchaseController@reporte')->name('purchase.report');
Route::get('despacho/reporte/{id}', 'DespachoController@reporte')->name('schedule.report');
Route::get('reporte/order/{id}', 'OrderController@getOrder')->name('report.order');
Route::get('reporte/cotizacion/{id}', 'QuotationController@getQuotation')->name('report.quotation');
Route::get('detalles/cotizacion/{id}', 'QuotationController@getQuotationDetalles')->name('detalles.quotation');


Route::get('reporte/general', 'ReporteController@show_general')->name('reporte.general');
Route::get('reporte/facturados', 'ReporteController@show_facturados')->name('reporte.facturados');
Route::get('reporte/viajes', 'ReporteController@show_viajes')->name('reporte.viajes');
Route::get('reporte/compra-proveedores', 'ReporteController@show_compras')->name('reporte.compra');
Route::get('reporte/historial-dia', 'ReporteController@show_historial')->name('reporte.historial');

Route::post('reporte/orders', 'OrderController@getPrintOrders')->name('orders.print');
Route::post('reporte/orders/driver', 'OrderController@getOrderDriver')->name('orders.driver');
Route::post('reporte/general/fechas', 'ReporteController@getReporteGeneral')->name('pdf.general');
Route::post('reporte/pedidos-facturados', 'ReporteController@getReporteFacturados')->name('pdf.facturados');
Route::post('reporte/historial-dia', 'ReporteController@getReporteHistorial')->name('pdf.historial-dia');
Route::post('reporte/compras', 'ReporteController@getComprasProveedor')->name('pdf.compras');

Route::post('reporte/entregas-conductor', 'ReporteController@getViajesConductor')->name('pdf.viajes-conductor');
Route::post('guardar/clonar', 'OrderController@storeClonar')->name('store.clonar');
Route::post('reversar', 'OrderController@reversar')->name('reversar');


Route::get('aprobar/cotizacion/{id}', 'QuotationController@aprobar')->name('aprobar.quotation');


Route::post('roles/store', 'RoleController@store')->name('roles.store');

	Route::get('roles', 'RoleController@index')->name('roles.index');
		

	Route::get('roles/create', 'RoleController@create')->name('roles.create');
		

	Route::put('roles/{role}', 'RoleController@update')->name('roles.update');
		

	Route::get('roles/{role}', 'RoleController@show')->name('roles.show');
	

	Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy');
		
		
	Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit');
	


