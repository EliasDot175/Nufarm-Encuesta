@extends('layouts.master')



@section('sidebar')

     @parent

     <script  type="text/javascript" >

     	$(document).ready(function(){

		//mostrar categoria

		$("#lista-encuestas").css({

			color: '#fff',

    			background: '#0e7e02'

		});

	});

     </script>

@stop



@section('content')


	<table class="table table-striped">

		<thead>

			<tr>

				<th> Código </th>

		             	<th> Nombre </th>

		             	<th> Empresa </th>

		             	<th> Email </th>

		             	<th> Detalle </th>

		            </tr>

		</thead>

		<tbody>

  			@foreach($encuestas as $encuesta)

			             <tr>

			             	<?php  

				   		$usuarios = $encuesta->idUsuario;

				  		$usuario = DB::table('users')->where('id', $usuarios)->first();

				        	?>

				        	<td >{{ $usuario ->codigo}}</td> 

			             	<td >{{ $usuario ->nombre}}</td>

			             	<td >{{ $usuario ->empresa}}</td>

			             	<td >{{ $usuario ->email }}</td>

			              	<td>{{ HTML::link( 'encuesta-detalle/'.$encuesta->id , 'ver' ) }}</td>

			             </tr>

    			@endforeach

	       	</tbody>

	</table>



@stop

