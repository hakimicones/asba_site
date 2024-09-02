<?php 
include_once('composant/cvform/model/modelCvform.php');
include_once('composant/cvform/view/viewcvform.php');	 
	
class cvform { 
	public $cx;
	public $db ;
	public $obj;	
 
   public function __construct($c)
	{
		 $this->cx  = $c; 
		 $this->lg	= strtolower($c->lg);
		 
		$this->cfg =  $c->cx->cfg ;
	 
		 
		 $this->obj = new stdClass();
		 $this->obj->lg 	= strtolower($c->lg);
		 $this->obj->id 	= $c->id;
		 $this->obj->type 	= array();
		 $this->ariane	  	=  $c->ariane ;
		// $this->obj->format = array();
		 
	}
   
   public function display() {
   
    $model 	= new modelcvform( $this );
    
	
	$task 	=   (isset($_POST['task']))?$_POST['task']:'';
	 
	if ( empty($task) && isset($_GET['task'])) { $task = $_GET['task'] ;  }
	
    if  (!empty($task) && $task!='list' ) {  
	
	
	
	
	$method = 'get'.ucfirst($task);
	
	$this->ariane .='<li>{'.strtolower($task).'}</li>';
	$ariane 	=  $this->remplace_ariane();
	
	
	
	$row	= $model->$method ($_POST) ; 
	 
	
	
	
	$view  = new viewcvform($row,$this->obj);
	$data  = $view->$method();
	
	} else {
    $search ='';
	if (isset($_POST['search'])) {
	
	$search =$_POST['search']; }  
	
	$ariane 	= $this->ariane."<li>{cvform}</li>" ;
	 
	 
 	
	
	 
	 
	$view  = new viewcvform(array(),$this->obj);
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
		$la[$nb-2]  = '<a href="'.$this->lg.'/cvform/list-'.$this->cx->id.'-1.html">'.$deb .'</a>';
		$ariane = implode("</li><li>",$la ) ; }
		return  $ariane ;
	}
	
	

// Fin classe 
}
