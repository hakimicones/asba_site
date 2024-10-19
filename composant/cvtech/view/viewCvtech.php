<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
			 
			 
			 $this->type		=  (isset($obj->type))  ?   $obj->type  : null ;
			 $this->format		= (isset($obj->format)) ?  $obj->format : null ;
			 $this->exper		= (isset($obj->exper))  ? $obj->exper   : null ;
			 $this->categories 	= (isset($obj->categories))  ? $obj->categories : null ;
			 
			 
		}
		
		
		
    public function display() { 
	$modal = '';
	$li = 	'';
		
		foreach ($this->rows  as $row )   {  
	 
		$li .= '<li class="cadre">
		        <div class="row">';
			//href="javascript:;" data-toggle="modal" data-target="#form_'.$row['id'].'"	
				
		$l1   ='<div class="col-sm-2  ">  <a href="'.$this->lg.'/cvtech/postuler-'.$this->id.'-'.$row['id'].'" class="btn-cv" >   
				 <img src="images/candidat_'.$this->lg.'.png" height="75" width="75" /> </a> </div>  ';
		
		$l2   =	 '<div class="col-sm-8"> 
		              <a href="'.$this->lg.'/cvtech/postuler-'.$this->id.'-'.$row['id'].'"> <h4>'. $row['libelle_'.$this->lg] .'  </h4>  </a>'	
		       .'<div class="row">'       
					 .'<div class="col">'.$row['lib_type'] .'</div>'
					 .'<div class="col" >'.$row['lib_etude'].'</div>' 
					 .'<div class="col" >'.$row['lib_contrat'].'</div>' 
					 .'<div class="col" > {Nombre de postes} : '.$row['nbr_postes'] .'  </div>' 
					 .'</div>'  
					 .'</div>
					 <div class="col-sm-2">
						  <a href="javascript:;" id="btn-'.$row['id'].'" onclick="affDescription( '.$row['id'].'  )" class="btn btn-primary btn-plus">
						   {lire plus} <i class="fa fa-arrow-down" aria-hidden="true"></i> 
						  </a>
					 </div> '
				     .'';
		if ( $this->lg!='ar') { $li .= $l1 . $l2; } else{ $li .= $l2 .$l1; } 
		
		$li .= 	 '</div><div class="pan-slide collapse" id="pan-'.$row['id'].'"><hr>'.$row['description_' .$this->lg]  .'
		          <div style="padding-top:20px;"><a href="javascript:;" id="btn-up-'.$row['id'].'"  onclick="cacheDescription( '.$row['id'] .' )"   class="btn btn-primary"  >
		            {reduire} <i class="fa fa-arrow-up" aria-hidden="true"></i></a></div> </div></li>';
 		 
	 	 $cl = 'class="cadre"';
		 
	 	}
		
		$url = 'composant/cvtech/js/script.js'; 
		$script = file_get_contents($url) ;
		
		$messages = (isset($_POST['search'])) ?  '<div class="message ">{recherche} : '.$_POST['search'].'</div> <hr>' : '';
		$data =  '
		 
		<section id="cvtech"   style="margin-top: 20px;">'
			.'<div class="container">
					<form id="cvtech-form" action="'.$this->lg.'/cvtech/list-'.$this->id.'-1.html" method="post">
					   '.$messages
					   		
					
						.$this->getSearchInput()
						.'<ul class="offres ">'.$li.'</ul>
						<input type="hidden" id="lg" value="' .$this->lg.'">
						
					</form>
			   </div> 
			<script> '.$script .'</script>
	     </section>'; 
		 
		return $data;
	
	}
	
	
	
	public function getTypeContrat($ty) {
	$t_lib = '';
		foreach ($this->type  as $t )   {
			
			if ($t['id'] == $ty) {$t_lib = $t['libelle_'.$this->lg];} 
			
			
		}
		return $t_lib ;
	} 
	
	
	
	public function renSelect($r,$n,$ch,$first = true ) 
	{
		
	$t_lib = '
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	<select class="custom-select select2" aria-label="Default select example" name="'.$n.'" id="'.$n.'">';
	$t_lib .=($first) ?'<option value=""  class="select-1"> '. $ch.'</option>' : '';
		foreach ( $r as $t )   { 
			$t_lib .='<option value="'.$t['id'].'"> '.$t['libelle_'.$this->lg].'</option>';
		}
		$t_lib .=  '</select> ';	
	$t_lib .=($first) ?  ' 
	<script>
    $(".select2").select2();
	
	
</script>
	
	
	' : '';	
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
	$html = '<div class="row">
		    
			         
			         <div class="col-4 selectContainer ">
					 <input type="text"   class="search_anim form-control" name="search" placeholder="{recherche}...">
 
					 </div>
					 
					 
					 <div class="col-3 selectContainer ">'.$this->renSelect($this->categories ,"categories" , "{toutes categories}").'</div>
					 
					 <div class="col-3 selectContainer">'.$this->renSelect(array() ,"sous-categories" , "{sous-categorie}").'</div>
					 
					 <input type="hidden" name="label" id="label-sous-categorie" value="{sous-categorie}">
					 <div class="col-2 "> <a href="javascript:search()" class="btn btn-primary" >{recherche} <i class="fa fa-search" aria-hidden="true"></i></a> </div>
							   
			</div>' ;
	return $html;
	}
	
	// Formulaire
	
	public function getPostuler() {


      
	
	    $id = (isset($_GET['num']))? $_GET['num']:'0';

        $libelle = 

		$url = 'composant/cvtech/view/tpl/form.php'; 
		$f = file_get_contents($url) ;
		
		$tag[]  =  '{liste formation}';
		$ext[]  =  $this->renSelect($this->format ,"formations" , "{formation}",false);	
		
		$tag[]  =  '{liste experience}';
		$ext[]  =  $this->renSelect($this->exper ,"experience" , "{experience}",false);	


		$tag[]  =  '{libelle}';
		$ext[]  =  (isset($this->rows['libelle_'.$this->lg])) ?  $this->rows['libelle_'.$this->lg] : '';

		$tag[]  =  '{id_offre}';
		$ext[]  = (isset($this->rows['id'])) ? $this->rows['id'] : 0;

		$tag[]  =  '{text_contenu}';
		$ext[]  = (isset($this->rows['intro_text'])) ? $this->rows['intro_text'] : '';


		$form_latin = '
				<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="adresse">{nom_latin}</label>
								<input type="text" class="form-control" name="nom_latin" placeholder="Nom"  required>
							</div> 
						</div> 	
						<div class="col-sm-6">
							<div class="form-group">
								<label for="adresse">{prenom_latin}</label>
								<input type="text" class="form-control" name="prenom_latin" placeholder="Prenom"  required>
							</div> 
						</div> 
			</div>';

		$tag[]  =  '{nomprenom_latin}';
		$ext[]  =  ($this->lg =="ar") ?  $form_latin : '';







		
		 
		
		



		
		$data = str_replace ( $tag , $ext , $f) ;
		
 	    			
	    return $data ;
	
	}
	
	public function getForm($row) 
	{
	 
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
