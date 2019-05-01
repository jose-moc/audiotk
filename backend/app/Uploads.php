<?php
class Uploads {
	const FILE_PATH = '../media/covers/';
	private $data_file;

	// La función recibe como argumento el array $_FILES
	public function __construct($data){
		$this->data_file = $data;

		// creamos el directorio si no existe.
		if (!file_exists(self::FILE_PATH)) {
		    mkdir(self::FILE_PATH, 0775, true);
		}
	}

	public function setFileName(){
		$name = $this->data_file['name'];
		$file = self::FILE_PATH.$name;  // ruta + nobre de archivo

		// Si el fichero existe lo renombra para no sobreescribirlo
		while (file_exists($file)) {
			$name = $this->newFileName($name);
			$file = self::FILE_PATH.$name;
		}

		return $name;
	}

	private function newFileName($name){
		$arr_name = explode('.', $name);
		$ext = array_pop($arr_name); 	//separa la extensión del archivo.

		// Buscar y contar las coincidencias de nombres de archivo con un patrón, ejemplo: nombre*.jpg
		$count = count(glob(self::FILE_PATH.$arr_name[0].'*.'.$ext));
		$new_name = implode('.', $arr_name).'_'.$count.'.'.$ext;

		return $new_name;
	}

	public function validateFile(){
		// tipos de fichero permitidos
		$arr_type = array('image/jpeg', 'image/png');

		if( in_array($this->data_file['type'], $arr_type)){
			return true;
		}

		return false;
	}

	public static function saveFile($temp, $name){
		$file = self::FILE_PATH.$name;	// ruta + nobre de archivo

		// Mueve un archivo subido al directorio temporal del servidor a una nueva ubicación
		$uploaded = move_uploaded_file($temp, $file);

		return $uploaded;
	}

}
