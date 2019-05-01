<?php
require_once 'Model/Catalogo.php';
require_once 'Model/CdsMp3.php';

class OriginalController {
	private $original;
	private $respuesta;
    private $page;
    private $num_pages;
    private $ctrl = 'original';  //controlador

	public function __construct(){
		$this->original = new Catalogo();
	}

	public function main(){
        if(isset($_GET['m'])){
            MessagesController::setMessage($_GET['m']);
        }

    	include 'View/original/original.php';
	}

	public function nuevo(){
        include 'View/original/new_original.php';
    }

    public function editar(){
        $item = new Catalogo();

        if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0){
            $item = $this->original->getById($_GET['id']);
        }

        include 'View/original/edit_original.php';
    }

    public function guardar(){
        if(isset($_POST['artista']) && isset($_POST['album'])){
            $this->original->setArtista(strip_tags($_POST['artista']));
            $this->original->setAlbum(strip_tags($_POST['album']));

            if(isset($_POST['fecha'])){
                $this->original->setFecha(strip_tags($_POST['fecha']));
            }

            if(isset($_POST['genero'])){
                $this->original->setGenero(strip_tags($_POST['genero']));
            }

            if($_FILES['img_front']['error'] == 0){
                // pasamos el array $_FILES con los datos del fichero (nombre, tamaño, tmp...)
                $this->original->newImgFile($_FILES['img_front'],'front');
            }

            if($_FILES['img_back']['error'] == 0){
                $this->original->newImgFile($_FILES['img_back'],'back');
            }

            if(isset($_POST['soporte'])){ $this->original->setOriginal(strip_tags($_POST['soporte'])); }

            $this->respuesta = $this->original->newAlbum('original');
        }

        if($this->respuesta){
            header('Location: '.ADMIN_URL.'index.php?c=original&m=n1-'.base64_encode($_POST['artista'].' '.$_POST['album']));
        }else{
            header('Location: '.ADMIN_URL.'index.php?c=original&m=n0-'.base64_encode($_POST['artista'].' '.$_POST['album']));
        }
    }

    public function actualizar(){
        if(isset($_POST['id'])){
            $this->original->setId($_POST['id']);

            if(isset($_POST['artista'])){ $this->original->setArtista(strip_tags($_POST['artista'])); }
            if(isset($_POST['album'])){ $this->original->setAlbum(strip_tags($_POST['album'])); }
            if(isset($_POST['fecha'])){ $this->original->setFecha(strip_tags($_POST['fecha'])); }
            if(isset($_POST['genero'])){ $this->original->setGenero(strip_tags($_POST['genero'])); }

            if($_FILES['img_front']['error'] == 0){
                // pasamos el array $_FILES y el tipo de imagen
                $this->original->newImgFile($_FILES['img_front'],'front');
            }

            if($_FILES['img_back']['error'] == 0){
                $this->original->newImgFile($_FILES['img_back'],'back');
            }

            if(isset($_POST['del_front'])){ $this->original->deleteFile('front'); }
            if(isset($_POST['del_back'])){ $this->original->deleteFile('back'); }

            if(isset($_POST['soporte'])){ $this->original->setOriginal(strip_tags($_POST['soporte'])); }

            // Implide recoger valores distintos de 1 y 0 para el formato
            if ($_POST['mp3'] == 0 || $_POST['mp3'] == 1) {
                $this->original->setMp3($_POST['mp3']);
            }

            $this->respuesta = $this->original->updateAlbum('original');
        }

        if($this->respuesta){
            header('Location: '.ADMIN_URL.'index.php?c=original&m=u1-'.base64_encode($_POST['artista'].' '.$_POST['album']));
        }else{
            header('Location: '.ADMIN_URL.'index.php?c=original&m=u0-'.base64_encode($_POST['artista'].' '.$_POST['album']));
        }
    }

    public function borrar(){
        if(isset($_GET['id'])){
            $this->original->setId($_GET['id']);
            $_ori = $this->original->getById($_GET['id']);
            $this->respuesta = $this->original->deleteAlbum('original');
        }

        if($this->respuesta){
            header('Location: '.ADMIN_URL.'index.php?c=original&m=d1-'.base64_encode($_ori->artista.' '.$_ori->album));
        }else{
            header('Location: '.ADMIN_URL.'index.php?c=original&m=d0-'.base64_encode($_ori->artista.' '.$_ori->album));
        }
    }

    public function getAllOri(){
        $sort_by = "artista";   // columna ordenada por defecto
        $ordir = "ASC";         // dirección de ordenación (ASC/DESC) por defecto

        // Si exite una página la cargamos
        if (isset($_GET['p'])) {
            $this->page = $_GET['p'];
            // guardamos la página en una variable de sesión por si necesitamos volver.
            Session::set('page_ori', $this->page);

        // sino miramos en la variable de sesión por si venimos de una página en concreto
        } else if (isset($_SESSION['page_ori'])) {
            $this->page = $_SESSION['page_ori'];

        }else {
            $this->page = 1;
        }

        if (isset($_COOKIE['sort_ori'])) {
            $sort_by = $_COOKIE['sort_ori'];
        }else {
            setcookie("sort_ori",$sort_by,time()+10800,'/');    // cookie de 3 horas con la columna que se esta ordenando
        }

        if(!isset($_COOKIE['ori_ordir'])){
            setcookie("ori_ordir","ASC",time()+10800,'/');   // cookie de 3 horas con la dirección de ordenación (ASC/DESC)
        } else {
            $ordir = $_COOKIE['ori_ordir'];
        }

        // parámetros de la función: controlador, campo por el que se ordenan los registros, página actual, número de registros por página
        $this->respuesta = $this->original->getItemsPages($this->ctrl,$sort_by,$ordir,$this->page,REG_PAGE);

        if ($this->respuesta && !is_array($this->respuesta)) {
            $this->respuesta = array($this->respuesta);
        }

        return $this->respuesta;
    }

    public function getPager(){
        $this->num_pages = $this->original->getNumPages();

        include 'View/inc/pager.php';
    }

    public function getPage(){
        return $this->page;
    }

}
