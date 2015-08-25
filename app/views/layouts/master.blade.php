<!doctype html>

<html lang="en">

            <head>

                        <meta charset="UTF-8">

            	           <title>Nufarm - Encuesta</title>

                                {{ HTML::style('assets/bootstrap-3.3.4/css/bootstrap.min.css') }}

                                {{ HTML::style('assets/css/admin.css') }}

                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

                                <script src="assets/bootstrap-3.3.4/js/bootstrap.min.js"></script>

            </head>

            <body>

            

                            <!-- contenedor -->

                            <header>

                                <div class="logo-header"></div>

                            </header>

                            <div class="container-fluid no-pd">



                                        <nav class="nav navblack route-{{Route::currentRouteName()}}" role="navigation">

                                            <div class="container">

                                                <div class="row">

                                                     <div class="navbar-header col-md-7">

                                                        <h1 class="text-uppercase">Cantidad de Encuestas realizadas: <span>{{ $users = DB::table('usuario_encuesta')->count(); }}</span></h1>

                                                          <!--   <button type="button" class="navbar-toggle" data-toggle="collapse"

                                                                data-target=".navbar-ex1-collapse">

                                                                <span class="sr-only">Desplegar navegación</span>

                                                                <span class="icon-bar"></span>

                                                                <span class="icon-bar"></span>

                                                                <span class="icon-bar"></span>

                                                            </button> -->

                                                    </div>

                                                    <div class="pull-right col-md-3 ">

                                                        <ul class="nav-custom-black pull-right">

                                                            <li class="active"><a class="text-right" href="{{ url('/logout') }}">SALIR</a></li>

                                                            <li><a class="text-right text-uppercase" href="{{ URL::route('metricas-encuesta') }}" >resultados globales </a></li>

                                                            <li ><a class="text-right text-uppercase" href="{{ URL::route('lista-encuesta') }}" >LISTADO DE ENCUESTAS</a></li>

                                                        </ul>

                                                    </div>

                                                </div>

                                            </div>

                                        </nav>

                                        @section('sidebar')



                                                

                                        @show



                                        @yield('content')



                            </div>

                            <!-- //contenedor -->





        <script>

        console.log($('.ident').parent());

        jQuery(document).ready(function($) {

            // $('.ident').css('margin-top', $('.ident').parent().height() / 2);

            $.each($('.ident'), function(index, val) {

                var margintop = ($(val).parent().parent().height() - 50) / 2;

                $(val).css('margin-top', margintop);

            });

        });

        </script>

        </body>

</html>