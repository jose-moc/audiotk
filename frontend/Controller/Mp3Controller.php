<?php
require_once 'Model/Catalogo.php';
require_once 'Model/CdsMp3.php';

class Mp3Controller {
	private $mp3;
	private $respuesta;
	private $page;
	private $num_pages;
	private $ctrl = 'mp3';	//controlador

	public function __construct(){
		$this->mp3 = new Catalogo();
	}

	public function main(){
		if(isset($_GET['m'])){
			MessagesController::setMessage($_GET['m']);
		}
		$this->mp3 = new Catalogo();
    	include 'View/mp3/mp3.php';
	}

	public function nuevo(){
    	include 'View/mp3/new_mp3.php';
	}

	public function editar(){
		$item = new Catalogo();

		if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0){
			$item = $this->mp3->getById($_GET['id']);
		}

    	include 'View/mp3/edit_mp3.php';
	}

	public function guardar(){
		if(isset($_POST['artista']) && isset($_POST['album'])){
			$this->mp3->setArtista(strip_tags($_POST['artista']));
			$this->mp3->setAlbum(strip_tags($_POST['album']));

			if(isset($_POST['fecha'])){
				$this->mp3->setFecha(strip_tags($_POST['fecha']));
			}

			if(isset($_POST['genero'])){
				$this->mp3->setGenero(strip_tags($_POST['genero']));
			}

			if($_FILES['img_front']['error'] == 0){
				// pasamos el array $_FILES con los datos del fichero (nombre, tamaño, tmp...)
				$this->mp3->newImgFile($_FILES['img_front'],'front');
			}

			if($_FILES['img_back']['error'] == 0){
				$this->mp3->newImgFile($_FILES['img_back'],'back');
			}

			if(isset($_POST['cdmp3_id'])){
				$cd_id = strip_tags($_POST['cdmp3_id']);
				$this->mp3->setCdId($cd_id);

				if ($cd_id > 0) {
					$new_cd_qty = 1;
				}
			}

			$this->mp3->setMp3(1);  // configura el formato a mp3

			$this->respuesta = $this->mp3->newAlbum('mp3');
		}

		if($this->respuesta){
			if (isset($new_cd_qty)) {
				$_cd = new CdsMp3();
				$_cd->updateQty($cd_id, $new_cd_qty);
			}

			header('Location: '.ADMIN_URL.'index.php?c=mp3&m=n1-'.base64_encode($_POST['artista'].' - '.$_POST['album']));
		}else{
			header('Location: '.ADMIN_URL.'index.php?c=mp3&m=n0-'.base64_encode($_POST['artista'].' - '.$_POST['album']));
		}
	}

	public function actualizar(){
		if(isset($_POST['id'])){
			$this->mp3->setId($_POST['id']);

			if(isset($_POST['artista'])){ $this->mp3->setArtista(strip_tags($_POST['artista'])); }
			if(isset($_POST['album'])){ $this->mp3->setAlbum(strip_tags($_POST['album'])); }
			if(isset($_POST['fecha'])){ $this->mp3->setFecha(strip_tags($_POST['fecha'])); }
			if(isset($_POST['genero'])){ $this->mp3->setGenero(strip_tags($_POST['genero'])); }

			if($_FILES['img_front']['error'] == 0){
				// pasamos el array $_FILES y el tipo de imagen
				$this->mp3->newImgFile($_FILES['img_front'],'front');
			}

			if($_FILES['img_back']['error'] == 0){
				$this->mp3->newImgFile($_FILES['img_back'],'back');
			}

			if(isset($_POST['del_front'])){ $this->mp3->deleteFile('front'); }
			if(isset($_POST['del_back'])){ $this->mp3->deleteFile('back'); }

			// recoge el soporte para el formato original
            if (isset($_POST['ori'])) {
                $this->mp3->setOriginal($_POST['ori']);
            }

            // Si lo quitamos de mp3 y existe en originales (para que no se quede perdido en la ddbb)
            if($_POST['rm-mp3'] == 1 && $_POST['ori'] != 0){
				$this->mp3->setMp3(0);
				$_POST['cdmp3_id'] = 0;
			}else {
				$this->mp3->setMp3(1);  // Configuramos como mp3
			}

			if(isset($_POST['cdmp3_id'])){
				$cd_id = $_POST['cdmp3_id'];
				$this->mp3->setCdId($cd_id);

				// Recogemos los valores del mp3 actual antes de ser actualizado
				$mp3_init = $this->mp3->getById($_POST['id']);

				// Si no se asigna ningún cd y tampoco pertenece a ninguno lo dejamos como esta
				if ((empty($cd_id) || $cd_id == 0) && $mp3_init->cdmp3_id == 0){
					$this->mp3->setCdId(0);

				// Si no se asigna ningún cd pero pertenece a uno se lo restamos a ese cd
				} else if ((empty($cd_id) || $cd_id == 0) && $mp3_init->cdmp3_id > 0){
					$new_cd_qty = -1;
					$cd_id = $mp3_init->cdmp3_id;

				// Si se asigna un cd pero pertenece a otro
				} else if ($cd_id != $mp3_init->cdmp3_id) {
					// al cd actual le restamos 1
					$actual_cd_qty = -1;

					// al nuevo cd le sumamos 1
					$new_cd_qty = 1;
				}
			}

			$this->respuesta = $this->mp3->updateAlbum('mp3');
		}

		if($this->respuesta){
			if (isset($new_cd_qty)) {
				$_cd = new CdsMp3();
				$_cd->updateQty($cd_id, $new_cd_qty);

				if (isset($actual_cd_qty)) {
					$_cd->updateQty($mp3_init->cdmp3_id, $actual_cd_qty);
				}
			}

			header('Location: '.ADMIN_URL.'index.php?c=mp3&m=u1-'.base64_encode($_POST['artista'].' - '.$_POST['album']));
		}else{
			header('Location: '.ADMIN_URL.'index.php?c=mp3&m=u0-'.base64_encode($_POST['artista'].' - '.$_POST['album']));
		}
	}

	public function borrar(){
		if(isset($_GET['id'])){
			$this->mp3->setId($_GET['id']);
			$_mp3 = $this->mp3->getById($_GET['id']);

			// si pertenece a un cd le restamos 1 ala cantidad el cd
			if ($_mp3->cdmp3_id > 0) {
				$new_cd_qty = -1;
			}

			$this->respuesta = $this->mp3->deleteAlbum('mp3');
		}

		if($this->respuesta){
			if (isset($new_cd_qty)) {
				$_cd = new CdsMp3();
				$_cd->updateQty($_mp3->cdmp3_id, $new_cd_qty);
			}

			header('Location: '.ADMIN_URL.'index.php?c=mp3&m=d1-'.base64_encode($_mp3->artista.' - '.$_mp3->album));
		}else{
			header('Location: '.ADMIN_URL.'index.php?c=mp3&m=d0-'.base64_encode($_mp3->artista.' - '.$_mp3->album));
		}
	}

	public function getAllMp3(){
		$sort_by = "artista";	// columna ordenada por defecto
		$ordir = "ASC";			// dirección de ordenación (ASC/DESC) por defecto

		// Si exite una página la cargamos
        if (isset($_GET['p'])) {
            $this->page = $_GET['p'];
            // guardamos la página en una variable de sesión por si necesitamos volver.
            Session::set('page_mp3', $this->page);

        // sino miramos en la variable de sesión por si venimos de una página en concreto
        } else if (isset($_SESSION['page_mp3'])) {
            $this->page = $_SESSION['page_mp3'];

        }else {
            $this->page = 1;
        }

        if (isset($_COOKIE['sort_mp3'])) {
            $sort_by = $_COOKIE['sort_mp3'];
        } else {
        	setcookie("sort_mp3",$sort_by,time()+10800,'/');	// cookie de 3 horas con la columna que se esta ordenando
        }

        if(!isset($_COOKIE['mp3_ordir'])){
            setcookie("mp3_ordir","ASC",time()+10800,'/');   // cookie de 3 horas con la dirección de ordenación (ASC/DESC)
        } else {
            $ordir = $_COOKIE['mp3_ordir'];
        }

		// parámetros de la función: controlador, campo por el que se ordenan los registros, página actual, número de registros por página
		$this->respuesta = $this->mp3->getItemsPages($this->ctrl,$sort_by,$ordir,$this->page,REG_PAGE);

		if ($this->respuesta && !is_array($this->respuesta)) {
            $this->respuesta = array($this->respuesta);
        }

		return $this->respuesta;
	}

	public function getPage(){
		return $this->page;
	}

	public function getPager(){
        $this->num_pages = $this->mp3->getNumPages();

        include 'View/inc/pager.php';
    }

	public function getCds($id=null){
		$cds = new CdsMp3();

		// Si existe una id, traemos solo ese cd. Si no traemos todos los cds
		if (isset($id)) {
			$this->respuesta = $cds->getById($id);
		} else {
			$this->respuesta = $cds->getAll();
		}

		return $this->respuesta;
	}
}
