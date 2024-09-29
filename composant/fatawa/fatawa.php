<?php 
include_once('composant/fatawa/model/modelFatawa.php');
include_once('composant/fatawa/view/viewFatawa.php');	 
	
class fatawa { 
	public $cx;
	public $db ;
	public $obj;	
 
   public function __construct($c)
	{
		 $this->cx  = $c; 
		 $this->lg	= strtolower($c->lg);
	 
		 
		 $this->obj = new stdClass();
		 $this->obj->lg 	= strtolower($c->lg);
		 $this->obj->id 	= $c->id;
		 $this->obj->type 	= array();
		 $this->ariane	  	=  $c->ariane ;
		// $this->obj->format = array();
		 
	}
   
   public function display() {
   
   $model 				= new modelFatawa ($this );
    
	
	$task =   (isset($_POST['task']))?$_POST['task']:'';
	 
	if ( empty($task) && isset($_GET['task'])) { $task = $_GET['task'] ;  }
	
    if  (!empty($task) && $task!='list' ) {  
	
	
	
	
	$method = 'get'.ucfirst($task);
	
	$this->ariane .='<li>{'.strtolower($task).'}</li>';
	$ariane 	=  $this->remplace_ariane();
	
	
	
	$row	= $model->$method ($_POST) ; 
	 
 	
	$cats	= $model->getCat();
	 
	
	
	
	$view  = new viewFatawa ($row,$this->obj, $cats);
	$data  = $view->$method();
	
	} else {
    $search ='';
	if (isset($_POST['search'])) {$search =$_POST['search']; }  
	
	
	$row				= $model->getData($search); 
	
	 
     $cats	= $model->getCat();
	 
	$view  = new viewFatawa ($row,$this->obj , $cats);
	$data  = $view->display(); 
	$this->ariane .= '<li>'.$view->ariane.'</li>';
 
	 
	}
	
	$retour = new stdClass ;
	$retour->data 		= $data; 
	 
	$retour->ariane 	= $this->remplace_ariane(); 
	$retour->titre		= $view->titre;
	 
	return $retour ;
   
   }
	public function remplace_ariane() 
    {	
		$ariane = '';
		$la 		= explode("</li><li>",$this->ariane);  
		$nb 		= count($la );
		if ($nb > 2 ) {
		$deb 		=  $la[$nb-2] ;
		$la[$nb-2]  = '<a href="'.$this->lg.'/page/list-'.$this->cx->id.'-1.html">'.$deb .'</a>';
		$ariane = implode("</li><li>",$la ) ; } else {$ariane = $this->ariane ; }
		return  $ariane ;
	}


// Fin classe 
}
