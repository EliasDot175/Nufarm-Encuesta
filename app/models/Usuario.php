<?php 
// se debe indicar en donde esta la interfaz a implementar
use Illuminate\Auth\UserInterface;

class Usuario extends Eloquent { 
    protected $table = 'users';
    protected $fillable = array('nombre', 'correo', 'password');

    // este metodo se debe implementar por la interfaz
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    //este metodo se debe implementar por la interfaz
    // y sirve para obtener la clave al momento de validar el inicio de sesión
    public function getAuthPassword()
    {
        return $this->password;
    }

}
?>