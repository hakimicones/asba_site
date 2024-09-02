<?php 
//  Modifier le 01/10/2019 
require_once ("includes/Mobile_Detect.php");
class menu_header {
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
	 
		 foreach($result as $el) 
			  {
			  
			  
			  $i++;
			   
			  $params = json_decode($el['param']);
			   
			  $cla = (!empty($params->classe))?'class ="'.$params->classe.'"':'';
			  $tit = ($el['type']!=2)?$el['title']:'<i class="fa '.$el['title'].'"></i>';
			  
			  if (!empty($params->classe) && $params->classe=='first-icones') {
		 
			  $li1 = '<li '.$cla.'> <a href="'.$el['link'].'"> '.  $tit .'</a></li>';
			  } else {
			  $li .= '<li '.$cla.'> <a href="'.$el['link'].'"> '.  $tit .'</a></li>';
			  }
			  
			  }
			  
			  $mobile = ($this->detect->isMobile()) ? '_mobile' : '';
			  
			  $script ='
			  
			    <script>
				/* Set the width of the side navigation to 250px */
				
				$( document ).ready(function() {$("#mySidenav").detach().prependTo("#main_page"); });
				
				
				</script>
				';
			  
			  
			  $lis  = ($this->detect->isMobile()) ? 
			  '<div id="mySidenav" class="sidenav"><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			  <ul  class="'.$this->obj->param->classe.$mobile.'">'.$li1.$li.'</ul></div>
			  <span id="openNavBtn" onclick="openNav()"><i class="fa fa-bars" aria-hidden="true"></i></span>' . $script : 
			  '<ul  class="'.$this->obj->param->classe.$mobile.'">'.$li1.$li.'</ul>';
			  return $lis;  
		 
	 
	}
}


?>
 

