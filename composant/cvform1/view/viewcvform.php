<?php 

class viewcvform {
    public $rows ;
	public $lg;
	public $id;
	public $type;
	public $format;
	public $exper;
	public function __construct($rows, $obj)
		{
			 $this->rows	= $rows;
			 $this->lg		= $obj->lg; 
			 $this->id		= $obj->id; 
		 
			 
			 
		}
		
    public function display() { 
	 
		
	 		$url = 'composant/cvform/view/tpl/form.php'; 
			$f = file_get_contents($url) ;
			
			
			
			
			$tag[]  ='{action}';
			$ext[]  =(isset($_GET['theme'])) ? 'index.php?option=cvform&id='.$this->id.'&lg='.$this->lg.'&theme='.$_GET['theme'] : $this->lg.'/cvform//list-'.$this->id.'-9.html';
			
			
		    $html = str_replace ( $tag ,$ext , $f) ;
		
		 return $html;
	 
		 
	
	}
	
	
	function getSendCv() {
	
	 
	$ret = '
		<div class="alert alert-'.$this->rows['type'].'" role="alert">
		   '.$this->rows['contenu'].'
		</div>';
	
	return $ret;
	}
	 
//Fin classe
}


?>
