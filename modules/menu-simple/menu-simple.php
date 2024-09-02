<?php 
//  Modifier le 01/10/2019 

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
	 $this->detect 		= $this->obj->detect  ;
	 
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
		$n=0;
		$result = $this->getMenu($this->obj->param->id_menu );
		$mob=   ($this->detect->isMobile()) ? '_mob':'' ;
		 
		
		$menus = array();
		foreach($result as $row) :
		$n++;
			$menus[$row['parent']][$row['id']]['param'] = $row['param'];
			$menus[$row['parent']][$row['id']]['title'] = $row['title'] ;		
			$menus[$row['parent']][$row['id']]['link']  = $row['link'] ;
			$menus[$row['parent']][$row['id']]['type'] 	= $row['type'] ;
			$menus[$row['parent']][$row['id']]['id'] 	= $row['id'] ;
			$menus[$row['parent']][$row['id']]['ordre'] = $row['ordre'] ;
			$menus[$row['parent']][$row['id']]['parent'] = $row['parent'] ;
			
		  //$menus[$row['parent']][$row['id']][''] = $row[''] ;
	  
		
		endforeach;
		
		 $ul  = '';  
		
		 foreach($menus[0] as $key => $el) 
			  {
			 
			  
			  $i++;
			   
			  $params = json_decode($el['param']);
			  
			 
			  $ul  = ''; 
			  if (isset($menus[$key])) { 
			  
			 
			  $sm_id    = ($this->detect->isMobile()) ?  'id="parent-'.$el['id'].'"' : '' ;
			  $collapse = ($this->detect->isMobile()) ?  'collapse' : '' ;
			  $ul = '<ul class="submenu'.$mob.' '.$collapse.'"  '.$sm_id.'  >';
			  
			    foreach($menus[$el['id'] ] as $sous ) {
				
	    	  $ul1 = '';
				
			        if (isset($menus[$sous['id']])) { 
					
					 $sm1_id    = ($this->detect->isMobile()) ?  'id="sous-'.$sous['id'].'"' : '' ;
					 $ul1 = '<ul class="submenu1'.$mob.'  '.$collapse.' "  '.$sm1_id.'  >';
					       foreach($menus[$sous['id']] as $sous1 ) { 
						   
						   $link =  explode('.',$sous1['link']);
						//  print_r($link);
						   
						   
						   $ul1 .= '<li class="'.$key.' '.$sous['id'].' "> <a href="'.$link[0].'-'.$sous['id'].'.html" > '.  $sous1['title'].'</a></li>';	
						   
						   }
						   
						   
						  $ul1 .= '</ul>';  
					
					
					}
					
					$parentClass = (!empty($ul1)) ? 'data-toggle="collapse" data-target="#sous-'.$sous['id'].'"' : '' ;
					$icon        = (!empty($ul1) && $this->detect->isMobile()) ? '<span class="material-icons">expand_more</span>' : '';
					//class="parent2"
					
					 $link =  explode('.',$sous['link']);
				 	$ul .= '<li> <a  '.$parentClass.' href="'.$link[0].'-'.$el['id'].'.html"  > '.  $sous['title'].' '.$icon.'</a>'.$ul1.' </li>';	
					
			  }
			  //submenu
			   $ul .= '</ul>';
			  
			  }
			  
			//  print_r((!empty($params->id_tag)) ? $params : '');
			   
			  $cla = (!empty($params->classe)) ? 'class ="'.$params->classe.'"':'';
			  $id_tag = (!empty($params->id_tag)) ? 'id ="'.$params->id_tag.'"':'';
			  
			  $tit = ($el['type']!=2)?$el['title']  :'<span class="material-icons">'.$el['title'].'</span>	 ';
			  $cls = ($el['type']!=2)? '' : 'class="icon-link"' ;
			   
			  $icon1 = (!empty($ul) && $this->detect->isMobile() ) ? '<span class="material-icons">expand_more</span>' : ''; 
			  $togle = (!empty($ul)) ? 'data-toggle="collapse" data-target="#parent-'.$el['id'].'" aria-expanded="true" aria-controls="parent-'.$el['id'].'"' : '';
			  $li .= '<li '.$cla.'  '.$id_tag.'> <a href="'.$el['link'].'" '.$cls.' '.$togle.' > '.  $tit .' '.$icon1.'</a>  '.$ul.'</li>';
			  
			  
			  }
			  
			  $mobile = ($this->detect->isMobile()) ? '_mobile' : '';
			  
			  $script ='
			  
			    <script>

			          

				 var n =  '.$n.' * 25 ;
				 var h = window.innerHeight;
                   
			    $("#top_navis_mob").css("min-height", n +"px");
			    $("#top_navis_mob").css("height", h +"px");
				</script>
				';
			  
			  $ar   = ($this->lg=='ar') ? 'dir="rtl" lang="ar"' : '';

			  $added = (isset($this->obj->param->extra)) ? $this->obj->param->extra : '';
			  $lis  = '<ul id="'.$this->obj->param->id_html.$mobile.'" class="  '.$this->obj->param->classe.$mobile.'" '.$ar.'>'.$li. $added.'</ul>';
			  return $lis.$script;  
		 
	 
	}
}
 

?>
 

