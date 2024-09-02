<?php 
class mini_slider {
	private $cx ;
	private $obj ;
	private $lg ;
	public $li ;
	public $mess = 2 ;
	public $params;
	public $script ;

public function __construct($c,$obj,$lg)
	{
	 $this->cx  = $c; 
	 $this->obj = $obj ;
	 $this->lg = $lg;
	 $this->params  = $this->obj->param;
	 
	 $this->db =  $this->cx->db ;
	 
	} 
 
	//<ul id="menu" class="menu_ar">
	
	
	public function getImages( ) {
		$i      = 0;
		$active = 'active';
		$li     = '';
	    $images = explode(";",$this->obj->param->images);
 	     foreach($images  as $image  ) 
			  {
			  $i++;
			
			  $li .= '<div class="carousel-item '.$active.'">
					 <img class="img-slider" src="images/flex-slider/'.$image.'" alt="slide '.$i.'">
					 </div>
					 
					 
					 ';
	       $active =   "" ;
 		 }
		 
		 return $li;
	
	}
	
	

	 
	
	/***************************************/
	public function affiche() { 
	 	 
		 $url  = 'modules/mini-slider/tpl/tpl.php';
		 $data = file_get_contents($url) ;  
		 
		 
		 
		
		 $tag[]  =  '{images}';
		 $ext[]  =  $this->getImages( ) ;
		 
		 $tag[]  =  '{bg}';
		 $ext[]  =  $this->obj->param->bg ;
		 
		 
		 
		 /* */ 	 
		 $html = str_replace ( $tag ,$ext , $data) ;
		 
		 
		return $html;
	 
	}
	
		 
	/*******************************************/
}


?>
 


