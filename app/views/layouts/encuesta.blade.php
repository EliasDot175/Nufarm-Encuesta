<!DOCTYPE html>

<html lang="es">

            <head>

    	           <meta charset="UTF-8">

                      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    	           <title>Nufarm - Encuesta</title>

                        {{HTML::style('assets/css/bootstrap.min.css')}}

                        {{HTML::style('assets/css/estilos.css')}}

                        {{ HTML::style('assets/bootstrap-3.3.4/css/bootstrap.min.css') }}

                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

             </head>



             <body>

                    <!-- contenedor -->

                    <div class="contenedor-encuesta">

                                <!-- head -->

                                <div class="head">

                                        <div class="contenido">

                                                {{ HTML::image('assets/imagenes/Nufarm-max-logo.png', "Imagen no encontrada", array('id' => 'Nufarm', 'title' => 'Nufarm')) }}

                                                <div class="block-terminos">

                                                        <p class="terminos item-a">Encuesta de Satifacción </p>   

                                                        <p class="terminos item-a">del Programa Marketing Net </p> 

                                                        <p class="terminos item-a"> Campaña 2014/15 </p>  

                                                <div class="sepadador"></div>

                                                        <p class="terminos item-b text-uppercase">La participación en esta encuesta</p>   

                                                        <p class="terminos item-b text-uppercase">y sorteo es totalmente anónima.</p>    

                                                </div>

                                        </div>

                                        

                                </div>

                                <!-- //head -->

                        

                                @section('sidebar')

              

                                @show



                                @yield('content')



                                



                       

     

                    </div>

                    <!-- contenedor -->

                     <div class="footer">

                                        {{ HTML::image('assets/imagenes/Nufarm-max-logo-verde.png', "Imagen no encontrada", array('id' => 'Nufarm', 'title' => 'Nufarm')) }}

                        </div>

                    

                    {{ HTML::script('assets/bootstrap-3.3.4/js/bootstrap.min.js') }}

                    {{ HTML::script('assets/js/eventos.js') }}

                    {{ HTML::script('assets/js/modernizr.js') }}



             </body>

</html>