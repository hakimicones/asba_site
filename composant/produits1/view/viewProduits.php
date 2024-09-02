<?php 

class viewProduits {
    public $rows ;
	public $lg;
	public $id;
	public $type;
	public $format;
	public $exper;
	public $rtl='ltr';
	public $liens;
	public $page_id;
	public $desc;

	public function __construct($rows, $obj)
		{    
		  
			 $this->rows	= $rows;
			 $this->lg		= $obj->lg; 
			 $this->id		= $obj->id; 
			 $this->liens	= $obj->liens; 
			 $this->page_id	= $obj->page_id;
			 $this->desc	= $obj->desc;
			 
			 if ( strtolower($this->lg)!='fr') { $this->rtl = "rtl" ;}
			
		}
		
    public function display() { 
	$modal = '';
	$li = 	'<section id="agences"   style="margin-top: 20px;">'
			.'<div class="container"><form action="ar/produits/liste-'.$this->page_id.'-0.html" method="post">'
			.$this->getSearchInput()
			.'<ul class="agences">';
		
		foreach ($this->rows  as $row )   {  
	 
		$li .= '<li class="cadre">
		        <div class="row">';
		$l1   ='<div class="col-sm-4 map-img">  <a href="javascript:;" data-toggle="modal" data-target="#form_'.$row['id'].'">   
				 <img src="'.$row['etiquette'].'" height="75" width="75" /> </a> </div>  ';
		
		$l2   =	 '<div class="col-sm-8"> <a href="'.$this->lg.'/produits/detail-'.$this->page_id.'-'.$row['id'].'.html"> '
					 . $row['libelle_'.$this->lg] .'  </a>'	
					 .'<div>'. $row['description_'.$this->lg] .'</div>'; ;
		if ( $this->lg!='ar') { $li .= $l2 . $l1; } else{ $li .= $l1 .$l2; } 
		 
	 	 
		 
	 	}
		
		
		$li .= '</ul></form></div> </section>';
		 
		return $li;
	
	}
	
	
	function getList() {}
	
	function getList1() {
	$li = 	'<section id="agences"   class="" style="margin-top: 20px;">'
			.'<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLnbl2BaBM5e8dbVZBEkUnrZ5KhxFU_SI&language=fr"></script>'
			.'<div class="container cadre"><form action="'.$this->lg.'/produits/list-'.$this->id.'-0.html" method="post">'
			.$this->getSearchInput()
			.count($this->rows).'<ul class="produits">';
		
		foreach ($this->rows  as $row )   { 
		
		 
		 $li .= '<li><a href="/produits/detail-'.$this->id.'-'.$row['id'].'.html"> '.$row['libelle_'.$this->lg ].'</a> </li>';
 		 
	 	}
		$li .= '</ul></form></div>  </section>';
		return $li;
	
	
	
	}
	 
	
	
	 
	 
	
 
	
	/******************************/
	public function getSearchInput() { 
	$html = '<div ><input type="text"  onBlur="this.form.submit();" class="search_anim" name="search" placeholder="{recherche}..."></div>' ;
	return $html;
	} 
	
	//************ Details **********************/
	public function getDetail() { 
		$li = '<ul id="tabs" class="nav nav-tabs '.strtolower($this->lg).'" dir="'.$this->rtl.'">';
		$di = '<div class="tab-content">';
		$i =0 ;
		$html  = '<section id="produits"><div class="container">  ';
		$html .= $this->getMenuProduit('') ;
		$active = "active" ;
		foreach ($this->desc   as $desc)   { 
		
		
		$li .= '<li class="'.$active.'"><a class="a-tab " data-toggle="tab" href="#menu'.$i.'">  '.$desc['libelle'].' </a></li>';
		$di .= '<div id="menu'.$i.'" class="tab-pane fade in '.$active.'">'.$desc['intro_text'].'</div>';
		$active = "" ;
		$i++;
		}
		
		$li .= '</ul>';
		$di .= '</div>';
		$script='<script> if(window.matchMedia("(max-width:360px)").matches)  {   $("#tabs").removeClass("nav-tabs").addClass("nav-pills nav-justified"); } </script>';
	
		
		
		$html .= $li .$di .$script.'</div></section>';
	 	return  $html ;
	}
	
 
	public function getMenuProduit($row) {
	
		$url = 'composant/produits/view/tpl/form.php';
		$data = file_get_contents($url) ;
		$d = str_replace ( '{liens_sim}' ,$this->getSim($this->liens)  , $data) ;	
			
				 
	return $d ;
	}
	public function getSim( $liens) {
	    $html  =''; 
		if (!empty($liens)) {
		$html .='<ul>';
		//  
		foreach ($liens   as $lien) {
		$html  .= '<li><a href="'.$this->lg.'/produits/detail-'.$this->page_id.'-'.$lien['id'].'" class="'.$this->lg.'" dir="'.$this->rtl.'"> '.$lien['libelle_'.$this->lg] .' </a></li>';
		}	 		 
		$html  .= '</ul>';	} 
	return $html;
	}
//Fin classe
}
?>
