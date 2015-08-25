@extends('layouts.master')



@section('sidebar')

     @parent

     <script  type="text/javascript" >

     	$(document).ready(function(){

		//mostrar categoria

		$("#metricas").css({

			color: '#fff',

    			background: '#0e7e02'

		});

	});

     </script>

@stop



@section('content')



<div class="metrica">

		

	@foreach($preguntas as $key => $pregunta)





			@if($pregunta->tipo_dato_valor == "si-no")

			<div class="pregunta preg{{$key}}">

				<div class="container nopd">

						@if($pregunta->identificador)

							<div class="col-md-1 vertical-align">

								@if($pregunta->identificador)

								<div class="identificador">

									{{$pregunta->identificador}}

								</div>

								@endif

							</div>

							<div class="col-md-6 question vertical-align">

								{{$pregunta->valpregunta}}

							</div>

							<div class="col-md-5  vertical-align">

								@foreach($pregunta->respuestas as $rkey => $rval )

									<div class="col-md-4">

										<p class="title-emb">{{$rkey}}</p>

										@if(max((Array)$pregunta->respuestas) == $rval )

										<div class="circle-val white-special">

											{{$rval}}

										</div>

										@else

										<div class="circle-val">

											{{$rval}}

										</div>

										@endif

									</div> 

								@endforeach

							</div>

						@endif

				</div>

			</div>

			@elseif($pregunta->tipo_dato_valor == "null")

			<div class="pregunta preg">

				<div class="container nopd h100">

						<div class="col-md-1 vertical-align">

							@if($pregunta->identificador)

							<div class="identificador">

								{{$pregunta->identificador}}

							</div>

							@endif

						</div>

						<div class="col-md-6 question vertical-align">

							{{$pregunta->valpregunta}}

						</div>

						<div class="col-md-5  vertical-align">

							

						</div>

				</div>

			</div>

			@elseif($pregunta->tipo_dato_valor == "e-mb-b-r-m-ns/nc")

			<div class="pregunta mt0 black">

				<div class="container nopd ">

						<div class="col-md-6 question ">
							@if($pregunta->identificadorText)
								<div class="identificador">
									{{$pregunta->identificadorText}}
								</div>
							@endif

							<h4 class="h4mdb">{{$pregunta->valpregunta}}</h4>
						</div>

						<div class="col-md-10 col-md-offset-2">

						@foreach($pregunta->respuestas as $rkey => $rval )

							<div class="col-md-2">

								<p class="title-emb">{{$rkey}}</p>

								@if(max((Array)$pregunta->respuestas) == $rval )

								<div class="circle-val white-special">

									{{$rval}}

								</div>

								@else

								<div class="circle-val">

									{{$rval}}

								</div>

								@endif

							</div> 

						@endforeach

						</div>

				</div>

			</div>

			@elseif($pregunta->tipo_dato_valor == "text")

			<div class="pregunta">

				<div class="container nopd">

						<div class="col-md-1 vertical-align">

							@if($pregunta->identificador)

							<div class="identificador">

								{{$pregunta->identificador}}

							</div>

							@endif

						</div>

						<div class="col-md-6 question vertical-align">

							{{$pregunta->valpregunta}}

						</div>

						<div class="col-md-5  vertical-align">

						</div>

				</div>

			</div>

			<div class="pregunta comment">

				<div class="container nopd">

						<div class="col-md-12">

						@if($pregunta->respuestas->cantidad > 0)

							<p  class="count-comments active-comment"> <span class="icon-comment"></span> <span class="big-number">{{$pregunta->respuestas->cantidad}}</span> Comentarios </p>

							<div class="comment-list col-md-12" >

							

							@foreach($pregunta->respuestas as $rkey => $rval)

								@if($rkey != "cantidad")

								<!-- Comments  -->

								 <div class="comment-item">

								 	{{$rval}}

								 </div>

								<!-- Comments  -->

								@endif

							@endforeach

							  

							</div>

							

						@else

							<p  class="count-comments"> <span class="icon-comment"></span> <span class="big-number">0</span> Comentarios </p>

						@endif

						</div>

				</div>

			</div>

			@elseif($pregunta->tipo_dato_valor == "comentario-acordeon")

			<div class="pregunta comment">

				<div class="container nopd">
				<div class="col-md-1 vertical-align">

							

						</div>

						<div class="col-md-12">

						@if($pregunta->respuestas->cantidad > 0)

							<p  class="count-comments active-comment"> <span class="icon-comment"></span> <span class="big-number">{{$pregunta->respuestas->cantidad}}</span> Comentarios </p>

							<div class="comment-list col-md-12" >

							

							@foreach($pregunta->respuestas as $rkey => $rval)

								@if($rkey != "cantidad")

								<!-- Comments  -->

								 <div class="comment-item">

								 	{{$rval}}

								 </div>

								<!-- Comments  -->

								@endif

							@endforeach

							  

							</div>

							

						@else

							<p  class="count-comments"> <span class="icon-comment"></span> <span class="big-number">0</span> Comentarios </p>

						@endif

						</div>

				</div>

			</div>

			@elseif($pregunta->tipo_dato_valor == "Tsi-Tno-Tns/nc")

			<div class="pregunta preg{{$key}}">

				<div class="container nopd">

						<div class="col-md-1 vertical-align">

							@if($pregunta->identificador)

							<div class="identificador">

								{{$pregunta->identificador}}

							</div>

							@endif

						</div>

						<div class="col-md-6 question vertical-align">

							{{$pregunta->valpregunta}}

						</div>

						<div class="col-md-5  vertical-align">

							<div class="col-md-12 ">

							@foreach($pregunta->respuestas as $rkey => $rval )

								<div class="col-md-4">

									<p class="title-emb">{{$rkey}}</p>

									@if(max((Array)$pregunta->respuestas) == $rval )

									<div class="circle-val white-special">

										{{$rval}}

									</div>

									@else

									<div class="circle-val">

										{{$rval}}

									</div>

									@endif

								</div> 

							@endforeach

							</div>

						</div>

				</div>

			</div>

			@elseif($pregunta->tipo_dato_valor == "sub-text")

			<div class="pregunta">

				<div class="container nopd">

						<div class="col-md-1 vertical-align">

							@if($pregunta->identificador)

							<div class="identificador">

								{{$pregunta->identificador}}

							</div>

							@endif

						</div>

						<div class="col-md-6 question vertical-align">

							{{$pregunta->valpregunta}}

						</div>

						<div class="col-md-5  vertical-align">

							

						</div>

				</div>

			</div>

			<div class="pregunta comment">

				<div class="container nopd">

						<div class="col-md-12">

						@if($pregunta->respuestas->cantidad > 0)

							<p  class="count-comments active-comment"> <span class="icon-comment"></span> <span class="big-number">{{$pregunta->respuestas->cantidad}}</span> Comentarios </p>

							<div class="comment-list col-md-12" >

							

							@foreach($pregunta->respuestas as $rkey => $rval)

								@if($rkey != "cantidad")

								<!-- Comments  -->

								 <div class="comment-item">

								 	{{$rval}}

								 </div>

								<!-- Comments  -->

								@endif

							@endforeach

							  

							</div>

							

						@else

							<p  class="count-comments"> <span class="icon-comment"></span> <span class="big-number">0</span> Comentarios </p>

						@endif

						</div>

				</div>

			</div>

			@elseif($pregunta->tipo_dato_valor == "sub-mucho-poco-nada")

			<div class="pregunta">

				<div class="container nopd">

						<div class="col-md-1 vertical-align">

							@if($pregunta->identificador)

							<div class="identificador">

								{{$pregunta->identificador}}

							</div>

							@endif

						</div>

						<div class="col-md-6 question vertical-align">

							{{$pregunta->valpregunta}}

						</div>

						<div class="col-md-5  vertical-align">

							<div class="col-md-12 ">

							@foreach($pregunta->respuestas as $rkey => $rval )

								<div class="col-md-4">

									<p class="title-emb">{{$rkey}}</p>

									@if(max((Array)$pregunta->respuestas) == $rval )

									<div class="circle-val white-special">

										{{$rval}}

									</div>

									@else

									<div class="circle-val">

										{{$rval}}

									</div>

									@endif

								</div> 

							@endforeach

							</div>

						</div>

				</div>

			</div>

			@endif

					







	@endforeach



</div>





<footer>

	<div class="extend">

		

	</div>

</footer>

@endsection

