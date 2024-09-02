<?php 

class viewCvtech {
    public $rows ;
	public $lg;
	public $id;
	public $type;
	public $format;
	public $exper;
	public function __construct($rows, $obj)
		{
			 $this->rows	= $rows;
			 $this->lg		= $obj->lg; 
			 $this->id		= $obj->id; 
			 $this->type	= $obj->type;
			 $this->format	= $obj->format;
			 $this->exper	= $obj->exper;
		}
		
    public function display() { 
	$modal = '';
	$li = 	'';
		
		foreach ($this->rows  as $row )   {  
	 
		$li .= '<li class="cadre">
		        <div class="row">';
			//href="javascript:;" data-toggle="modal" data-target="#form_'.$row['id'].'"	
				
		$l1   ='<div class="col-sm-4 map-img">  <a href="'.$this->lg.'/cvtech/postuler-'.$this->id.'-'.$row['id'].'" >   
				 <img src="images/candidat_'.$this->lg.'.png" height="75" width="75" /> </a> </div>  ';
		
		$l2   =	 '<div class="col-sm-8"> <a href="is-cvtech-'.$row['id'].'-candidat.html"> '
					 . $row['libelle_'.$this->lg] .'  </a>'	
					 .'<div >'.$row['niveau_poste'] .'</div>'
					 .'<div >'.$row['niv_etude'].'</div>' 
					 .'<div >'.$this->getTypeContrat($row['type_contrat']).'</div>' 
					  
					 .'<div><a href="javascript:;" id="btn-'.$row['id'].'"  onclick="affDescription(\'pan-'.$row['id'].'\',\'btn-'.$row['id'].'\' )"   class="btn btn-primary"  >
		               {lire plus} <i class="fa fa-arrow-down" aria-hidden="true"></i> </a></div> '
				     .'</div>';
		if ( $this->lg!='ar') { $li .= $l2 . $l1; } else{ $li .= $l1 .$l2; } 
		
		$li .= 	 '</div><div class="pan-slide" id="pan-'.$row['id'].'"><hr>'.$row['description_' .$this->lg]  .'
		          <div style="padding-top:20px;"><a href="javascript:;" id="btn-up-'.$row['id'].'"  onclick="cacheDescription( '.$row['id'] .' )"   class="btn btn-primary"  >
		            {reduire} <i class="fa fa-arrow-up" aria-hidden="true"></i></a></div> </div></li>';
 		 
	 	 $cl = 'class="cadre"';
		 
	 	}
		
		
		$data =  '<section id="cvtech"   style="margin-top: 20px;">'
			.'<div class="container"><form action="'.$this->lg.'/cvtech/list-'.$this->id.'-1.html" method="post">'
			.$this->getSearchInput()
			.'<ul class="agences ">'.$li.'</ul></form></div> </section>'; 
		 
		return $data;
	
	}
	
	
	
	public function getTypeContrat($ty) {
	$t_lib = '';
		foreach ($this->type  as $t )   {
			
			if ($t['id'] == $ty) {$t_lib = $t['libelle_'.$this->lg];} 
			
			
		}
		return $t_lib ;
	} 
	
	
	
	public function renSelect($r,$n,$ch) {
	
	$t_lib = '<div class="form-group"> <select name="'.$n.'" class="modal_form select-pick" 
			 data-error="'.ucfirst($n).' : Vous devez faire une selection " required>';
	$t_lib .='<option value="" class="select-1"> '. $ch.'</option>';
		foreach ( $r as $t )   { 
			$t_lib .='<option value="'.$t['id'].'"> '.$t['libelle_'.$this->lg].'</option>';
		}
	$t_lib .='<option value="0" class="select-2"> {autres '.  $n .'}</option>';		
	$t_lib .= '</select>
			  <input type="text" name="autre_'.$n.'" id="autre_'.$n.'"  placeholder="{autres '.  $n .'}" style="display:none">
			  <div class="help-block with-errors"></div></div>';	
	return $t_lib ;  
	}
	
	public function renSelect2($r,$n,$ch) {
	$i = 0 ; 
	
	$t_lib = '<div class="form-group"> <select name="'.$n.'"  class="modal_form select-pick" 
	          data-error="'.ucfirst($n).' : Vous devez faire une selection " required>';
	$t_lib .='<option value="" class="select-1"> '. $ch.'</option>';
		foreach ( $r as $t )   { 
		$i++;
			$t_lib .='<option value="'.$i.'"> '. $r[$i].'</option>';
		}
	$t_lib .= '</select><div class="help-block with-errors"></div></div>';	
	return $t_lib ;  
	}
	
 
	
	/******************************/
	public function getSearchInput() { 
	$html = '<div ><input type="text"  onBlur="this.form.submit();" class="search_anim" name="search" placeholder="{recherche}..."></div>' ;
	return $html;
	}
	
	// Formulaire
	
	public function getPostuler() {
	
	$id = (isset($_GET['num']))? (int) $_GET['num']:'0';
	//print_r($this->rows);
	 
	
	$data  =  '<div class="container"><div class="white-form">';
	$data .=  '<form class="form_lignes" id="form_cv"  method="post" role="form" data-toggle="validator">
			  <h3>'.$this->rows['libelle_'.$this->lg]  .'</h3> <hr><div class="form-group">
			  <input type="text" name="nom" placeholder="{nomprenom}"  data-error="OOPS : Vous devez saisir le Nom et le prenom " required> 	
			  <div class="help-block with-errors"></div></div>	
			  <input type="text" name="adresse" placeholder="{adresse}"><div class="row">';
	$v1    =   '  <div class="col-sm-6"><input type="text" name="ville" placeholder="{ville}"></div>';
	$v2    =   ' <div class="col-sm-6"> <input type="text" name="wilaya" placeholder="{wilaya}"> </div>';
		
	if ( $this->lg!='ar') { $data .= $v1 .   $v2;  } else{ $data .=  $v2 . $v1 ;  } 	
		
	$data .=	'</div> <div class="row"> ';
	
	
	$v1    =   ' <div class="col-sm-6">	<input type="text" name="tel" placeholder="{tel}"></div>';
	$v2    =   '<div class="col-sm-6"> <input type="text" name="mob" placeholder="{mob}"> </div>';
	
	if ( $this->lg!='ar') { $data .= $v1 .   $v2;   } else{ $data .=  $v2 . $v1 ;  } 
	$data .=	'</div> <div class="form-group"> 
		         <input type="email" name="email" placeholder="{email}" data-error="OOPS : L\'adresse E-mail est mal saisie ex:nom@domain.com " required>
				 <div class="help-block with-errors"></div></div> ';
	$data .=	'<div class="row"> ';	
	
	
	 $v1    ='<div class="col-sm-6"><input type="text" name="nele" placeholder="{nele}"></div>' ; 
	 $v2    ='<div class="col-sm-6"><input type="text" name="lieu" placeholder="{lieu}"></div>' ; 
	 
	 if ( $this->lg!='ar') { $data .= $v1 .   $v2;   } else{ $data .=  $v2 . $v1 ;  } 
	 // 	= ; $this->format	= $obj->format;
			 
	// = $obj->exper;
	//  <input type="text" name= placeholder="{experience}">
	
	$data .=	'</div> <div class="row">';
	    
		 $v1    ='<div class="col-sm-6 selectContainer">'.$this->renSelect($this->format,"formations" , "{formation}").'</div> ' ; 
		 $v2    ='<div class="col-sm-6 selectContainer">'.$this->renSelect($this->exper	,"experience", "{experience}").'</div> ' ; 
		 
	if ( $this->lg!='ar') { $data .= $v1 .   $v2;   } else{ $data .=  $v2 . $v1 ;  } 
	 
	$data .=	'</div> <div class="row">';
	
	$data .=   '<input type="text" name="dern_poste" placeholder="{dern_poste}" > ';
		 
	$data .=	'</div> <div class="row">';
	 $sit = array(  1  => "{celibataire}", 2    => "{marie}",  3 => "{marie_enfant}",  4 => "{divorce}" , 5 => "{veuf}" );
	 $sex = array(  1    => "{homme}",  2  => "{femme}"  );	 
	
	 $v1    ='<div class="col-sm-6 ">'.$this->renSelect2(  $sex	, "sex","{sex}").'</div> ' ;
	 $v2    ='<div class="col-sm-6">'.$this->renSelect2(   $sit	,"situation" ,"{situation}" ).'</div> ' ;
	 
	 if ( $this->lg!='ar') { $data .= $v1 .   $v2;   } else{ $data .=  $v2 . $v1 ;  } 
	 
	 $data .=  '<br><br><br>';
	 $data .=   '<input type="textarea" name="obs" placeholder="{ce_que_tu_veut}" > ';
	 $data .=	'<br><br><br><hr></div> <input name="task" type="hidden" value="candidat"><input name="id_offre" type="hidden" value="'.$id.'">
	 			<button class="btn btn-primary" type = "submit"> {send} </button> 
				<button class="btn btn-danger" type = "reset">  {effacer} </button>
	 			</form></div></div>';
	 $data .= '<script src="librairies/bootstrap/js/bootstrap-select.min.js"></script> ';	
	 $data .= '<script> $(".select-pick").selectpicker().change(function(e) {  
	 var id = "autre_"+$(this).attr("name");
	 if ($(this).val()=="autre") {  
	 $("#"+id).css(\'display\',\'block\');   } else {
	 $("#"+id).css(\'display\',\'none\'); }
	    
	 
	 }) </script>    ';			
				
       
	   
	   return $data ;
	
	}
	
	public function getForm($row) {
	 
	$data  =  '<form class="form_lignes" id="form_cv"  method="post">
			  <input type="text" name="nom" placeholder="{nomprenom}"> 		
			  <input type="text" name="adresse" placeholder="{adresse}"><div class="row">';
			  
	$v1    =   '  <div class="col-sm-6"><input type="text" name="ville" placeholder="{ville}"></div>';
	$v2    =   ' <div class="col-sm-6"> <input type="text" name="wilaya" placeholder="{wilaya}"> </div>';
		
	if ( $this->lg!='ar') { $data .= $v1 .   $v2;  } else{ $data .=  $v2 . $v1 ;  } 	
		
	$data .=	'</div> <div class="row"> ';
	
	
	$v1    =   ' <div class="col-sm-6">	<input type="text" name="tel" placeholder="{tel}"></div>';
	$v2    =   '<div class="col-sm-6"> <input type="text" name="mob" placeholder="{mob}"> </div>';
	
	if ( $this->lg!='ar') { $data .= $v1 .   $v2;   } else{ $data .=  $v2 . $v1 ;  } 
	$data .=	'</div>
	
	
		<input type="text" name="email" placeholder="{email}">';
	$data .=	'<div class="row"> ';	
	
	
	 $v1    ='<div class="col-sm-6"><input type="text" name="nele" placeholder="{nele}"></div>' ; 
	 $v2    ='<div class="col-sm-6"><input type="text" name="lieu" placeholder="{lieu}"></div>' ; 
	 
	 if ( $this->lg!='ar') { $data .= $v1 .   $v2;   } else{ $data .=  $v2 . $v1 ;  } 
	 // 	= ; $this->format	= $obj->format;
			 
	// = $obj->exper;
	//  <input type="text" name= placeholder="{experience}">
	
	$data .=	'</div> <div class="row">';
	    
		 $v1    ='<div class="col-sm-6">'.$this->renSelect($this->format,"formations" ,'').'</div> ' ; 
		 $v2    ='<div class="col-sm-6">'.$this->renSelect( $this->exper	, "experience" ,'').'</div> ' ; 
		 
	if ( $this->lg!='ar') { $data .= $v1 .   $v2;   } else{ $data .=  $v2 . $v1 ;  } 
	 
	$data .=	'</div> <div class="row">';
		 
 
	 $sit = array(  1  => "{celibataire}", 2    => "{marie}",  3 => "{marie_enfant}",  4 => "{divorce}" , 5 => "{veuf}" );
	 $sex = array(  1    => "{homme}",  2  => "{femme}"  );	 
	
	 $v1    ='<div class="col-sm-6">'.$this->renSelect2(  $sex	, "sex" ,'').'</div> ' ;
	 $v2    ='<div class="col-sm-6">'.$this->renSelect2(   $sit	,"situation"  ,'' ).'</div> ' ;
	 
	 if ( $this->lg!='ar') { $data .= $v1 .   $v2;   } else{ $data .=  $v2 . $v1 ;  } 
	 $data .=	'</div> <input name="task" type="hidden" value="candidat"><input name="id_offre" type="hidden" value="'.$row['id'].'"></form>';

    $data .='<script> function envoiForm(form) { var f = document.getElementById(form); f.submit();   }    </script>    ';
	
	//return $this->getModal($row,$data,'form_','form_cv');
	
	}
	
	// Modal 
	
	public function getModal($row,$data,$idm,$form) {
	$html = '<div class="modal fade" id="'.$idm.$row['id'].'">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> '. $row['libelle_'.$this->lg] .' </h5>
		</div>
      <div class="modal-body">
        <p>'.$data.'</p>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-primary"  onClick="envoiForm(\''.$form.'\')"  >{postuler}</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{close}</button>
      </div>
    </div>
  </div>
</div>';
	
	
	return $html;  }
	
	
	
	//************ Candidats **********************/
	public function getCandidat() { 
	 
	 $data  = '<section id="agences"   style="margin-top: 20px;">'
			.'<div class="container">  ';
	 $data .= '<div class="alert alert-'.$this->rows["type"].' cadre2 " role="alert">'.$this->rows["contenu"].'</div>';
	$data .= '  </div>  </section>'; 
	 
	return  $data ;
	
	}
//Fin classe
}


?>
