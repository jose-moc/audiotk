<?php
include_once 'Model/Usuarios.php';

class AccessController {
    private $usr;
    private $respuesta;

    public function __construct(){
        $this->usr = new Usuarios();
    }

    public function main(){
        include 'View/usuarios/login.php';
    }

    public function login(){
        if (isset($_POST['user']) && isset($_POST['passwd'])) {
            $this->usr->setUser(strip_tags($_POST['user']));
            $this->usr->setPassword(strip_tags($_POST['passwd']));

            // si existe, devuelve true.
            $this->respuesta = $this->usr->checkLogin();
        }

        if($this->respuesta){
            $_user = new Usuarios();
            $_usuario = $_user->getBy('user', $_POST['user']);
            Session::set('user', $_usuario->user);
            Session::set('user_id', $_usuario->id);

            header('Location: '.ADMIN_URL.'main');
        }else{
            header('Location: '.ADMIN_URL.'access');
        }
    }

    public function logout(){
        Session::destroy();
        header('Location: '.ADMIN_URL.'access');
    }
}
