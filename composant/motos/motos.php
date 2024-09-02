<?php 
include_once('composant/motos/model/modelmotos.php');
include_once('composant/motos/view/viewmotos.php');	 
	
class motos { 
	public $cx;
	public $db ;
	public $obj;	
   public function __construct($c)
	{
		 $this->cx  = $c; 
		 $this->lg	= strtolower($c->lg);
	 
		 
		 $this->obj = new stdClass();
		 $this->obj->lg = strtolower($c->lg);
		 $this->obj->id = $c->id;
		 $this->ariane	= $c->ariane ;
		 
		 if (isset( $_GET['num'])) { $this->num = (int) $_GET['num']; }  else {$this->num = 0;}
		 
	}
   
   public function display() {
   $model 	= new modelmotos($this->cx->db ,$this->lg);
    $search ='';
	if (isset($_POST['search'])) {$search =$_POST['search']; } 
	
	$task =   (isset($_POST['task']))?$_POST['task']:'';
	 
	if ( empty($task) && isset($_GET['task'])) { $task = $_GET['task'] ;  }
	
    if  (!empty($task)   ) { 
	
	$method = 'get'.ucfirst($task);
	
	$row	= $model->$method( $search) ; 	
	
	if ($task = 'simulation')  { 
			$this->conv  = $model->getConventions() ;
			$this->param = $model->getOutilsParams();
			
			if (!$this->num) {

				      $this->motos 	= $model->listMoto();
				      $this->listMarque	= $model->listMarque();



    					}
			
			
			
			 }
	
	$view  = new viewmotos($row,$this);
	 
	$data  = $view->$method();
	}
	
	
	$retour = new stdClass ;
	$retour->data 		= $data; 
	
	$retour->ariane 	= $this->ariane.' <li>{motos} </li>' ;
	$retour->titre		= $this->cx->title;
	
	return $retour ;
	
   
   }



// Fin classe 
}
