<?php
require_once 'Model/BaseModel.php';
require_once 'Model/AppConfig.php';

class SortController {
	private $bm;
	private $column;
	private $table;
	private $page;
	private $ctrl;
	private $number_of_pages=1;
	private $base_url;
    private $admin_url;
    private $media_dir;
	private $reg_page;
	private $ord_dir;	// dirección de la ordenación (ASC/DESC)

	public function __construct(){
		$this->column = isset($_POST['column'])? $_POST['column'] : "";
		$this->page = isset($_POST['page'])? $_POST['page'] : "";
		$this->ctrl = isset($_POST['ctrl'])? $_POST['ctrl'] : "";
		$conf = new AppConfig();
		$this->base_url = $conf->getUrlBase()->valor;
        $this->admin_url = $conf->getAdminUrl()->valor;
		$this->reg_page = (int)$conf->getRegPerPage()->valor;
        $this->media_dir = $this->base_url.'media/covers/';
	}

    public function main(){
        require_once 'View/404.php';
    }

	public function getSortColumn(){
		$text = '';
		$this->table = 'catalogo';
		$this->bm = new BaseModel($this->table);

        $respuesta = $this->getItemsPages();

        if ($respuesta) {
        	if (!is_array($respuesta)) {
        		$respuesta = array($respuesta);
        	}

          	foreach ($respuesta as $item){
                $text .= '<tr>';
                $text .= '<td>'.$item->artista .'</td>';
                $text .= '<td>'.$item->album .'</td>';
                $text .= '<td>'.$item->fecha .'</td>';
                $text .= '<td>'.$item->genero .'</td><td>';

                if($item->img_front != ''){
                    $text .= '<div class="cover_xs"><a href="'. $this->media_dir.$item->img_front .'" data-fancybox><img class="img-responsive" src="'. $this->media_dir.$item->img_front .'" alt="front"></a></div>';
                }

                $text .= '</td><td>';
                if($item->img_back != ''){
                    $text .= '<div class="cover_xs"><a href="'. $this->media_dir.$item->img_back .'" data-fancybox><img class="img-responsive" src="'. $this->media_dir.$item->img_back .'" alt="back"></a></div></td>';
                }

                if($this->ctrl == "mp3"){
                	if ($item->cdmp3_id > 0 && $item->cdmp3_id != '') {
						$text .= '<td>'.$this->getCdName($item->cdmp3_id).'</td>';
					}else{
						$text .= '<td>No</td>';
					}
					$ori = ($item->original == 0)? 'No' : $item->original;
					$text .= '<td>'. $ori .'</td>';

                }else {
                	$mp3 = ($item->mp3 == 1)? 'Sí' : 'No';
	                $text .= '<td>'. $mp3 .'</td>';
	                $text .= '<td>'. $item->original .'</td>';
                }

		        $text .= '</td>
		                  <td><a href="'. $this->admin_url.$this->ctrl.'/editar/'. $item->id .'" title="Editar: '. $item->artista.' - '.$item->album .'" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
		                  <td><a href="'. $this->admin_url.$this->ctrl.'/borrar/'. $item->id .'" title="Borrar: '. $item->artista.' - '.$item->album .'" class="btn btn-danger btn-sm delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
                  		</tr>';            }
        }
        echo $text;
	}

	public function getItemsPages(){
		$init = ($this->page > 1) ? (($this->page * $this->reg_page) - $this->reg_page) : 0;

		if ($this->ctrl == 'mp3') {
            setcookie("sort_mp3",$this->column,time()+10800,'/');   // cookie de 3 horas con la columna que se esta ordenando
			$this->setOrderDirection($this->ctrl);
			$_query = "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->table} WHERE {$this->ctrl} = '1' ORDER BY {$this->column} {$this->ord_dir} LIMIT {$init},{$this->reg_page}";

		} else {
			$this->setOrderDirection($this->ctrl);
			$_query = "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->table} WHERE {$this->ctrl} != '0' ORDER BY {$this->column} {$this->ord_dir} LIMIT {$init},{$this->reg_page}";
			setcookie("sort_ori",$this->column,time()+10800,'/');
		}

		$result = $this->bm->select($_query);

		$rows = $this->bm->select("SELECT FOUND_ROWS() as total");
		$total_reg = $rows->total;

		$this->number_of_pages = ceil($total_reg / $this->reg_page);

		return $result;
	}

	public function getCdName($id){
		$_cds = new BaseModel("cds_mp3");
		$nombre = $_cds->getById($id)->nombre;

		return $nombre;
	}

	// controlamos si se ordena de forma acendente o descendente
	// la dirección de ordenación se va alternando según se va haciendo clic sobre la misma columna.
	public function setOrderDirection($ctrl){
		if($ctrl == "mp3"){
			if($_COOKIE["sort_mp3"] == $this->column){
		       if($_COOKIE["mp3_ordir"] == null || $_COOKIE["mp3_ordir"] == "DESC"){
		       		setcookie("mp3_ordir","ASC",time()+10800,'/');	// cookie de 3 horas con la dirección de ordenación (ASC/DESC)
		        }else {
		            setcookie("mp3_ordir","DESC",time()+10800,'/');
		        }
		    }else {
                setcookie("mp3_ordir","ASC",time()+10800,'/');
		    }

	    	$this->ord_dir = $_COOKIE["mp3_ordir"];

		}else {
			if($_COOKIE["sort_ori"] == $this->column){
		       if($_COOKIE["ori_ordir"] == null || $_COOKIE["ori_ordir"] == "DESC"){
		       		setcookie("ori_ordir","ASC",time()+10800,'/');
                    $this->ord_dir = "ASC";
		        }else {
		            setcookie("ori_ordir","DESC",time()+10800,'/');
                     $this->ord_dir = "DESC";
		        }
		    }else {
                setcookie("ori_ordir","ASC",time()+10800,'/');

		    }

	    	$this->ord_dir = $_COOKIE["ori_ordir"];
		}
	}

}

if (isset($_POST['ctrl'])) {
	$sort = new SortController();
	$sort->getSortColumn();

}
