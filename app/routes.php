<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*Llamadas al controlador Auth*/
Route::get('login', 'AuthController@showLogin');
Route::post('login', 'AuthController@postLogin');
Route::get('logout', 'AuthController@logOut');

/*Rutas privadas solo para usuarios autenticados*/
Route::group(['before' => 'auth'], function()
{
	Route::get('/', array('as' => 'index', 'uses' => 'AdminController@metricasEncuestas'));
	Route::get('admin', array('as' => 'admin', 'uses' => 'AdminController@mostrarEncuestas'));
	Route::get('lista-encuestas', array('as' => 'lista-encuesta', 'uses' => 'AdminController@mostrarEncuestas'));
	Route::get('encuesta-detalle/{id}', array('as' => 'detalle-encuesta', 'uses'=>'AdminController@verEncuestas'));
	Route::get('metricas-encuestas', array('as' => 'metricas-encuesta', 'uses'=>'AdminController@metricasEncuestas'));
});

/*Rutas generales*/

//PDF
/*Route::get('generar', function()
{
    $html = '<html><body>';
    $html.= '<p style="color:red">Generando un sencillo pdf ';
    $html.= 'de forma realmente sencilla.</p>';
    $html.= '</body></html>';
    return PDF::load($html, 'A4', 'portrait')->show();
});

Route::get('vista', function()
{
    $html = View::make("encuesta.pdf");
    return PDF::load($html, 'A4', 'portrait')->show();
});
*/

Route::get('descargar/{codigo}',array('as' => 'descargar',function($codigo)
{
	$token = Session::get("_token");
    	$html = '<html>
    			<head>
		    	           <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		    	           <title>Nufarm - Encuesta</title>
		                        <title>Nufarm - Encuesta</title>
		                        <link media="all" type="text/css" rel="stylesheet" href="http://nufarm-maxx.com/encuesta/public/assets/css/bootstrap.min.css">
		                        <link media="all" type="text/css" rel="stylesheet" href="http://nufarm-maxx.com/encuesta/public/assets/css/estilos.css?ver=06-08">
		                        <link media="all" type="text/css" rel="stylesheet" href="http://nufarm-maxx.com/encuesta/public/assets/bootstrap-3.3.4/css/bootstrap.min.css">
                        	<head>
                      <body style="background-color: #EAEAEA;">';

    	$html  = ' <div style="background-color: #EAEAEA; float: left; height: 1000px;">
    			<img style="width: 100%" src="http://nufarm-maxx.com/encuesta/public/assets/imagenes/Nufarm-header.png" id="Nufarm" title="Nufarm" alt="Imagen no encontrada">
	    		<div class="mensaje">
	    			<img style="width: 460px; display:block; position: relative; margin-left:-230px; left: 50%; margin-top: 60px;" src="http://nufarm-maxx.com/encuesta/public/assets/imagenes/Nufarm-text.png" id="Nufarm" title="Nufarm" alt="Imagen no encontrada">
	    		
		                	<div class="block-b" style=" float: left;
								width: 200px;
								display: block;
								margin-left: -110px;
								border: dashed #666 1px;
								margin-top: 15px;
								height: 88px;
								position: relative;
			                      		    		left: 50%;
			                      		    		">
		                      		<p class="text-uppercase" style=" 
		                      				font-size: 57px; 
		                      				text-align: center;
		                      		    		margin: 0;
		                      		    		padding: 0;
		                      		    		width: 100%;
		                      		    		color: #777777;
		                      		    		padding-top: 8px;"
		                      		    		font:arial, sans-serif;>'
		                      		    	.$codigo.'
		                      		</p>
		                	</div>   

		                	<img style="width: 100%;position: absolute; bottom: 180px;" src="http://nufarm-maxx.com/encuesta/public/assets/imagenes/Nufarm-footer.png" id="Nufarm" title="Nufarm" alt="Imagen no encontrada">
	    		
	          		</div>
		</div>
	</div>';

	$html.= '</body></html>';

    	return PDF::load($html, 'A4', 'portrait')->download('Nufarm-Encuesta-Codigo');
    	//return PDF::load($html, 'A4', 'portrait')->show();
}));


Route::get('/formulario', function(){
    	$token = Session::get("_token");
	$preguntas = Session::get("preguntas");
	$email = Session::get("email");
	$nombre = Session::get("nombre");
	$empresa = Session::get("empresa");
	$datosEncuesta = Session::get("datosEncuesta");

	return View::make('encuesta.formulario', array('preguntas' => $preguntas, 'email' => $email, 'nombre' => $nombre, 'empresa' => $empresa, 'encuesta' => $datosEncuesta));

});

Route::get('/formulario-ok', function(){

	$mensaje = Session::get('mensaje');    
           $usuariosEmail = Session::get('usuariosEmail');    
           $datosEncuesta = Session::get('datosEncuesta');    
           $codigo = Session::get('codigo');  

	return View::make('encuesta.completado', array('mensaje' => $mensaje, 'usuario' => $usuariosEmail , 'encuesta' => $datosEncuesta, 'codigo' => $codigo));
});

Route::get('{email}/{nombre?}/{empresa?}', array('uses' => 'EncuestasController@formularioTokenEncuesta'));
Route::post('encuesta/usuario-identificado', array('as' => 'usuario-identificado', 'uses' => 'EncuestasController@formEncuesta'));
Route::post('crear/{encuesta}/{email}/{nombre?}/{empresa?}', array('as' => 'encuesta','uses' => 'EncuestasController@crearEncuesta'));



