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
	$div  = '<a href="javascript:;" id="btn_avis" class="btn_bas2 droite bottom_avis" data-toggle="modal" 
	         data-target="#votreAvisForm"> {avis} </a>';	
	$data = file_get_contents( 'modules/avis/view/default.php') ;		 
	$div    .= $data ;
	return 	$div ;		
	
	}
	
	
}


?>
		
 

