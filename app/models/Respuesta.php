<?php 

class Respuesta extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'respuesta';
    protected $fillable = array('valor', 'idUsuarioEncuesta', 'idEncuestaPregunta', 'valor', 'comentario');



    

}

?>