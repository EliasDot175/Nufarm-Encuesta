<?php 



class EncuestasController extends BaseController {





    /* * * 

     * * * CREAR FORMULARIO  TOKEN * * *

     * * */

    public function formularioTokenEncuesta($email, $nombre = 'sin dato', $empresa = 'sin dato')

    {

        //Datos encuesta y lista preguntas

        $encuesta = 1;

        $preguntas = DB::table('pregunta')->where('idEncuesta', $encuesta)->get();

        $datosEncuesta = DB::table('encuesta')->where('id', $encuesta)->first();



        //Busca usuario por email

        $usuariosEmail = DB::table('users')->where('email', $email)->first();

        if ($usuariosEmail && $usuariosEmail != 'anónimo' ) {

            $mensaje =  'Usted ya ha completado la encuesta, sólo puede realizar esta acción una vez';

            $codigo = $usuariosEmail->codigo;

            Session::put('mensaje', $mensaje);    

            Session::put('usuariosEmail', $usuariosEmail);    

            Session::put('datosEncuesta', $datosEncuesta);    

            Session::put('codigo', $codigo);    

            //return View::make('encuesta.error', array('mensaje' => $mensaje, 'usuario' => $usuariosEmail , 'encuesta' => $datosEncuesta, 'codigo' => $codigo));

            return Redirect::to('/formulario-ok');

         }



        Session::put('preguntas', $preguntas);    

        Session::put('email', $email);    

        Session::put('nombre', $nombre);    

        Session::put('empresa', $empresa);    

        Session::put('datosEncuesta', $datosEncuesta);    



        return Redirect::to('/formulario');

    

    }







    /* * * 

     * * * CREAR ENCUESTA * * *

     * * */

         public function crearEncuesta($encuesta, $email, $nombre = 'sin dato', $empresa = 'sin dato')

    {

            if(Session::token() != Input::get('_token')) {

                die();

            }



             $respuesta = Input::all(); //array respuestas form //print_r($respuesta);

             $datosEncuesta = DB::table('encuesta')->where('id', $encuesta)->first();

             $cantidad= DB::table('pregunta')->where('idEncuesta', $encuesta)->count();



            //Inserta usuario por email e ip

            $ip=Request::getClientIp();


            $usuariosEmail = DB::table('users')->where('email', $email)->first();

            //codigo rand
            /*$usuariosEmail = DB::table('users')->where('email', $email)->first();
            $base = 1245;
            $cant= DB::table('users')->count();
            $random = $base + $cant;*/

            if (empty($usuariosEmail )) {
                    $x = new User();
                    $x->email =  $email;
                    $x->nombre =  $nombre;
                    $x->empresa =  $empresa;
                    $x->ip =  $ip;
                    $x->codigo = '';
                    $x->save();

                     //codigo
                    $usuarios = DB::table('users')->where('email', $email)->first();
                    $usuario =  $usuarios ->id;
                    $codigo= '12'.$usuario;
                    DB::table('users')
                    ->where('id', $usuario)
                    ->update(array('codigo' => $codigo));

            }else{

                $mensaje =  'Usted ya ha completado la encuesta, sólo puede realizar esta acción una vez';

                return View::make('encuesta.completado', array('mensaje' => $mensaje, 'encuesta' => $datosEncuesta));

            }



            $usuarios = DB::table('users')->where('email', $email)->first();

            $usuario =  $usuarios ->id;



            $codigo = $usuarios ->codigo;

            Session::put('codigo', $codigo);  



            //Inserta usuario_encuesta

            $x = new UsuarioEncuesta();

            $x->idUsuario = $usuario;

            $x->idEncuesta = $encuesta;

            $x->save();

            $usuarioEnc = DB::table('usuario_encuesta')->where('idUsuario', $usuario)->first();

            $usuarioEncuesta =  $usuarioEnc->id;



            //Inserta respuestas

            for ($i=1; $i <= $cantidad; $i++) { 

               

                    $valor = Input::get('pregunta'.$i);

                    if($valor  != ''){ 

                        $x = new Respuesta();

                        $x->idUsuarioEncuesta = $usuarioEncuesta;

                        $x->idEncuestaPregunta = $i;

                        $x->valor = $valor ;

                        $x->save();

                    }

                   

             }



              



            return Redirect::to('/formulario-ok');

             //return View::make('encuesta.completado', array('encuesta' => $datosEncuesta,'email' => $email, 'nombre' => $nombre, 'empresa' => $empresa, 'codigo' => $random));

    }

}

