<?php 
//  Modifier le 01/10/2019 
require_once ("includes/Mobile_Detect.php");
class menu_simple {
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
	
	
	public function getMenu($id) {
	
	   
 	
	 
 		$db =  $this->cx->db ;
		$db->emptyParams();
		$db->resetSelect();
		$db->addSelected('a.*', '');
		$db->addSelected('b.id_div', '');
		 
		
		$db->addFrom('is_mega_menu as a');
		$db->addFrom('is_menu as b');
		
		$db->addWhere('a.id_menu = b.id');
		$db->addWhere('a.publier = 1');
		
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
	 	
		$li='';
		$li1 ='';
		$i = 0 ;
		$result = $this->getMenu($this->obj->param->id_menu );
		
		 
		
		$menus = array();
		foreach($result as $row) :
		
			$menus[$row['parent']][$row['id']]['param'] = $row['param'];
			$menus[$row['parent']][$row['id']]['title'] = $row['title'] ;		
			$menus[$row['parent']][$row['id']]['link']  = $row['link'] ;
			$menus[$row['parent']][$row['id']]['type'] 	= $row['type'] ;
			$menus[$row['parent']][$row['id']]['id'] 	= $row['id'] ;
			$menus[$row['parent']][$row['id']]['ordre'] = $row['ordre'] ;
			
		  //$menus[$row['parent']][$row['id']][''] = $row[''] ;
	  
		
		endforeach;
		
		 $ul  = '';  
		
		 foreach($menus[0] as $key => $el) 
			  {
			 
			  
			  $i++;
			   
			  $params = json_decode($el['param']);
			  
			 
			  $ul  = ''; 
			  if (isset($menus[$key])) { 
			  
			 
			  
			  $ul = '<ul class="submenu"    >';
			  
			    foreach($menus[$el['id'] ] as $sous ) {
				
	    	  $ul1 = '';
				
			        if (isset($menus[$sous['id']])) { 
					 $ul1 = '<ul class="submenu1"    >';
					       foreach($menus[$sous['id']] as $sous1 ) { 
						   
						   $ul1 .= '<li class="'.$key.' '.$sous['id'].' "> <a href="'.$sous1['link'].'" > '.  $sous1['title'].'</a></li>';	
						   
						   }
						   
						   
						  $ul1 .= '</ul>';  
					
					
					}
					/**/
				 	$ul .= '<li> <a href="'.$sous['link'].'" > '.  $sous['title'].'</a>'.$ul1.' </li>';	
					
			  }
			  //submenu
			   $ul .= '</ul>';
			  
			  }
			  
			//  print_r((!empty($params->id_tag)) ? $params : '');
			   
			  $cla = (!empty($params->classe)) ? 'class ="'.$params->classe.'"':'';
			  $id_tag = (!empty($params->id_tag)) ? 'id ="'.$params->id_tag.'"':'';
			  
			  $tit = ($el['type']!=2)?$el['title']  :'<span class="material-icons">'.$el['title'].'</span>	 ';
			  $cls = ($el['type']!=2)? '' : 'class="icon-link"' ;
			   
			  $li .= '<li '.$cla.'  '.$id_tag.'> <a href="'.$el['link'].'" '.$cls.'> '.  $tit .'</a>  '.$ul.'</li>';
			  
			  
			  }
			  
			  $mobile = ($this->detect->isMobile()) ? '_mobile' : '';
			  
			  $script ='
			  
			    <script>
				 
				</script>
				';
			  
			  $ar   = ($this->lg=='ar') ? 'dir="rtl" lang="ar"' : '';
			  $lis  = ($this->detect->isMobile()) ? 
			  '' . $script : 
			  '<ul id="'.$this->obj->param->id_html.'" class="'.$this->obj->param->classe.$mobile.'" '.$ar.'>'.$li.'</ul>';
			  return $lis;  
		 
	 
	}
}
 

?>
 

