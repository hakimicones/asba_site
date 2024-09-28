<?php 
include_once('composant/vehicules/model/modelVehicules.php');
include_once('composant/vehicules/view/viewVehicules.php');	 
	
class vehicules { 
	public $cx;
	public $db ;
	public $obj;	
	private $task_List = array('list','simulation' ,'');
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
   
   public function display() 
   {
   	
	$retour = new stdClass ;
	
    $model 	= new modelVehicules($this->cx->db ,$this->lg);
    $search ='';
	if (isset($_POST['search'])) {$search =$_POST['search']; } 
	
	$task =   (isset($_POST['task']))?$_POST['task']:'';
	
	
	 
	if ( empty($task) && isset($_GET['task'])) { $task = $_GET['task'] ;  }
	
	if (!in_array($task,  $this->task_List)) {
	
		$retour->data 		=   '<div class="container"><div class="alert alert-danger"> Fonction '.$task.' inconnue </div></div>'; 
		 
		$retour->ariane 	= $this->ariane.' <li>{vehicules} </li>' ;
		$retour->titre		= 'Page inconnue';
		
		return $retour ;
         
    }	 
	
    if  (!empty($task)   ) { 
	
	$method = 'get'.ucfirst($task);
	
	$row	= $model->$method( $search) ; 	
	
	if ($task = 'simulation') 
	 { 
			$this->conv  = $model->getConventions() ;
			$this->param = $model->getOutilsParams();
			
			if (!$this->num) {

				      $this->vehicules 	= $model->listVehicule();
				      $this->listMarque	= $model->listMarque();



    					}
			
			
			
			 }
	
	$view  = new viewVehicules($row,$this);
	 
	$data  = $view->$method();
	}
	

	$retour->data 		= $data; 
	
	$retour->ariane 	= $this->ariane.' <li>{vehicules} </li>' ;
	$retour->titre		= $this->cx->title;
	
	return $retour ;
	
   
   }



// Fin classe 
}
