<?php 
class menu_pico {
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
		$db->addWhere('a.publier= 1');
	
		$db->addParamToBind('id', $id );
		
		$db->addOrderBy('ordre ASC');
		if (!$db->select()){ echo 'ERREUR->Main Menu : '.$db->getErrMessage().'<br>'. $this->id .'<br>';  return "";}
        else {   
  			$class = '';
            return  $db->getAllRows(); }
	
	}
	
	
	 
	/*******************************************/
	 public function getNews() {
	 
	 return ' 
	 
	';
	 
	 
	 }
	
	/***************************************/
	public function affiche() { 
	 	  
		$li='<ul  class="'.$this->obj->param->classe.'">';
		$i = 0 ;
		$result = $this->getMenu($this->obj->param->id_menu );
		 foreach($result as $el) 
			  {
			
			   
			   $params = json_decode($el['param']);
			   
			  $cla = (!empty($params->classe))?'class ="'.$params->classe.'"':'';
			  $tit = ($el['type']!=2)?$el['title']:'<i class="fa '.$el['title'].'"></i>';
			  $css  = (!empty($params->css))? ' style="'.$params->css.'"' : '' ;
			  $classe = (!empty($params->classe))? 'class="'.$params->classe.'"': '' ;
			  $id_tag = (!empty($params->id_tag))? 'id="'.$params->id_tag.'"' : '' ;    
			  $link   = (!empty($el['link']))? 'href="'.$el['link'].'"'  : 'href="javascript:"' ;
			  $li .= '<li '.$cla.'>
			  			<a   '.$link.'    '.$id_tag.'   '.$classe.'  '.$css.' > 
			          		<img class="menu-ico" src="images/icones/'.$el['id'].'.png" width="48" >  
			          		<div class="ico-title"> '. $el['title'] .'</div>
			         	</a>
					 </li>';  
			    $i++;
			  
			  }
			  $li .= '</ul>' ;
			  return $li; 
		 
	 
		}
}


?>
 

