<?php 
class contenu {
	public $page  ;
	public $menu ='<div id="menu"> ici le menu </div>' ;
	public $title  ;
	public $slider ='<div id="menu"> slider </div>';
	public $head;
	public $param;
	
	public function getMenu() {
	
	
	}

	public function getPages($id,$cx,$ariane,$v) {
	$url   = 'composant/content/view/tpl/form.php';
	$menu  = file_get_contents($url) ; 
 
	$data  = $this->getData($id,$cx,$ariane);
	$c     = $data->data; 
	if ($v) $data->data  =   '<!--contenu--><div class="container '.$id.'">'.$menu.$c."</div><!--fin contenu-->" ; 
	
	return $data;
	}





public function getData($id,$cx,$ariane) {
	$db =  $cx->db ; 
	$db->emptyParams();
	$db->resetSelect();
	$db->addSelected('c.*', '');
	$db->addSelected('p.title', '');
	$db->addSelected('p.alias', '');
	$db->addSelected('p.id_langue', '');
	$db->addSelected('p.param ', '');
	
	$db->addFrom('is_contenu as c , `is_page` as p');
	$db->addWhere('c.id_item = p.id');
	$db->addWhere('c.id_item = :id');
	$db->addWhere('c.publier = 1 ');
	$db->addWhere('p.publier = 1 ');
	$db->addWhere('c.id_appli = 1 ');	
	$db->addOrderBy('ordre ASC');
	
	$db->addParamToBind('id', $id ); 
	
	
	  if (!$db->select()){ echo 'ERREUR CONTENU: '.$db->getErrMessage().'<br><br>'; }
        else {   
		
		 //echo str_replace(':id',$id,$db->q);
            $result = $db->getAllRows();  
		    if (count($result)) {
			 foreach($result as $section) 
					{  
						$this->title = $section['title']   ; 
						
						$id_section = (!empty($section['id_section']))?$section['id_section']:'section_'.$section['id'];
						 
						$this->page .='<section id="'.$id_section.'" class = "'.$section['css'].'">'
									.''
									.$section['intro_text']
									.'</section>' ;
						$this->param = $section['param']   ;
					}
					} else 
					{
					$this->title = 'Contenu Introuvable';
					$this->page .='<section id="" class = "">'
									.'<h3>Contenu  Introuvable </h3>'
									 
									.'</section>' ;
						$this->param = array()   ;
						
						$ariane = '404';
						 
					
					}
					

 
  }
    
	$retour = new stdClass ;
	$retour->data 		=  $this->page; 
	
	$retour->ariane 	=  $ariane;
	$retour->titre		= $this->title;
	
 
	
	return $retour;
 }
		 

 








}



?>
