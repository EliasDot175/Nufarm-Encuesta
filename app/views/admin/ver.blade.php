@extends('layouts.master')



@section('sidebar')

     @parent

@stop



@section('content')



	<div class="panel panel-success">

        		<h1 class="text-uppercase">Usuario: {{ $usuarios->email }}</h1>

        	</div>



     	@foreach($respuestas as $respuesta)

     		<ul class="list-group">

        			<?php  

       				$pregunta = $respuesta->idEncuestaPregunta;

      				$preguntas = DB::table('pregunta')->where('id', $pregunta)->first();

	        		?>

	       	 	<li class="list-group-item">  {{ $preguntas->valor }}</li>

	        		<li class="list-group-item">  {{ $respuesta->valor }}</li>

	        	</ul>

	        	<br>

	@endforeach



@stop