<?php 
class mi_slider {
	public $cx ;
	public $nav ;
	public $li ;
	private $obj ;
	public $script ;

public function __construct($c,$obj,  $lg )
	{
	 $this->cx  = $c; 
	 $this->lg  = $lg;
	 $this->obj = $obj;
	 
	}
 
	
public function affiche() {

 
 $db =  $this->cx->db ;
 
 $db->resetSelect();
 
  $db->addSelected('a.*', '');
  $db->addSelected('b.libelle_fr', 'libcat_fr');  
  $db->addSelected('b.libelle_ar', 'libcat_ar');  
  $db->addSelected('b.libelle_en', 'libcat_en');
  $db->addSelected('b.param', '');
  
  $db->addFrom('is_product as a  ');
  $db->addFrom('is_cat_prod as b');
  
  $db->addWhere('a.id_cat = b.id');
  $db->addWhere('a.publier = 1'); 
  
  $db->addOrderBy('b.ordre ,a.ordre');
 
  if (!$db->select()){ echo 'ERREUR: Mi-Slider  '.$db->getErrMessage().'<br><br>'; }
        else {   
 // echo $db->q;
		$this->nav = '<nav>';
		$this->li = '<ul> ';
		$dc = 0;  
		$result = $db->getAllRows();  
		
		
		
		 $i=0;
		 $it = 'item_'.strtolower($this->lg);
		 $p = $this->obj->param->$it;
	 foreach($result as $el)  
	   { $i++;
		
		if ($dc != $el['id_cat']) { 
		
		   if ($dc !=0) { $this->li .= '</ul><ul><!--  '.$i.' -->    '; }
           $this->nav .= '<a href="#" id="'.$i.'" >'.$el['libcat_'.strtolower($this->lg)].' </a>' ; $dc = $el['id_cat'] ; 
		   
		  
   
        }
   
    $item = $this->getItem($el['param']);
    $this->li .= '<li><a href="'.strtolower($this->lg) .'/produits/detail-'.$p.'-'.$el['id'].'-'.$item.'.html"><img src="'.$el['etiquette'].'" width="150" /></a></li>';
 
 }
 
 $this->li .= '</ul> ';
 $this->nav .= '</nav>';
 $mod  ='<section id="carou"><div id="mi-slider"  class="container mi-slider">';
 $mod  .= $this->li ;
 $mod .= $this->nav ;
 $mod .= '</div></section>';
 $mod .= '<script src="modules/mi-slider/js/jquery.catslider.js"></script>';
 $mod .= "<script> \$(function() {\$( '#mi-slider' ).catslider();});</script> ";
 
 return $mod;
 
}
}

		function getItem($p) {
		
	     $param  = json_decode($p);	
		 
		 
		 
		 $m = 'menu_'.$this->lg;
		return $param->$m;
		}
 
}
?>
