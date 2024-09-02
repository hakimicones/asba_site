<?php 
class salati {
	public  $cx ;
	private $obj ;
	public $li ;
	public $lg;
	public $script ;

public function __construct($c,$obj,$lg)
	{
	 $this->cx  = $c; 
	 $this->obj = $obj ;
	 $this->lg = $lg;	 
	}
	
	public function affiche() { 
	$div 	 ='<a href="javascript:;" class="salat_btn"data-toggle="tooltip" title="" 
				data-original-title="Horraires de priere"> <i class="fa fa-moon-o"  ></i> </a>';
	$div 	.= '<div id="menusalat" class="ligne" >';
	$div	.='<div id="table"></div>';
	$div	.='<a href="javascript:;" class="fermesalat" style="display: none;"><i class="fa fa-arrow-right" ></i></a> ';
	$div	.='<script src="modules/salati/js/script.js"></script><script> affsalat(36.4700400 , 2.8277000) ;</script>';	
	$div    .= '</div>';
	return 	$div ;		
	
	}
}


?>

