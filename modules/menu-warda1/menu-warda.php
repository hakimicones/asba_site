<?php 
class menu_warda {
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
	
	
	public function getMenu() {
	
	   
 	
		$this->id =  $this->obj->param->id_menu  ;
 		$db =  $this->cx->db ;
		$db->emptyParams();
		$db->resetSelect();
		$db->addSelected('a.*', '');
		$db->addSelected('b.id_div', '');
		 
		
		$db->addFrom('is_mega_menu as a');
		$db->addFrom('is_menu as b');
		
		$db->addWhere('a.id_menu = b.id');
		$db->addWhere('a.id_menu = :id');
	
		$db->addParamToBind('id', $this->id );
		
		$db->addOrderBy('ordre ASC');
		if (!$db->select()){ echo 'ERREUR->Main Menu : '.$db->getErrMessage().'<br>'. $this->id .'<br>';  return "";}
        else {   
  			$class = '';
            return  $db->getAllRows(); }
	
	}
	
	
	public function affMenus() {
	$li='<ul id="menu" class="menu_'.$this->lg.'">';
	$i = 0 ;
	$result = $this->getMenu();
	 foreach($result as $el) 
			  {
			  $i++;
			  $param 	= json_decode($el['param']) ;
			 $css 		= isset( $param->css ) ? $param->css :" bas";
			 $id_tag    = isset( $param->id_tag ) ?  'id = "'. $param->id_tag.'"' :"";
			  // print_r( $css);
			  
			  $img =  ($i > 6 ) ? '{URL}/images/nav1' : '{URL}/images/nav'.$i; 
			  $tit = ($el['type']!=2)?$el['title']:'<i class="fa '.$el['title'].'"></i>';
			  $li .= '<li id="nav'.$i.'"><img src="'.$img .'.png" alt=""><span '.$id_tag.'  class="'.$css.'"><a href="'.$el['link'].'"> '.  $tit .'</span></a>'. $el['html'] .'</li>';
			  
			  
			  }
			  
			  return $li;
	
	}
	public function affiche() { 
		
	 	$url = 'modules/menu-warda/tpl/tpl.php';

		$data = file_get_contents($url) ;

	 	$tag[]  =  '{contenu}';
	 	$ext[]  =  $this->affMenus() ; 
		
		 
		$html = str_replace ( $tag ,$ext , $data) ;
		 
		 
		return  $html;
	}
}


?>
 

