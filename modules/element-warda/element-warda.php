<?php 
class element_warda {
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
	
	//****************************************
	public function getMenu($id) { 
		 
 		$db =  $this->cx->db ;
		$db->emptyParams();
		$db->resetSelect();
		$db->addSelected('a.*', '');
		$db->addSelected('b.id_div', '');
		 
		
		$db->addFrom('is_mega_menu as a');
		$db->addFrom('is_menu as b');
		
		$db->addWhere('a.id_menu = b.id');
		$db->addWhere('a.id_menu = :id');
		$db->addWhere('a.publier= 1');
	
		$db->addParamToBind('id', $id );
		
		$db->addOrderBy('ordre ASC');
		if (!$db->select()){ echo 'ERREUR->Main Menu : '.$db->getErrMessage().'<br>'. $this->id .'<br>';  return "";}
        else {   
  			$class = '';
            return  $db->getAllRows(); }
	
	}
	
	
	
	 
	
	public function affMenus() {
	 
	  
	
	$script = " <script> function getMenu".$this->obj->param->num.'(curr ) {'."\n"
	         .'$(".'.$this->obj->param->class.'").empty();'."\n"  ;
	$i = 0 ;
	$xx1 = array( 100 ,190 , 145, 234 ,    55 , 100 , 190 , 10 , 280 , 10  , 280 ,145 ,    55, 234);
	$yy1 = array( 110  ,110 , 185, 185 ,   185 , 260 , 260 , 110 , 110 , 260, 260 , 335 , 335 , 335);
	
	
	$fo = (!empty($this->obj->param->fz))?$this->obj->param->fz:12;
	$xx = (!empty($this->obj->param->positions1))? explode(";",$this->obj->param->positions1): $xx1;
	
	$yy = (!empty($this->obj->param->positions2))?explode(";",$this->obj->param->positions2): $yy1;
	
	$ll = (!empty($this->obj->param->l1))? $this->obj->param->l1 : 80;
	$hh = (!empty($this->obj->param->h1))? $this->obj->param->h1 : 87;
	
	 
	
	$result = $this->getMenu($this->obj->param->id_menu);
	
 
	 foreach($result as $el) 
			  {
			  if(!isset($xx[$i])) echo $i .'  '.$this->obj->param->id_menu ; 
			  $script	.= 'creatBtn(curr,"'.$el['title']
			            .'","'.$el['link'].'", '
						.$xx[$i] .'  , '
						.$yy[$i].'  ,'
			            .($i + 1).' ,".'.$this->obj->param->class.'","'.$this->lg.'", '.$ll.','.$hh.','.$fo.');'."\n";
			  $i++;
			   
			  
			  }
			  
			  $script .=" } // ".$this->obj->param->id_menu."
			  </script>";
		  
			  return '<div class="'.$this->obj->param->class.'"></div>'.$script;
	
			}
	
	
	public function affiche() { 

	 	$url = 'modules/element-warda/tpl/tpl.php';
		$data = file_get_contents($url) ;
	 	$tag[]  =  '{contenu}';
	 	$ext[]  =  $this->affMenus() ;
		
		
		
		 
		
		$tag[]  =  '{libelle}';
	 	$ext[]  =  $this->obj->param->titre ;
		
		 
		$html = str_replace ( $tag ,$ext , $data) ;
		 
		 
		return $html;
	}
}


?>
 

