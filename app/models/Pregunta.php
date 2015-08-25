<?php 

class Pregunta extends Eloquent {
    protected $table = 'pregunta';
    protected $fillable = array('nombre');



    public function respuestas(){
    	return $this->hasMany('Respuesta', 'idEncuestaPregunta','id');
    }

}

?>