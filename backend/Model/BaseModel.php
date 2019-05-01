<?php
require_once 'DataBase.php';

class BaseModel extends DataBase{
	private $table;
	private $collection = array();
	protected $db;

	public function __construct($table){
		$this->table = (string)$table;
		try{
			$this->db = DataBase::conexion();
		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function getConexion(){
		return $this->db;
	}

	public function getTable(){
		return $this->table;
	}

	public function getAll($order=null){
		if ($order) {
			$_query = "SELECT * FROM $this->table ORDER BY $order DESC";
		} else {
			$_query = "SELECT * FROM $this->table";
		}

		$result = $this->db->query($_query);

		if($result->num_rows > 0){

		    while ($row = $result->fetch_object()) {
				$this->collection[] = $row;
			}

			return $this->collection;
		}

		return false;
	}

	public function getById($id){
		$result = $this->db->query("SELECT * FROM $this->table WHERE id = '{$id}'");

		if($result->num_rows > 0){
			$row = $result->fetch_object();
			return $row;
		}

		return false;
	}

	public function getBy($column, $value, $order=null){
		if ($order) {
			$_query = "SELECT * FROM {$this->table} WHERE {$column} LIKE '{$value}' ORDER BY {$order}";
		} else {
			$_query = "SELECT * FROM {$this->table} WHERE {$column} LIKE '{$value}'";
		}

		return $this->select($_query);
	}

	public function select($query){
		$result = $this->db->query($query);

		if($result->num_rows > 0){
			if ($result->num_rows > 1) {
			    while ($row = $result->fetch_object()) {
					$this->collection[] = $row;
				}
			}else{
				$row = $result->fetch_object();
			    return $row;
			}

			return $this->collection;

		}else{
			return false;
		}
	}

	public function getNumRows($column=null,$value=null){
		// Si consulta personalizada
		if ($column !== null) {
			if ($column == 'original') {
				$result = $this->db->query("SELECT {$column} FROM {$this->table} WHERE {$column} != '{$value}'");
			}else {
				$result = $this->db->query("SELECT {$column} FROM {$this->table} WHERE {$column} = '{$value}'");
			}

		} else {
			$result = $this->db->query("SELECT id FROM $this->table");
		}

		// devuelve el número de líneas
		return $result->num_rows;
	}

	public function insert($query){
		$result = $this->db->query($query);
		$this->db->close();
		return $result;
	}

	public function update($query){
		$result = $this->db->query($query);

		return $result;
	}

	public function delete($id){
		$result = $this->db->query("DELETE FROM $this->table WHERE id = $id");
		$this->db->close();
		return $result;
	}

}
