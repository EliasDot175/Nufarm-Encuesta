<?php 

class UsuarioEncuesta extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'usuario_encuesta';
    protected $fillable = array('idUsuario', 'idEncuesta');
}

?>