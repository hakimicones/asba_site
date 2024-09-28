<?php 
include_once('composant/cvtech/model/modelCvtech.php');
include_once('composant/cvtech/view/viewCvtech.php');	 
	
class cvtech { 
	public $cx;
	public $db ;
	public $obj;	
	
	private $task_List = array('list','Tabs','Faq','Blog','');
 
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
   
   public function display() 
   
   {
   $retour = new stdClass ;
   
   $model 				= new modelCvtech($this->cx->db ,$this->lg);
    
	
	$task =   (isset($_POST['task']))?$_POST['task']:'';
	 
	if ( empty($task) && isset($_GET['task'])) { $task = $_GET['task'] ;  }
	
	
	
		if (!in_array($task,  $this->task_List)) {
	
		$retour->data 		=   '<div class="container"><div class="alert alert-danger">La  Tache '.$task.' inconnue </div></div>'; 
		 
		$retour->ariane 	= $this->remplace_ariane(); 
		$retour->titre		= 'Page inconnue';
		
		return $retour ;
         
    }
	
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
	if (isset($_POST['search'])) {$search =$_POST['search']; }  
	
	$ariane 	= $this->ariane."<li>{cvtech}</li>" ;
	$row				= $model->getData($search);
	$this->obj->type 	= $model->getTypeContrat();
 	
	
	$this->obj->format = $model->getNiveau() ;
	$this->obj->exper   = $model->getExperience(); 
	 
	$view  = new viewCvtech($row,$this->obj);
	$data  = $view->display(); }
	
	 
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
