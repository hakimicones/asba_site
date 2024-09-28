<?php 

class viewAgences {
    public $rows ;
	public $lg;
	public $id;
	public function __construct($rows, $obj)
		{
			 $this->rows	= $rows;
			 $this->lg		= $obj->lg; 
			 $this->id		= $obj->id; 
			 
		}
    public function display() {
	
	$modal = '';
	$latitude = '';
	$longitude = '';
	$i=0; 
	
	$region = (isset($_POST['region'])) ?  (int) $_POST['region'] : 1 ;


	$select = $this->renSelctXML(  $region);
	
	$li = 	'<section id="agences"   style="margin-top: 20px;">'
			.'<script type="text/javascript src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLnbl2BaBM5e8dbVZBEkUnrZ5KhxFU_SI&language=fr"></script>'
			.'<div class="container"> <form action="'.$this->lg.'/agences/list-'.$this->id.'-0.html" method="post" >  '.$select.' <div class="row">
			  <div class="col-lg-4">'			 
			.'<ul class="agences">';
			
			$active ="active";
		
		foreach ($this->rows  as $row )   { 
		
		
		if (empty($latitude)) { $latitude = $row['latitude'] ;	$longitude = $row['longitude'];  }
		
		 $i++;
		 $li .= '<li class="c_agence">
		         <div class="row r_agence '.$active.'  agence-'.$i.'"> 
				 <h3>
					 <a href="javascript:affMap(\''.str_replace(",",".",$row['longitude']).'\',\''.str_replace(",",".",$row['latitude']).'\','.$i.' )" >'
						.$row['libelle_'.$this->lg].'
					 </a>
				 </h3>
				 <div class="lib adr" >'	.$row['adresse_'.$this->lg] .'</div>';
		$l1   ='';
		
		$l2   ='';
		$active ="";		
		
		$l3   = ''; 
		
		
		 if ( $this->lg!='ar') { $li .= $l3. $l2 . $l1; } else{ $li .= $l1 .$l2.$l3; } 
		
		$li .= 		 '</div></li>';
 		//$modal .= $this->getModal($row);
	 	}
		$li .= '</ul>
		             </div>
					 <div class="col-sm-8 map-div" id="agence-map"> '.$this->getMap($latitude , $longitude ).'</div>
					 </div>
		              </form>
					    </div>  </section>';
						
						
		$script = '<script>	
		 
		 
		 function affMap(long,lat,e) {
		 
		 $("#agence-map").html("Patientez..."); 
		 
		 $(".r_agence").removeClass("active");
		 
		  $(".agence-"+e).addClass("active");
		 
		 
		 var html  =  \'<iframe \' ;
			 html +=  \'width="100%" \';
			 html +=  \'height="100%" frameborder="0"\ scrolling="no" \';
			 html +=  \'marginheight="0" marginwidth="0" \';
			 html +=  \'src="https://maps.google.com/maps?q=\'+long+\',\'+lat+\'&hl=es;z=14&amp;output=embed" >\';
			 html +=  \'</iframe>\';
			// html +=  \'\';
			 
			$("#agence-map").html(html); 
		 
		 }
		
		</script>';
		return $li.$script;
	
	}
	
	public function getMap($latitude , $longitude ) {
	
	// <iframe src="https://maps.google.com/maps?q='.str_replace(",",".",$row['longitude']).','.str_replace(",",".",$row['latitude']).'&hl=es;z=14&amp;output=embed" width="570" height="420" frameborder="0" style="border:0" allowfullscreen></iframe> 
	$map = '<iframe 
			  width="100%" 
			  height="100%" 
			  frameborder="0" 
			  scrolling="no" 
			  marginheight="0" 
			  marginwidth="0" 
			  src="https://maps.google.com/maps?q='. str_replace(",",".",$longitude) .','. str_replace(",",".",$latitude).'&hl=es;z=14&amp;output=embed" >
 			</iframe>';
 
 return $map ;
	
	}
	public function getSearchInput() { 
	$html = '<div ><input type="text"  onBlur="this.form.submit();" class="search_anim" name="search" placeholder="{recherche}.."></div>' ;
	return $html;
	}
	
	
	// Modal 
	
	public function getModal($row) {
	
	 
	}
	
	
	public function renSelctXML( $select ) {
	
	
	
	
 
	$data ='<label class="col-sm-6 control-label"> {choix_region} </label>
	           <div class="col-sm-6 col-xs-12 ">'
		  .'<select  class="form-control"  id="region" name="region" onchange="submit()"   >';
	 $dom = new DOMDocument();
	  $dom->load( "Adm/xml/region.xml"); 
	  
	  $form =  $dom->getElementsByTagName("region_".$this->lg  );
	foreach($form as $pp) { 
	$p = $pp->firstChild->nodeValue;
	$v = $pp->getAttribute("value");
	$selected = ($v!=$select)?'':'selected="selected"';
	$data .='<option value="'.$v.'" '.$selected.'   >'.utf8_decode($p).'  </option>';
	
	}
	 $data .='</select> </div>';
	
	return '<div class="row" id="region_div">'.$data.'</div>' ;
	 
	
	}

//Fin classe
}
?>
