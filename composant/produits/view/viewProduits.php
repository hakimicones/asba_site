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
			 $this->detect  = $obj->detect;
			 
			 if ( strtolower($this->lg)!='fr') { $this->rtl = "rtl" ;}

		//	 print_r($_GET);
			
		}
		
    public function display() { 
	$modal = '';
	
	
	$li = 	'<section id="tabs"   style="margin-top: 20px;">'
			.'<div class="container"><form action="ar/produits/liste-'.$this->page_id.'-0.html" method="post">'
			.$this->getSearchInput()
			.'<ul class="nav nav-tabs">';
		
		foreach ($this->rows  as $row )   {  
	 
		$li .= '<li class="nav-item">
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
	
	
	   
	   
	  
		 
		$li =  (!$this->detect->isMobile()) ? '<ul class="nav nav-tabs '.strtolower($this->lg).'" id="tabs" role="tablist" dir="'.$this->rtl.'">' : '';
		
		
		$di =  (!$this->detect->isMobile()) ? '<div class="tab-content" id="myTabContent">' : '<div id="accordion">'; 
		$i =0 ;
		$mob   =  (!$this->detect->isMobile()) ? '' :'mob';
		$html  =  '<section id="produits'.$mob.'"><div class="container">  ';
		$html .= $this->getMenuProduit('') ;
		$active 	= " show active" ;
		$selected 	= 'selected';
		$control 	= "true";
		$show = 'show'; 
		foreach ($this->desc   as $desc)   { 
		
		
		$li .=  (!$this->detect->isMobile()) ? '<li class="nav-item '.$selected.'">
					<a class="nav-link  '.$active.'" href="#menu'.$i.'"  role="tab" aria-controls="menu'.$i.'" aria-selected="'.$control.'">  '
						.$desc['libelle'].' 
					</a>
				</li>' : '';
		$di .=  (!$this->detect->isMobile()) ?  '<div id="menu'.$i.'" class="tab-pane fade '.$active.'">'.$desc['intro_text'].'</div>'
		                                     : '
												 <div class="card">
													<div class="card-header" id="heading'.$i.'">
													  <h5 class="mb-0">
														<button class="btn btn-link" data-toggle="collapse" data-target="#collapse'.$i.'" aria-expanded="true" aria-controls="collapseOne">
														 '.$desc['libelle'].'
														</button>
													  </h5>
													</div>
												
													<div id="collapse'.$i.'" class="collapse '.$show.'" aria-labelledby="heading'.$i.'" data-parent="#accordion">
													  <div class="card-body card-White">
														'.$desc['intro_text'].'
													  </div>
													</div>
												  </div>
												 
												 ';
		$active 	= "" ;
		 $show = ''; 
		$control 	= "false";
		$selected 	= '';
		$i++;
		}
		
		$li .= (!$this->detect->isMobile()) ? '</ul>' : '';
		$di .= '</div>';
		$script='<script>
		 
			   
			 $("#tabs li a").click(function (e) { 
					e.preventDefault();
					$(".nav-item").removeClass("selected");
					$(this).parent().addClass("selected");
					
					$(this).tab("show");
				});
			 
		
       </script>';
	
		
		
		$html .= $li .$di .$script.'</div></section>';
	 	return  $html ;
	}
	
 
	public function getMenuProduit($row) {
	/*
		$url = 'composant/produits/view/tpl/menu.php';
		$data = file_get_contents($url) ;
		$d = str_replace ( '{liens_sim}' ,$this->getSim($this->liens)  , $data) ;	
			
				 
	return $d ;*/
	}
	public function getSim( $liens) {
	    $html  =' '; 
		if (!empty($liens)) {
		$html .='';
		//  
		foreach ($liens   as $lien) {
		$html  .= '<a class="dropdown-item" href="'.$this->lg.'/produits/detail-'.$this->page_id.'-'.$lien['id'].'" class="'.$this->lg.'" dir="'.$this->rtl.'"> '.$lien['libelle_'.$this->lg] .' </a>';
		}	 		 
		$html  .= ' ';	} 
	return $html;
	}
//Fin classe
}
?>
