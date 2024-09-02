<?php 
class avis {
	public  $cx ;
	private $obj ;
	public $li ;
	public $script ;

public function __construct($c,$obj , $lg)
	{
	 $this->cx  = $c; 
	 $this->obj = $obj ;
	 $this->lg = $lg;
	 
	}
	
	public function affiche() { 
	
	$div  = '';	
	$data = file_get_contents( 'modules/avis/view/default.php') ;		 
	$data    .= $div.'<!-- Avis -->' ;
	return 	$data;		
	
	}
	
	
}


?>
		
 

