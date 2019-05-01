<?php
include_once "BaseModel.php";

class Usuarios extends BaseModel{
	private $id;
	private $user;
	private $passwd;
	private $passwd2;
	private $email;
	private $table;
	const SALT = '$2a$07$sbZ6z1ZwkYxDvYM6pGETBuvrzDJZLYydnGN3Vz9rgan/Ypyh35elO';

	public function __construct(){
		$this->table = "usuarios";
		parent::__construct($this->table);
	}

	public function geId(){
		return $this->id;
	}

	public function getUser(){
		return $this->user;
	}

	public function getPassword(){
		return $this->passwd;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function setUser($user){
		$this->user = $user;
	}

	public function setPassword($passwd){
		$this->passwd = crypt($passwd, self::SALT);
	}

	public function passwordsCompare($p1, $p2){
		$result = false;

		if (strcmp($p1, $p2) === 0) {
    		$result = true;
    	}

    	return $result;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function checkUser(){
		$_user = $this->getBy('user', $this->user);

		return $_user;
	}

	public function checkLogin(){
		$result = false;
    	$query = "SELECT user, password FROM {$this->table} WHERE user = '{$this->user}'";

    	// Si la consulta tiene exito devuelve un objeto
    	$usr = $this->select($query);

    	if ($usr && strcmp($this->passwd, $usr->password) === 0) {
    		$result = true;
    	}

		$this->db->close();
        return $result;
    }

    public function updateUser(){
    	$result = false;
    	if (isset($this->passwd)) {
    		$query = "UPDATE $this->table SET
				 	user = '{$this->user}',
				 	password = '{$this->passwd}',
				 	email = '{$this->email}'
				 	WHERE id = '{$this->id}'";
    	}else {
	    	$query = "UPDATE $this->table SET
				 	user = '{$this->user}',
				 	email = '{$this->email}'
				 	WHERE id = '{$this->id}'";
		}

		$result = $this->update($query);
		return $result;
    }

	public function save(){
		$result = false;

		$query = "INSERT INTO {$this->table} (id,user,password,email) VALUES (NULL,'{$this->user}','{$this->passwd}','{$this->email}')";

		$result = $this->insert($query);

		return $result;
	}

	public function deleteUser(){
		$result = $this->delete($this->id);

		return $result;
	}
}

/*$us = new Usuarios();
$us->setUser('admin');
$us->setPassword('123456');
$us->setEmail('admin@server.com');
$us->save();*/
