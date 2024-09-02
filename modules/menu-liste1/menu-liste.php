<?php 
class menu_liste {
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
	
		$db->addParamToBind('id', $id );
		
		$db->addOrderBy('ordre ASC');
		if (!$db->select()){ echo 'ERREUR->Main Menu : '.$db->getErrMessage().'<br>'. $this->id .'<br>';  return "";}
        else {   
  			$class = '';
            return  $db->getAllRows(); }
	
	}
	
	
	 
	/*******************************************/
	 
	
	/***************************************/
	public function affiche() { 
	
	    $dir = ($this->lg!="ar")?"":'dir="rtl"';
	 	 
		$li='<nav class="nav-'.$this->obj->param->classe.'"  '.$dir.'><ul  class="'.$this->obj->param->classe.' menu_'.$this->lg.'">';
		$i = 0 ;
		$result = $this->getMenu($this->obj->param->id_menu );
		 foreach($result as $el) 
			  {
			  $i++;
			   
			   $params = json_decode($el['param']);
			  
			  $cla = (!empty($params->css))?'class ="'.$params->css.'"':'';
			  $id_tag = (!empty($params->id_tag))?'id ="'.$params->id_tag.'"':'';
			  
			  $tit = ($el['type']!=2)?$el['title']:'<i class="fa '.$el['title'].'"></i>';
			  $li .= '<li '.$id_tag.' '.$cla.'> <a href="'.$el['link'].'"> '.  $tit .'</a></li>';
			  
			  
			  }
			  $li .= '</ul></nav>';
			  return $li; 
		 
	 
	}
}


?>
 

