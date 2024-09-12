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
