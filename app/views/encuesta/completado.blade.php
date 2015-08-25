@extends('layouts.encuesta')

@section('sidebar')
     	@parent

@stop

@section('content')
       
	<!-- Preguntas -->
        	<div class="item-preguntas off">
                	<div class="contenido">
                     	<div  class="numero " to="1">
                                          <p>01</p>
                               </div>
                               <div class="numero " to="2">
                                          <p>02</p>    
                               </div>
                               <div   class="numero " to="3">
                                         <p>03</p>        
                               </div>
                               <div   class="numero " to="4">
                                          <p>04</p>        
                               </div>
                               <div  class="numero " to="5">
                                         <p>05</p>         
                               </div>
                               <div  class="numero " to="6">
                                         <p>06</p>        
                               </div>
                               <div  class="numero " to="7">
                                          <p>07</p>      
                               </div>
                               <div  class="numero " to="8">
                                         <p>08</p>         
                               </div>
                	</div>
        	</div>
        	<!-- //Preguntas -->
		
		
	<div class="mensaje">
		<h1 class="error"> {{ $encuesta->nombre }}</h1>
		<h2>Muchas gracias por participar de la encuesta.</h2>
          <div class="codigo">
                <div class="block-a">
                      {{ HTML::image('assets/imagenes/Nufarm-encuesta-sorteo.png', "Imagen no encontrada", array( 'class' => 'img', 'title' => 'barra')) }}
                      <p class="text-uppercase">PARA PARTICIPAR DEL SORTEO POR UNA CAMPERA NEXXT, GUARDE EL SIGUIENTE CÓDIGO</p>
                </div>
                <div class="block-b">
                      <p class="text-uppercase">{{ $codigo }}</p>
                </div>
                <div class="block-c">
                       <a href={{ URL::route('descargar', array('codigo' => $codigo) )}}>GUARDAR EN PDF</a>
                </div>            
          </div>
	</div>

@stop
