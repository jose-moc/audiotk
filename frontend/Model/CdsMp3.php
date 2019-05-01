<?php
require_once "Base.php";
require_once "Catalogo.php";

class CdsMp3 extends Base {
	private $id;
	private $nombre;
	private $qty;
	private $table = 'cds_mp3';
	private $table2 = 'catalogo';
	private $num_pages=1;

	public function __construct(){
		parent::__construct($this->table);
	}

	public function setName($name){
		$this->nombre = $name;
	}

	public function setQty($qty){
		$this->qty = $qty;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function getName(){
		return $this->nombre;
	}

	public function getQty(){
		return $this->qty;
	}

	public function getNumPages(){
		return $this->num_pages;
	}

	public function getCdPages($order=null, $page, $reg_page){
		$init = ($page > 1) ? (($page * $reg_page) - $reg_page) : 0;

		if ($order) {
			$_query = "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->table} ORDER BY {$order} LIMIT {$init},{$reg_page}";
		} else {
			$_query = "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->table} LIMIT {$init},{$reg_page}";
		}

		$result = $this->select($_query);

		$rows = $this->select("SELECT FOUND_ROWS() as total");
		$total_reg = $rows->total;

		$this->num_pages = ceil($total_reg/$reg_page);

		return $result;
	}

}
