<?php

Route::get('/', function () {
	return redirect('/login');
});

Route::group(['middleware' => ['auth']], function () { 

	Route::get('home', function() {
		return view('home');
	});

	Route::get('anexos/{id}/descarga', ['as'=>'anexos.descarga','uses' =>'AnexosController@descargar']);

	Route::resource('anexos', 'AnexosController',['except' => ['show', 'store', 'create', 'edit']]);

	//Oficialia 
	// Route::group(['prefix' => 'oficialia', 'middleware' => ['role:Oficialia']], function() {	

	// 	Route::get('asignacion-directa/{status}/resultados', ['as'=>'oop.asignacion-directa.resultados','uses' =>'Oficialia\AsignacionDirectaController@getResultados']);

	// 	Route::get('conocimiento/{status}/resultados', ['as'=>'oopc.conocimiento.resultados','uses' =>'Oficialia\ConocimientoController@getResultados']);

	// 	Route::resource('asignacion-directa', 'Oficialia\AsignacionDirectaController',['except' => ['show'], 'as'=>'oop']);

	// 	Route::resource('borradores', 'Oficialia\BorradoresController',['except' => ['show'], 'as'=>'oop']);

	// 	Route::group(['prefix' => 'asignacion-directa'], function() {

	// 		Route::resource('enviados', 'Oficialia\AsignacionDirecta\EnviadosController',['except' => ['show', 'store'], 'as'=>'oop']);

	// 		Route::resource('acusados', 'Oficialia\AsignacionDirecta\AcusadosController',['except' => ['show', 'store'], 'as'=>'oop']);
	// 	});
	// 	Route::group(['prefix' => 'conocimiento'], function() {

	// 		Route::resource('enviados', 'Oficialia\Conocimiento\EnviadosController',['except' => ['show', 'store'], 'as'=>'oopc']);

	// 		Route::resource('acusados', 'Oficialia\Conocimiento\AcusadosController',['except' => ['show', 'store'], 'as'=>'oopc']);
	// 	});
	// });

	//Coordinación 
	// Route::group(['prefix' => 'coordinacion', 'middleware' => ['role:Coordinacion']], function() {

	// 	Route::get('recibidos/{status}/resultados', ['as'=>'coo.recibidos.resultados','uses' =>'Coordinacion\Recibidos\RecibidosController@getResultados']);
	// 	Route::resource('recibidos', 'Coordinacion\Recibidos\RecibidosController',['except' => ['show'], 'as'=>'coo']);	

	// 	Route::group(['prefix' => 'recibidos'], function() {

	// 		Route::resource('principal', 'Coordinacion\Recibidos\PrincipalController',['except' => [], 'as'=>'coo']);
			
	// 		Route::group(['prefix' => 'principal'], function() {
				
	// 			Route::get('oficialia/{id}/acusar', ['as'=>'coo.oficialia.acusar','uses' =>'Coordinacion\Recibidos\Principal\OficialiaController@acusar']);

	// 			Route::resource('oficialia', 'Coordinacion\Recibidos\Principal\OficialiaController',['except' => [], 'as'=>'coo']);
	// 		});

	// 	});

	// });

	/*
	 * Jue 21 de Noviembre de 2019
	 * Rutas principales para el ROL Drieccion
	 */
	Route::group(['prefix' => 'titular', 'middleware' => ['role:Titular']], function() {



		Route::get('documento/{id_documentacion_interna}/pdf', ['as'=>'ttl.documento.pdf','uses' =>'Titulares\ReporteController@PDFDocumento']);

		// Route::get('borradores/{id_documentacion_interna}/pdf', ['as'=>'ttl.borradores.pdf','uses' =>'Titulares\BorradorController@PDFBorrador']);

		Route::get('borradores/resultados', ['as'=>'ttl.borradores.resultados','uses' =>'Titulares\BorradorController@search']);

		Route::resource('borradores', 'Titulares\BorradorController',['except' => [], 'as'=>'ttl']);



		Route::get('revisiones/resultados', ['as'=>'ttl.revisiones.resultados','uses' =>'Titulares\RevisionController@search']);

		Route::resource('revisiones', 'Titulares\RevisionController',['except' => [], 'as'=>'ttl']);



		// Route::get('enviados/{id_folio}/detalle', ['as'=>'ttl.enviados.detalle','uses' =>'Titulares\EnviadoController@detail']);
		Route::get('enviados/{id_folio}/data/{id_tipo}', ['as'=>'ttl.enviados.data','uses' =>'Titulares\EnviadoController@data']);

		Route::get('enviados/resultados', ['as'=>'ttl.enviados.resultados','uses' =>'Titulares\EnviadoController@search']);

		Route::get('enviados/acusados', ['as'=>'ttl.enviados.acusados','uses' =>'Titulares\EnviadoController@acusados']);

		Route::resource('enviados', 'Titulares\EnviadoController',['except' => [], 'as'=>'ttl']);



		// En Revisión
		Route::get('recibidos/{id_folio}/data/{id_tipo}', ['as'=>'ttl.recibidos.data','uses' =>'Titulares\RecibidoController@data']);


		Route::get('recibidos/{id_folio}/detalle', ['as'=>'ttl.recibidos.detalle','uses' =>'Titulares\RecibidoController@detalle']);

		Route::get('recibidos/{id_documento_interna}/responder', ['as'=>'ttl.recibidos.responder','uses' =>'Titulares\RecibidoController@responder']);

		Route::get('recibidos/acusar', ['as'=>'ttl.recibidos.acusar','uses' =>'Titulares\RecibidoController@acusar']);

		Route::get('recibidos/detalles', ['as'=>'ttl.recibidos.detalles','uses' =>'Titulares\RecibidoController@detail']);

		Route::get('recibidos/resultados', ['as'=>'ttl.recibidos.resultados','uses' =>'Titulares\RecibidoController@search']);

		Route::get('recibidos/copias', ['as'=>'ttl.recibidos.copias','uses' =>'Titulares\RecibidoController@copias']);

		Route::get('recibidos/acusados', ['as'=>'ttl.recibidos.acusados','uses' =>'Titulares\RecibidoController@acusados']);

		Route::post('recibidos/returnar', ['as'=>'ttl.recibidos.returnar','uses' =>'Titulares\RecibidoController@returnar']);

		Route::post('recibidos/concluir', ['as'=>'ttl.recibidos.concluir','uses' =>'Titulares\RecibidoController@concluir']);

		Route::resource('recibidos', 'Titulares\RecibidoController',['except' => [], 'as'=>'ttl']);



		Route::post('bitacoras/anexo', ['as'=>'ttl.bitacoras.anexo','uses' =>'Titulares\BitacoraController@anexo']);

		Route::get('bitacoras/resultados', ['as'=>'ttl.bitacoras.resultados','uses' =>'Titulares\BitacoraController@search']);
		
		Route::resource('bitacoras', 'Titulares\BitacoraController',['except' => [], 'as'=>'ttl']);
	});

});

Auth::routes();
