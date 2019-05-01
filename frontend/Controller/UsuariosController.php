<?php
include_once 'Model/Usuarios.php';

class UsuariosController {
    private $usr;
    private $respuesta;

    public function __construct(){
        $this->usr = new Usuarios();
    }

    public function main(){
        if(isset($_GET['m'])){
            MessagesController::setMessage($_GET['m']);
        }

        include 'View/usuarios/usuarios.php';
    }

    public function nuevo(){
        include 'View/usuarios/registro.php';
    }

    public function editar(){
        $usr = new Usuarios();

        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            $_usuario = $this->usr->getById($_GET['id']);
        }

        include 'View/usuarios/edit_usuario.php';
    }

    public function guardar(){
        if (isset($_POST['user_name']) && isset($_POST['password']) && !empty($_POST['password'])) {
            $this->usr->setUser(strip_tags($_POST['user_name']));

            if (!$this->usr->checkUser()) {
                $this->usr->setPassword(strip_tags($_POST['password']));
                $this->usr->setEmail(strip_tags($_POST['email']));

                $this->respuesta = $this->usr->save();
            }

        }
        if($this->respuesta){
            header('Location: '.ADMIN_URL.'index.php?c=usuarios&m=n1-'.base64_encode($_POST['user_name']));
        }else{
            header('Location: '.ADMIN_URL.'index.php?c=usuarios&m=n0-'.base64_encode($_POST['user_name']));
        }
    }

    public function actualizar(){
        if (isset($_POST['user_name'])) {
            $this->usr->setUser(strip_tags($_POST['user_name']));
            $_user = $this->usr->checkUser();

            // Si no existe el usuario o es él mismo, podemos actualizar
            if (!$_user || $_user->id == $_POST['id']) {
                if (isset($_POST['change_passwd']) && isset($_POST['password'])) {

                    $equals = $this->usr->passwordsCompare($_POST['password'],$_POST['password_confirm']);
                    if ($equals) {
                        $this->usr->setPassword(strip_tags($_POST['password']));
                    }

                }

                $this->usr->setId(strip_tags($_POST['id']));
                $this->usr->setEmail(strip_tags($_POST['email']));
                $this->respuesta = $this->usr->updateUser();
            }

        }
        if($this->respuesta){
            header('Location: '.ADMIN_URL.'index.php?c=usuarios&m=u1-'.base64_encode($_POST['user_name']));
        }else{
            header('Location: '.ADMIN_URL.'index.php?c=usuarios&m=u0-'.base64_encode($_POST['user_name']));
        }
    }

    public function borrar(){
        if(isset($_GET['id'])){
            $this->usr->setId($_GET['id']);
            $_user = $this->usr->getById($_GET['id']);

            $this->respuesta = $this->usr->deleteUser();
        }

        if($this->respuesta){
            header('Location: '.ADMIN_URL.'index.php?c=usuarios&m=d1-'.base64_encode($_user->user));
        }else{
            header('Location: '.ADMIN_URL.'index.php?c=usuarios&m=d0-'.base64_encode($_user->user));
        }
    }
}
