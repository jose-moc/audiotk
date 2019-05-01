<?php
require_once "BaseModel.php";
require_once "app/Uploads.php";

class Catalogo extends BaseModel{
	private $id;
	private $artista;
	private $album;
	private $fecha;
	private $genero;
	private $img_front;
	private $img_back;
	private $front_data;
	private $back_data;
	private $mp3;
	private $original;
	private $cdmp3_id;
	private $table;
	private $save_f = false;
	private $save_b = false;
	private $del_f = false;
	private $del_b = false;
	private $number_of_pages=1;

	public function __construct(){
		$this->table = 'catalogo';
		parent::__construct($this->table);
	}

	public function geId(){
		return $this->id;
	}

	public function getArtista(){
		return $this->artista;
	}

	public function getAlbum(){
		return $this->album;
	}

	public function getFecha(){
		return $this->fecha;
	}

	public function getGenero(){
		return $this->genero;
	}

	public function getMp3(){
		return $this->mp3;
	}

	public function getOriginal(){
		return $this->original;
	}

	public function getImgFront(){
		return $this->img_front;
	}

	public function getImgBack(){
		return $this->img_back;
	}

	public function getCdId(){
		return $this->cdmp3_id;
	}

	// mp3 hijos de un cd
	public function getChild($cd_id){
		$children = $this->getBy('cdmp3_id',$cd_id,'artista');

		// La vista Cds espera un array de objetos
		if ($children && !is_array($children)) {
			$children = array($children);
		}

		return $children;
	}

	// mp3 sin cd asignado
	public function getMp3Free(){
		$query = "SELECT * FROM {$this->table} WHERE mp3 = '1' AND cdmp3_id = '0' ORDER BY 'artista'";
		$result = $this->select($query);

		return $result;
	}

	public function getLastItems($limit=5){
		$query = "SELECT * FROM {$this->table} ORDER BY id DESC LIMIT {$limit}";
		$result = $this->select($query);

		return $result;
	}

	public function getItemsPages($type, $column, $ordir, $page, $reg_page){
		$init = ($page > 1) ? (($page * $reg_page) - $reg_page) : 0;

		if ($type == 'mp3') {
			$_query = "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->table} WHERE {$type} = '1' ORDER BY {$column} {$ordir} LIMIT {$init},{$reg_page}";

		} else {
			$_query = "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->table} WHERE {$type} NOT LIKE '0' ORDER BY {$column} {$ordir} LIMIT {$init},{$reg_page}";
		}


		$result = $this->select($_query);

		$rows = $this->select("SELECT FOUND_ROWS() as total");
		$total_reg = $rows->total;

		$this->number_of_pages = ceil($total_reg/$reg_page);

		return $result;
	}

	public function getNumPages(){
		return $this->number_of_pages;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function setArtista($artista){
		$this->artista = $this->db->real_escape_string($artista);
	}

	public function setAlbum($album){
		$this->album = $this->db->real_escape_string($album);
	}

	public function setFecha($fecha){
		$this->fecha = $fecha;
	}

	public function setGenero($gen){
		$this->genero = $gen;
	}

	public function setImgFront($img_front){
		$this->img_front = $img_front;
	}

	public function setImgBack($img_back){
		$this->img_back = $img_back;
	}

	public function setMp3($val){
		$this->mp3 = (int)$val;
	}

	public function setOriginal($val){
		$this->original = $val;
	}

	public function setCdId($cdmp3){
		$this->cdmp3_id = $cdmp3;
	}

	public function checkAlbum($a){
		$_album = $this->getBy('album', $a);

		return $_album;
	}

	public function newImgFile($data, $_type){
		if ($_type == 'front') {
			$this->front_data = $data;

		} else if ($_type == 'back') {
			$this->back_data = $data;
		}
	}

	public function deleteFile($_type){
		if ($_type == 'front') {
			$this->del_f = true;

		} else if ($_type == 'back') {
			$this->del_b = true;
		}
	}

	public function newAlbum($format){
		$expr_char = "/[a-zA-Z0-9\-_\:]*/";
		$expr_num = "/^[0-9]*/";
		$result = false;

		if (preg_match($expr_char, $this->artista) && preg_match($expr_char, $this->album)){

			$_row = $this->getBy('album',$this->album);

			if($_row){
				// strcasecmp — Comparación de string segura a nivel binario e insensible a mayúsculas y minúscula
				// Evita registros duplicados
				if (strcasecmp($_row->artista, $this->artista) == 0 && strcasecmp($_row->album, $this->album) == 0){
					// Si exite el registro y es mp3 u original solo actualizamos el formato
					if ($format == 'mp3') {
						$query = "UPDATE $this->table SET mp3 = '1' WHERE id = '{$_row->id}'";
						$result = $this->update($query);

					} else {
						$query = "UPDATE $this->table SET original = '1' WHERE id = '{$_row->id}'";
						$result = $this->update($query);
					}

					return $result;
				}
			}

			if (isset($this->front_data)){
				$_front = new Uploads($this->front_data);

				if($_front->validateFile()){
					$front_name = $_front->setFileName();
					$this->setImgFront($front_name);
					$this->save_f = true;
				}
			}

			if (isset($this->back_data)){
				$_back = new Uploads($this->back_data);

				if($_back->validateFile()){
					$back_name = $_back->setFileName();
					$this->setImgBack($back_name);
					$this->save_b = true;
				}
			}

			if($format == 'mp3'){
				$this->setOriginal(0);
			} else {
				$this->setMp3(0);
			}

			if (!is_numeric($this->cdmp3_id) && $this->cdmp3_id != ''){
				return $result;
			}

			$result = $this->save();

			if($result){
				// si la consulta a la base de datos es correcta guarda los ficheros
				if($this->save_f){ Uploads::saveFile($this->front_data['tmp_name'], $front_name); }
				if($this->save_b){ Uploads::saveFile($this->back_data['tmp_name'], $back_name); }
			}

		}

		return $result;
	}

	public function updateAlbum($format){
		$expr_char = "/[a-zA-Z0-9\-_\:]*/";
		$result = false;

		if (is_numeric($this->id)) {
			// obtenemos el album a editar
			$_item = $this->getById($this->id);

			if (preg_match($expr_char, $this->artista) && preg_match($expr_char, $this->album)){

				if (!is_numeric($this->fecha) && $this->fecha != ''){
					return $result;
				}

				if (isset($this->front_data)){
					$_front = new Uploads($this->front_data);

					if($_front->validateFile()){
						$front_name = $_front->setFileName();
						$this->setImgFront($front_name);
						$this->save_f = true;
					}

				} else if($_item->img_front){
					// si existe una imagen y no se modifica, dejamos ruta existente
					$this->img_front = $_item->img_front;
				}

				if (isset($this->back_data)){
					$_back = new Uploads($this->back_data);

					if($_back->validateFile()){
						$back_name = $_back->setFileName();
						$this->setImgBack($back_name);
						$this->save_b = true;
					}

				}else if($_item->img_back){
					$this->img_back = $_item->img_back;
				}

				// Si queremos borrar la imagen sin guardar otra, vaciamos el registro en la base de datos
				if($this->del_f && !$this->save_f){
					$this->img_front = '';
				}

				if($this->del_b && !$this->save_b){
					$this->img_back = '';
				}

				if (!is_numeric($this->cdmp3_id) && $this->cdmp3_id != ''){
					return $result;
				}

				$query = "UPDATE $this->table SET
					 	artista = '{$this->artista}',
					 	album = '{$this->album}',
					 	fecha = '{$this->fecha}',
					 	genero = '{$this->genero}',
					 	img_front = '{$this->img_front}',
					 	img_back = '{$this->img_back}',
					 	mp3 = '{$this->mp3}',
					 	original = '{$this->original}',
					 	cdmp3_id = '{$this->cdmp3_id}'
					 	WHERE id = '{$this->id}'";

				$result = $this->update($query);
			}

		} // fin is_numeric

		if($result){
			// si la consulta a la base de datos es correcta guarda los ficheros
			if($this->save_f){ Uploads::saveFile($this->front_data['tmp_name'], $front_name); }
			if($this->save_b){ Uploads::saveFile($this->back_data['tmp_name'], $back_name); }
			// elimina el fichero
			if($this->del_f && is_file($_item->img_front)){ unlink($_item->img_front); }
			if($this->del_b && is_file($_item->img_back)){ unlink($_item->img_back); }
		}

		return $result;
	}

	public function deleteAlbum($format){
		$result = false;

		if (is_numeric($this->id)) {
			$_item = $this->getById($this->id);

			// Si es mp3 y existe original actualizamos el formato y viceversa
			if ($format == 'mp3' && $_item->original == 1) {
				$this->deleteCdId($_item->cdmp3_id);	// Lo eliminamos del cd
				$query = "UPDATE $this->table SET mp3 = '0' WHERE id = '{$this->id}'";

				$result = $this->update($query);

			} else if ($format == 'original' && $_item->mp3 == 1) {
				$query = "UPDATE $this->table SET original = '0' WHERE id = '{$this->id}'";

				$result = $this->update($query);

			// Si solo existe un formato elimina el registro completo
			} else {
				if(is_file($_item->img_front)){ $this->del_f = true; }
				if(is_file($_item->img_back)){ $this->del_b = true; }

				$result = $this->delete($_item->id);

				if($result){
					// elimina el fichero
					if($this->del_f){ unlink($_item->img_front); }
					if($this->del_b){ unlink($_item->img_back); }
				}
			}
		}

		return $result;
	}

	public function deleteCdId($cd_id){
		$query = "UPDATE $this->table SET cdmp3_id = '' WHERE cdmp3_id = '{$cd_id}'";

		$result = $this->update($query);
	}

	public function save(){
		$result = false;
		$query = "INSERT INTO $this->table (id,artista,album,fecha,genero,img_front,img_back,mp3,original,cdmp3_id) VALUES (NULL,'{$this->artista}','{$this->album}','{$this->fecha}','{$this->genero}','{$this->img_front}','{$this->img_back}','{$this->mp3}','{$this->original}','{$this->cdmp3_id}')";

		$result = $this->insert($query);

		return $result;
	}
}
