<?php 

class Encuesta extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'encuesta';
    protected $fillable = array('nombre');
}

?>