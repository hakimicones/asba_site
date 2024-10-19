<?php 
include_once('composant/cvtech/model/modelCvtech.php');
include_once('composant/cvtech/view/viewCvtech.php');	 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

	
class cvtech { 
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
		 $this->db 			= $c->db ;
		// $this->obj->format = array();
		 
	}
   
   public function display() {
   
   $model 				= new modelCvtech( $this );
    
	
	$task =   (isset($_POST['task']))?$_POST['task']:'';
	 
	if ( empty($task) && isset($_GET['task'])) { $task = $_GET['task'] ;  }
	
    if  (!empty($task) && $task!='list' ) {  
	
	
	
	
	$method = 'get'.ucfirst($task);
	
	$this->ariane .='<li>{'.strtolower($task).'}</li>';
	$ariane 	=  $this->remplace_ariane();
	
	
	
	$row	= $model->$method ($_POST) ; 
	$this->obj->type 	= $model->getTypeContrat();
 	
	
	$this->obj->format = $model->getNiveau() ;
	$this->obj->exper   = $model->getExperience();
	
	
	
	$view  = new viewCvtech($row,$this->obj);
	$data  = $view->$method();
	
	} else {
    $search ='';
	 
	
	$search =   (isset($_POST )) ? $_POST : null;   
	
	$ariane 	= $this->ariane."<li>{cvtech}</li>" ;
	$row				= $model->getData($search);
	/*
	
	$this->obj->type 	= $model->getTypeContrat();	
	$this->obj->format = $model->getNiveau() ;
	$this->obj->exper   = $model->getExperience(); 
	
	*/
	
	 $this->obj->categories  = $model->getCatégories(); 
	 
	 
	$view  = new viewCvtech($row,$this->obj);
	$data  = $view->display(); }
	
	$retour = new stdClass ;
	$retour->data 		= $data; 
	
	$retour->ariane 	= $ariane;
	$retour->titre		= $this->cx->title;
	 
	return $retour ;
   
   }
	public function remplace_ariane() 
    {	
		$ariane = '';
		$la 		= explode("</li><li>",$this->ariane);  
		$nb 		= count($la );
		if ($nb > 2 ) {
		$deb 		=  $la[$nb-2] ;
		$la[$nb-2]  = '<a href="'.$this->lg.'/cvtech/list-'.$this->cx->id.'-1.html">'.$deb .'</a>';
		$ariane = implode("</li><li>",$la ) ; }
		return  $ariane ;
	}


// Fin classe 
}
