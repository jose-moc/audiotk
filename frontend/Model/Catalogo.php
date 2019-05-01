<?php
require_once "Base.php";

class Catalogo extends Base{
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


}
