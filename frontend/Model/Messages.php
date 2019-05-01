<?php
require_once "BaseModel.php";

class Messages {
	private $msg;

	public function __construct(){}

	public function get(){
		return $this->msg;
	}

	public function set($_msg, $text=null){
		if ($text !== null) {
			$text = base64_decode($text);
		}
		switch ($_msg) {
			case 'n1':
				$this->msg = '<div class="messages bg-success">Se ha creado un nuevo registro: '.$text.'</div>';
				break;
			case 'n0':
				$this->msg = '<div class="messages bg-danger">Error al crear: '.$text.'. Es posible que ya exista.</div>';
				break;
			case 'u1':
				$this->msg = '<div class="messages bg-success">Actualizado: '.$text.'</div>';
				break;
			case 'u0':
				$this->msg = '<div class="messages bg-danger">Error al actualizar: '.$text.'. Es posible que ya exista.</div>';
				break;
			case 'd1':
				$this->msg = '<div class="messages bg-success">Eliminado: '.$text.'</div>';
				break;
			case 'd0':
				$this->msg = '<div class="messages bg-danger">Error al eliminar: '.$text.'</div>';
				break;
			default:
				$this->msg = base64_decode($_msg);
				break;
		}
	}
}
