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
	$i=0; 
	
	$li = 	'<section id="agences"   style="margin-top: 20px;">'
			.'<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLnbl2BaBM5e8dbVZBEkUnrZ5KhxFU_SI&language=fr"></script>'
			.'<div class="container"><form action="'.$this->lg.'/agences/list-'.$this->id.'-0.html" method="post">'
			.$this->getSearchInput()
			.'<ul class="agences">';
		
		foreach ($this->rows  as $row )   { 
		
		 $i++;
		 $li .= '<li class="c_agence">
		        <div class="row r_agence">';
		$l1   ='<div id="map-'.$i.'" class="col-sm-4 map-img"> <a href="javascript:;"   class="" data-toggle="modal" data-target="#map'.$row['id'].'">   
				 <img src="images/indice.png" height="100"   /> </a></div>';
		$l2   =	 '<div id="cont-'.$i.'" class="col-sm-5"><div class="c_int"> <span class="lib adr" >'	.$row['adresse_'.$this->lg] .'</span> <br>'
				 .'<div><span class="lib" >{tel} : </span><span  class="chif" dir="ltr" >'.$row['tel'].'</span></div>' 
				 .'<div><span class="lib" >{fax} : </span><span  class="chif" dir="ltr" >'.$row['fax'].'</span></div>' 
				 .'<div ><span class="lib" >{email}:</span><span  class="chif" > '.$row['email'].'</span></div><br><br>'
				 .'<div><span class="lib" >{directeur} : </span><span  class="chif"  >'.$row['directeur_'.$this->lg].'</span></div>' 
				 .'<div ><span class="lib" >{adjoint}:</span><span  class="chif" > '.$row['adjoint_'.$this->lg ].'</span></div>'.				 
		'</div></div>';
		$l3   = '<div id="img-'.$i.'" class="col-sm-3 cadre3 '.$this->lg  .'"><a href="index.php?option=agences&id='.$row['id'].'"> '
		 		 . $row['libelle_'.$this->lg] .'  </a><br><br><div class="img_agence"><img src="'.$row['image'].'" width="210px" class="img_agence"  >  </div> </div>'; 
		
		
		 if ( $this->lg!='ar') { $li .= $l3. $l2 . $l1; } else{ $li .= $l1 .$l2.$l3; } 
		
		$li .= 		 '</div></li>';
 		$modal .= $this->getModal($row);
	 	}
		$li .= '</ul></form></div> '.$modal.' </section>';
		$script = '<script>
		 
		if(window.matchMedia("(max-width:640px)").matches) {
		
		$( ".r_agence" ).each(function( index ) {  
		 
		var first  =  $( "#map-"+(index+1) ).detach()  ; 
		var sec  =  $( "#img-"+(index+1) ).detach()  ; 
		
		$( first ).insertAfter( "#cont-"+(index+1)  );
		$( "#cont-"+(index+1)  ).before( sec);
		
		
		});
		  
		
		}
		
		</script>';
		return $li.$script;
	
	}
	
	public function getMap($row ) {
	$script = '<iframe 
  width="570" 
  height="420" 
  frameborder="0" 
  scrolling="no" 
  marginheight="0" 
  marginwidth="0" 
  src="https://maps.google.com/maps?q='.$row['latitude'].','.$row['longitude'].'&hl=es;z=14&amp;output=embed"
 >
 </iframe>';
	
	}
	public function getSearchInput() { 
	$html = '<div ><input type="text"  onBlur="this.form.submit();" class="search_anim" name="search" placeholder="{recherche}.."></div>' ;
	return $html;
	}
	
	
	// Modal 
	
	public function getModal($row) {
	
	 //
	
	$html = '<div class="modal fade" id="map'.$row['id'].'">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> '. $row['libelle_'.$this->lg] .' </h5>
		</div>
      <div class="modal-body">
        <div id="map"></div>
			<iframe src="https://maps.google.com/maps?q='.str_replace(",",".",$row['longitude']).','.str_replace(",",".",$row['latitude']).'&hl=es;z=14&amp;output=embed" width="570" height="420" frameborder="0" style="border:0" allowfullscreen></iframe>  
			
			</div>
      <div class="modal-footer">
       
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{close}</button>
      </div>
    </div>
  </div>
</div>';
	
	//'.$row['obs'].'
	return $html;
	}

//Fin classe
}
?>
