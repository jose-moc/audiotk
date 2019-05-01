<?php
include_once 'Model/AppConfig.php';

class ConfigController {
    private $conf;
    private $reg = array();
    private $respuesta;

    public function __construct(){
        $this->conf = new AppConfig();
    }

    public function main(){
        if(isset($_GET['m'])){
            MessagesController::setMessage($_GET['m']);
        }

        include 'View/configuracion.php';
    }

    public function actualizar(){
        if (isset($_POST['app_name'])){
            // el key del array equivale al id del registro
            $_key = key($_POST['app_name']);
            $this->reg[$_key] = $_POST['app_name'][$_key];
        }

        if (isset($_POST['url_base'])) {
            $_key = key($_POST['url_base']);
            $this->reg[$_key] = $_POST['url_base'][$_key];
        }

        if (isset($_POST['reg_page'])) {
            $_key = key($_POST['reg_page']);
            $this->reg[$_key] = $_POST['reg_page'][$_key];
        }

        if (isset($_POST['last_reg'])) {
            $_key = key($_POST['last_reg']);
            $this->reg[$_key] = $_POST['last_reg'][$_key];
        }

        if (isset($_POST['del_gen'])) {
            $_key = key($_POST['del_gen']);

            if (!empty($_POST['del_gen'][$_key])) {
                $arr_del = $_POST['del_gen'][$_key];
                $_gens = $this->conf->getGenders();
                $_gens = explode(',', $_gens->valor);

                // Recore el array con los géneros a eliminar
                foreach ($arr_del as $value) {
                    // Si encuenta el valor en el array de géneros actuales lo elimina del array
                    if($k = array_search($value, $_gens)){
                       unset($_gens[$k]);
                    }

                }
                $new_gens = implode(',', $_gens);
                // Se establecen los nuevos géneros por si tambien se quiere añadir despues
                $this->conf->setGenders($new_gens);
                $this->reg[$_key] = $new_gens;
            }
        }

        if (isset($_POST['add_gen'])) {
            $_key = key($_POST['add_gen']);

            if (!empty($_POST['add_gen'][$_key])) {
                $_gens = $this->conf->getGenders();

                // Si no se ha eliminado antes getGenders() devolvera un objeto
                if (is_object($_gens)) {
                    $this->reg[$_key] = $_gens->valor.','.$_POST['add_gen'][$_key];

                } else {
                    $this->reg[$_key] = $_gens.','.$_POST['add_gen'][$_key];
                }

            }
        }

        $this->respuesta = $this->conf->updateConf($this->reg);

        if($this->respuesta){
            header("Location: ".ADMIN_URL."index.php?c=config&m=".base64_encode('<div class="messages bg-success" >Configuración actualizada correctamente. </div>'));
        }else{
            header("Location: ".ADMIN_URL."index.php?c=config&m=".base64_encode('<div class="messages bg-danger">Error al actualizar la configuración.</div>'));
        }
    }

    public function logout(){
        session_start();
        session_destroy();
        header('Location: '.ADMIN_URL.'access');
    }
}
