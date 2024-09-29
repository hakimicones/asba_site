<?php 
include_once('composant/agences/model/modelAgences.php');
include_once('composant/agences/view/viewAgences.php');	 
	
class agences { 
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

		 
		 
	}
   
   public function display() {
   
    $search ='';
	if (isset($_POST['search'])) {$search =$_POST['search']; }  
	
	$model 	= new modelAgences($this );
	$row	= $model->getData($search);
	
	
	$view  = new viewAgences($row,$this->obj);
	$data  = $view->display();
	
	
	$retour = new stdClass ;
	$retour->data 		= $data; 
	
	$retour->ariane 	= $this->ariane.' <li>{agences} </li>' ;
	$retour->titre		= $this->cx->title;
	
	return $retour ;
	
   
   }



// Fin classe 
}
