<?php 

class main_menu  {
	public $cx ;
	public $id;
	public $script ;
public function __construct($c,$obj,$lg)
	{
	 $this->cx  = $c; 
	 $this->obj = $obj ;
	 $this->lg = $lg;
	}
public function affiche() {
 $li=''; 
 
 if ($this->lg!='ar'){$rtl = '';} else  { $rtl = 'sm-rtl kufi_1';}
 	
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
  
		
		 
        if (!$db->select()){ echo 'ERREUR->Main Menu : '.$db->getErrMessage().'<br>'. $this->id .'<br>'; }
        else {   
  			$class = '';
            $result = $db->getAllRows();  
		    
			 foreach($result as $el) 
			  {$html = '';
			  if (!empty($el['html']) ) {$class = 'class="has-mega-menu"'; $html = str_replace('.html"',"-".$el['id'].'.html"',$el['html'] );  } else {  }
			  
			  
			  $tit = ($el['type']!=2)?$el['title']:'<i class="fa '.$el['title'].'"></i>';
			  $li .= '<li  '.$class.'><a href="'.$el['link'].'"> '.  $tit .'</a>'.$html .'</li>';}
			  
			  
			 $menu  	='<ul id="'.$el['id_div'].'" class="sm sm-blue  '.$rtl.'">'. $li.'</ul>' ;
			 
			 $script = '<!-- SmartMenus jQuery plugin -->    
			            <script type="text/javascript" src="modules/main-menu/js/jquery.smartmenus.js"  ></script>
			            <script src="modules/main-menu/js/script.js"></script>
						<script>smart_m("#'.$el['id_div'].'")</script>';
			 
			//  print_r('<ul id="tt" class="sm'.$rtl.' sm-blue  ">'. $li.'</ul>'  );
			 return $menu . $script; 
 
 }

}


}?>
