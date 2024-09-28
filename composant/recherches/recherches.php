<?php 
include_once('composant/recherches/model/Model.php');
include_once('composant/recherches/view/View.php');


class recherches {

 public $html ; 
 public $user ;
 public $db; 
 public $script= '';
 public $scriptFile;
 public $style = ''; 
 public $task;
 public $view;
 public $rows ;
 public $message = [ "contenu" => ''  ,    "type" => '',] ;
 
 
 public function __construct($c)
	{
	     $this->cx  = $c; 
		 $this->lg	= strtolower($c->lg);	 
		 $this->ariane	  	=  $c->ariane ; 
	}
 public function getCorp() { 	return  $this->display()  ;	}
 public function affErr(){ 
	
			$url = 'errors/404.php';
		    $f = file_get_contents($url) ;	
			 
			 return $f ;
	
	}
 
  
 
 public  function display() {

 	 
     
 	$this->model   	=  new recherchesModel($this);

 	$viewClass  =  'recherchesView';
  
 	$monobjet   = 	new $viewClass(  $this);
 	$data       =  $monobjet->display(); 
   
	$retour = new stdClass ;
	$retour->data 		= $data ; 
	//''
	$retour->ariane 	=  $this->ariane."<li>{recherche}</li>" ;;
	$retour->titre		= '{recherche}';
	
 	return $retour;
 }
 
  
 
 
  
 
 // Fin classe 
 }
 
