<?php 
require_once ("includes/Mobile_Detect.php");
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
			 $this->detect 		= new Mobile_Detect;
			 
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

		//print_r($this->rows);

		$style = '<link rel="stylesheet" href="composant/produits/css/produit_style.css" media="all">';

		$li = '<div id="aspect-content" class="nav nav-tabs '.strtolower($this->lg).'" dir="'.$this->rtl.'">' 
		      .''
		      .$this->getMenuProduit('') ;;
		$first  = 'first';    
		$i =0 ;
		$html  = '<section id="produits"><div class="container">  ';

		$width = ($this->detect->isMobile()) ? 61 : 100 ;
		$asp   =  ($this->detect->isMobile()) ? 'style ="display:none"':'';
		 
		$img = ' <img src="'.$this->rows['etiquette'].'" style="width:'.$width.'px; position: absolute;    top: 10px;    left: 20px;">'; 

		foreach ($this->desc   as $desc)   { 
		

		$s=$i+1;
		//'.$asp.'
		$li .= '<div class="aspect-tab '.$desc['css'].' '.$first.'">
		<input id="item-'.$i.'" type="checkbox" class="aspect-input" name="aspect">
		<label for="item-18" class="aspect-label"></label>
		
		<div class="aspect-content"  >
			<div class="aspect-info">
				<div class="chart-pie negative over50">
				
				<div>
			</div>
		</div>
		<span class="aspect-name"><h2>'.$desc['libelle'].'  <h2> </span>
	</div>
	<div class="aspect-stat-'.strtolower($this->lg).'">
	<div class="all-opinions">
	 '.$img.'
	</div>
	 
	</div>
	</div>
	<div class="aspect-tab-content ">
  		<div class="sentiment-wrapper desc ">
			<div class="with-2-3">
			 
				<p>'.$desc['intro_text'].'</p>
				
			</div> 
	    </div>
	 </div>
	
	 
 </div>
	';
	$i++;
		$first = ($i<5)? "detail  detail".$i:'detail';
		$img = '';
		$asp = '';
		}
		
		$li .= ' </div>';
	 
	
		$script = '
		<script>
			$(".aspect-tab").click(function() {
			//  $(".aspect-content ").toggleClass(transform-active");
			//   $(".aspect-content" ).toggleClass(" transform-active");

				 
				var inp = $(this).find(".aspect-input").prop("checked");


				 
				$(this).find(".aspect-input").prop("checked", !inp);
			});

		</script>
		';
		
		$html .= $style.$li .$script .'</div></section>';
	 	return  $html ;
	}


	//************ Details **********************/
	public function getDetail1() { 
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
