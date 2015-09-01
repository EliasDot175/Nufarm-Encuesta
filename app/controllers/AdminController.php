<?php 

class AdminController extends BaseController {



     /* * *

     * * * METRICAS ENCUESTAS * * *

     * * */

    public function metricasEncuestas()

    {

        $encuesta = UsuarioEncuesta::all(); 

        //Datos encuesta y lista preguntas

        // $encuesta = 1;

        $preguntas = Pregunta::where('idEncuesta', 1)

                        ->where('activo',1)

                        ->join('tipo_dato','pregunta.tipo','=','tipo_dato.id')

                        ->join('identificacion_preguntas as id_preg','pregunta.identificacion','=','id_preg.id')

                        ->select('pregunta.id','pregunta.valor as valpregunta', 'pregunta.posicion as posicion','id_preg.valor as id_preg_valor','tipo_dato.valor as tipo_dato_valor')

                        ->orderBy('id','ASC')

                        ->get()

                        ->toArray();

        

        /**

         * @internal Tipos de respuesta:

         * @param text

         * @param null

         * @param Tsi-Tno-Tns/nc

         * @param e-mb-b-r-m-ns/nc

         * @param sub-text

         * @param comentario-acordeon

         * @param sub-mucho-poco-nada

         */

        

        $isnumeric = 0;
        $istext = 'A';


        foreach($preguntas as $key => $val):

            $respuestas = self::respuestas($val['id']);



            /**

             * @internal Prepend 0

             * Indentificador 

             */
            //numero
            if($val['id_preg_valor'] == 'numero'):

                $isnumeric++;

                if($isnumeric < 10):

                    $preguntas[$key]['identificador'] = '0'.$isnumeric;

                else:

                    $preguntas[$key]['identificador'] = $isnumeric;

                endif;

            else:

                $preguntas[$key]['identificador'] = false;

            endif;

            //letra
            if($val['id_preg_valor'] == 'letra'):

                if($istext == 'A'):

                    $preguntas[$key]['identificadorText'] = $istext;

                else:

                    $preguntas[$key]['identificadorText'] = $istext;

                endif;

                $istext++;

            else:

                $preguntas[$key]['identificadorText'] = false;

            endif;



            /**

             * @internal Evaluo las opciones de respuesta

             */



            if($val['tipo_dato_valor'] == "si-no"):

                /**

                 * @internal Private static method si_no

                 * @param  [Array ] $[respuestas] [Colleccion de respuestas]

                 * Devuelve el count de las respuestas <SI> y <NO>

                 */

                $preguntas[$key]['respuestas'] = self::si_no($respuestas);

            elseif ($val['tipo_dato_valor'] == "text"):

                /**

                 * @internal  Private static method value

                 * @param  [Array ] $[respuestas] [Colleccion de respuestas]

                 * @param  [String] $[keyset] [nombre del KEY que desea ser retornado por la colleccion]

                 */

                $preguntas[$key]['respuestas'] = self::value($respuestas,'valor');

                $preguntas[$key]['respuestas']['cantidad'] = count(self::value($respuestas,'valor'));



            elseif ($val['tipo_dato_valor'] == "e-mb-b-r-m-ns/nc"):

                /**

                 * @internal  Private static method calification

                 * @param  [Array ] $[respuestas] [Colleccion de respuestas]

                 */

                $preguntas[$key]['respuestas'] = self::calificacion($respuestas);



            elseif ($val['tipo_dato_valor'] == "sub-text"):

                /**

                 * @internal  Private static method value

                 * @param  [Array ] $[respuestas] [Colleccion de respuestas]

                 * @param  [String] $[keyset] [nombre del KEY que desea ser retornado por la colleccion]

                 */

                $preguntas[$key]['respuestas'] = self::value($respuestas,'valor');

                $preguntas[$key]['respuestas']['cantidad'] = count(self::value($respuestas,'valor'));



            elseif ($val['tipo_dato_valor'] == "Tsi-Tno-Tns/nc"):

                /**

                 * @internal  Private static method calification

                 * @param  [Array ] $[respuestas] [Colleccion de respuestas]

                 */



                $preguntas[$key]['respuestas'] = self::interesa($respuestas);

            

            elseif ($val['tipo_dato_valor'] == 'sub-mucho-poco-nada'):



                $preguntas[$key]['respuestas'] = self::mpn($respuestas);





            elseif ($val['tipo_dato_valor'] == "comentario-acordeon"):



                $preguntas[$key]['respuestas'] = self::value($respuestas,'valor');

                $preguntas[$key]['respuestas']['cantidad'] = count(self::value($respuestas,'valor'));

            endif;

            // $preguntas[$key]['respuestas'] =  Pregunta::find($val['id'])->respuestas()->get()->toArray();      

        endforeach;



        return View::make('admin.metricas')

        ->with('encuestas',$encuesta)

        ->with('preguntas',self::toObject($preguntas) );

    }





    /* * *

     * * * LISTA DE ENCUESTAS * * *

     * * */

    public function mostrarEncuestas()

    {

        $encuesta = UsuarioEncuesta::all(); 



        return View::make('admin.lista', array('encuestas' => $encuesta));

    }





    /* * *

     * * * VER ENCUESTA* * *

     * * */

    public function verEncuestas($id) //id usuario_encuesta

    {

        //respuestas

        $respuestas = DB::table('respuesta')->where('idUsuarioEncuesta', $id)->get();



         //usuario usuario_encuesta

        $usuarioEncuestas = DB::table('usuario_encuesta')->where('id', $id)->first();

        

        //usuario 

        $usuarioEncuesta = $usuarioEncuestas->idUsuario;

        $usuarios = DB::table('users')->where('id', $usuarioEncuesta )->first();



        return View::make('admin.ver', array( 'usuarios' => $usuarios, 'respuestas' => $respuestas));

    }









    private static function respuestas($id){

        return Pregunta::find($id)->respuestas()->get()->toArray();

    }



    private static function si_no($respuestas){

        $si = 0;

        $no = 0;

        $response = array();



        foreach($respuestas as $rkey => $rval):

            if($rval['valor'] == "si"):

                $si++;

            else:

                $no++;

            endif;

        endforeach;   

        $response['si'] = $si;

        $response['no'] = $no;

        return $response;

    }





    private static function calificacion($respuestas){

        $array = array(

            'exelente' => 0,

            'muy buena' => 0,

            'buena' => 0,
            
            'regular' => 0,

            'mala' => 0,

            'ns/nc' => 0

        );

        foreach($respuestas as $key => $val):

            $array[$val['valor']]++;

            // echo "<pre>";

            // print_r($val['valor']);

            // echo "</pre>";

        endforeach;



        // die();

        return $array;

    }



    private static function value($respuestas,$keyset){

        $array = array();

        foreach($respuestas as $key => $val):

            if(!empty($val)):

                array_push($array, $val[$keyset]);            

            endif;

        endforeach;

        return $array;

    }



    private static function interesa($respuestas){

        $array = array(

            'tengo interes' => 0,

            'no tengo interes' => 0,

            'ns/nc' => 0

        );

         foreach($respuestas as $key => $val):

            $array[strtolower($val['valor'])]++;

        endforeach;



        return $array;

    }



    private static function mpn($respuestas){

        $array = array(

            'mucho' => 0,

            'poco' => 0,

            'nada' => 0

        );

        foreach($respuestas as $key => $val):

            $array[strtolower($val['valor'])]++;

        endforeach;



        return $array;



    }







    private static function toObject($array){

        return json_decode(json_encode($array));

    }



    private static function line($id){

        echo("================================================================================ {{{{{{{ ".$id."  }}}}}}} =============================================================================");

    }















}

