<?php 
//  Modifier le 01/10/2019 
require_once ("includes/Mobile_Detect.php");
class prod_carous {
	private $cx ;
	private $obj ;
	private $lg ;
	public $li ;
	public $mess = 2 ;
	public $params;
	public $script ;

public function __construct($c,$obj,$lg  )
	{
	 $this->cx  = $c; 
	 $this->obj = $obj ;
	 $this->lg = $lg;
	 $this->params  = $this->obj->param;
	 
	 $this->db =  $this->cx->db ;
	 $this->detect 		= new Mobile_Detect;
	 
	} 
 
	//<ul id="menu" class="menu_ar">
	
	
	public function getProd() {	
	
	 
 		$db =  $this->cx->db ;
		$db->emptyParams();
		$db->resetSelect();
		$db->addSelected('p.*', '');
		$db->addSelected('cp.libelle_'.$this->lg, 'lib_cat');
		 
		
		$db->addFrom('is_product p');
		$db->addFrom('is_cat_prod cp');
		
		$db->addWhere('p.id_cat = cp.id');
		$db->addWhere('p.publier = 1 AND front=1');
		
		 
		
		$db->addOrderBy('ordre ASC  ');
		if (!$db->select()){ 
		
		echo 'ERREUR->Main Menu : '.$db->getErrMessage().'<br>'. $this->id .'<br>';  return "";}
        else {   
		
		 
  			$class = '';
            return  $db->getAllRows(); }
	
	}
	
	
	 
	
	/***************************************/
	public function affiche() { 
	
	    $url  = 'modules/prod-carous/tpl/tpl.php';
		$data = file_get_contents($url) ;  
		
		
		$rows = $this->prepareData();
		 
		$tag[]  =  '{cats}';
		$ext[]  =  $this->getCat($rows->cats) ;
		
		$tag[]  =  '{items}';
		$ext[]  =  $this->getList($rows->prod);
		
		
		
		$tag[]  =  '{titre}';
		$ext[]  =  $this->params->titre ;
		
		$tag[]  =  '{id}';
		$ext[]  =  $this->params->id_caro ;
		
		
		
		
		$tag[]  =  '{}';
		$ext[]  =  '' ;
		  
	 	 
		 $html = str_replace ( $tag ,$ext , $data) ;
		 
		 
		return $html;
	
	
	}
	/*******************************************/
	 
	function getCat($data) {
	$active = 'active';
	$ul = '';
	foreach($data as $key => $val ) :
	$ul .= ' <li class="nav-item col col-xl-3 '.$active.'"> 
	             <a class="nav-link btn-cat" data-cat="cat-'.$key.'" href="#cat-'.$key.'"  > '.$val.' </a>
			 </li>';
	 
	$active = '';
	endforeach;
	 
								  
	return 	$ul;						  
	
	
	
	}
	/*
	*/
	/*******************************************/
	 
	function getList($data) {
	$active = 'active';
	$ul = '';
	foreach($data as $row ) :
	
	$ul .= '   <div class="carousel-item cat-'.$row['id_cat'].' card col-12 col-sm-6 col-md-4 col-lg-3 '.$active.'">
				 <div class="card"  >
						  <img class="card-img-top" src="'.$row['etiquette'].'" alt="'.$row['libelle_fr'].'">
						  <div class="card-body">
							<p class="card-text">'.$row['libelle_'.$this->lg].'</p>
						  </div>
				 	</div>
                </div>';
	 
	$active = '';
	endforeach;
	 
								  
	return 	$ul;						  
	
	
	
	}			
	/*******************************************/
	public function prepareData() {
	 	
		$li='';
		$li1 ='';
		$i = 0 ;
		$result = $this->getProd();
		
		 
		$cats  = array();
		$prod = array();
		foreach($result as $row) :
				
			$cats[$row['id_cat']] = $row['lib_cat']; 
		
		endforeach;
		
		  
		 
		 $ret = new stdClass;	
		 $ret->cats = $cats;  
		 $ret->prod = $result;
		 
		 return $ret;
	 
	}
	
  
	
	
}
 

?>
 

