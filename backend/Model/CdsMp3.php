<?php
require_once "BaseModel.php";
require_once "Catalogo.php";

class CdsMp3 extends BaseModel {
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

	public function getCdItems($id){
		$query = "SELECT artista,album,year,img_front,img_back FROM {$this->table2} WHERE cdmp3_id = {$id}";

		$results = $this->select($query);

		if ($results->num_rows == 1) {
		    $row = $results->fetch_object();
		    return $row;
		}

		while ($row = $results->fetch_object()) {
			$collection[] = $row;
		}

		return $collection;
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

	public function updateQty($id, $qty){
		$query = "UPDATE {$this->table} SET qty = qty+'{$qty}' WHERE id = '{$id}'";
		$result = $this->update($query);
		return $result;
	}

	public function newCd(){
		$expr_char = "/^[a-zA-Z0-9\-_]*/";
		$expr_num = "/^[0-9]*/";
		$result = false;

		if (preg_match($expr_char, $this->nombre)){
			$_nombre = $this->getBy('nombre',$this->nombre);

			if ($_nombre) {
				return $result;
			}

			$result = $this->save();
		}

		return $result;
	}

	public function updateCd($_iems=null){
		$expr_char = "/^[a-zA-Z0-9\-_]*/";
		$result = false;

		if (is_numeric($this->id) && preg_match($expr_char, $this->nombre)) {
			$_cd = $this->getBy('nombre',$this->nombre);

			$query = "UPDATE $this->table SET
					 	nombre = '{$this->nombre}',
					 	qty = '{$this->qty}'
					 	WHERE id = '{$this->id}'";

			if ($_cd){
				if ($_cd->id == $this->id) {
					$result = $this->update($query);
				}
			}else {
				$result = $this->update($query);
			}

		} // fin is_numeric

		return $result;
	}

	// Actualiza todos los items que se pasan en un array para que apunten a el cd actual
	public function addItemsToCd($items_id){
		$num = count($items_id);
		$_ids = implode(',', $items_id);
		$query = "UPDATE {$this->table2} SET cdmp3_id='{$this->id}' WHERE id IN ({$_ids})";

		if (is_numeric($this->id)){
			$result = $this->update($query);
		}

		if ($result) {
			$this->updateQty($this->id,$num);
		}

		return $result;
	}

	public function save(){
		$query = "INSERT INTO {$this->table} (id,nombre,qty) VALUES (NULL,'{$this->nombre}','{$this->qty}')";

		$result = $this->insert($query);

		return $result;
	}

	public function deleteCd(){
		$result = false;

		if (is_numeric($this->id)) {
			$_mp3 = new Catalogo();
			$_collection = $_mp3->getBy('cdmp3_id',$this->id);

			if ($_collection){
				// borra todos los índices que apuntan a este cd en la tabla de catalogo
				if (is_array($_collection)){
					foreach ($_collection as $_item) {
						$arr_ids[] = $_item->id;
					}

					$_ids = implode(',', $arr_ids);

				}else {
					$_ids = $_item->id;
				}

				$query = "UPDATE {$this->table2} SET cdmp3_id='' WHERE id IN ({$_ids})";
			}

			$result = $this->delete($this->id);
		}

		return $result;
	}
}
