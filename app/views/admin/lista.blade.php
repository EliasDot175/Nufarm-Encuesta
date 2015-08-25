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
	<div class="panel panel-success">
        		<h1 class="text-uppercase">Cantidad de Encuestas realizadas: <span>{{ $users = DB::table('usuario_encuesta')->count(); }}</span></h1>
        	</div>
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
