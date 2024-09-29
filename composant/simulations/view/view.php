<?php 

class viewSimulations {
    public $rows ;
	public $lg;
 
	public $type;
	public $format;
	public $exper;
	public $rtl='ltr';
	public $liens;
	public $page_id;
	public $desc;
 
	public $id;
	public function __construct($rows, $html)
		{
		
		
			 $this->rows	= $rows;
			 $this->lg		= $html->obj->lg; 
			 $this->id		= $html->obj->id; 
			 $this->html	= $html;
			 $this->num		= $html->num;
			 $this->model   = $html->model;
			 
			 
			 
			 
			 
		}
    public function getList() {
	 
	 		$url = 'composant/simulations/view/tpl/page.php'; 
			$f = file_get_contents($url) ; 
			 
			
			$tag[]  =  '{dir}';
			$ext[]  =  ( $this->lg!='ar')?'ltr':'rtl';
			
			$tag[]  =	'{convs}';
			$ext[]  =	$this->getConv();		
			
			$param = json_decode( $this->rows['param']);
			
			$tag[]  =	'{simul1}';
			$ext[]  =   $this->getSimul1();
			
			
			$tag[]  =	'{simul2}';
			$ext[]  =   $this->getSimul2();
			
			
			$tag[]  =	'{simul3}';
			$ext[]  =   $this->getSimul3();
			
			$tag[]  =	'{tva}';
			$ext[]  =	(isset($param->tva) && $param->tva) ? $param->tva : 0 ;
			/*
			$tag[]  =	'{}';
			$ext[]  =  ;
			*/
			
			 


			$apport = ($this->num )?'':"html +=affRubTexte('apportPersonnel','{apportPersonnel}','{lg}','','hasData' );";
			
			$tag[]  =	'{apportPersonnel}';
			$ext[]  =	$apport;
			
			
		    $html = str_replace ( $tag ,$ext , $f) ;
		
		 return $html;
	/*
	
	*/
	 
	
	}
	
	 function getSimul2() {
	 
	 
	 	$param = json_decode( $this->rows['param']);
		
	 	$url = 'composant/simulations/view/tpl/form1.php'; 
		$f = file_get_contents($url) ;
			
		$tag[]  =	'{apportPersonnel}';
		$ext[]  =	'';
		
		$tag[]  =  '{tva}';
		$ext[]  =  (isset($param->tva) && $param->tva) ? $param->tva : 0 ;		
	 
		
		$tag[]  =  '{d_t1}';
	 
		$ext[]  =  (isset($param->d_t1) && $param->d_t1) ? $param->d_t1 : 0 ;
		
		$tag[]  =  '{d_t2}';
		$ext[]  =  (isset($param->d_t2) && $param->d_t2) ? $param->d_t2 : 0;
		
		$tag[]  =  '{d_t3}';
		$ext[]  =  (isset($param->d_t3) && $param->d_t3) ? $param->d_t3 : 0 ;
			
			
		$html = str_replace ( $tag ,$ext , $f) ;
		
		 return $html;
 
 
 
 }	
 function getSimul1() 
 {
   			$url = 'composant/simulations/view/tpl/form.php'; 
			$f = file_get_contents($url) ; 
			
			$tag[]  =  '{dir}';
			$ext[]  =  ( $this->lg!='ar')?'ltr':'rtl';
			
			$tag[]  =	'{convs}';
			$ext[]  =	$this->getConv();
			
			
			 $param = json_decode( $this->html->param);	 
			
			$tag[]  =	'{tva}';
			$ext[]  =	($param->tva) ? $param->tva : 0 ;;
			
			$tag[]  =	'{liens}';
			$ext[]  = $this->lg.'/vehicules/list-'.$this->id.'-0.html';
			
			
			$vehicules = ($this->num )? "html +=affRubHidden('montantBien' , '".$this->rows['prix']."','' );":$this->affListeVehicule(1);


			$tag[]  =	'{listevehicules}';
			$ext[]  =	$vehicules;


			$apport = ($this->num )?'':"html +=affRubTexte('apportPersonnel','{apportPersonnel}','{lg}','','hasData' );";
			
			$tag[]  =	'{apportPersonnel}';
			$ext[]  =	$apport;
			
			
		    $html = str_replace ( $tag ,$ext , $f) ;
		
		 return $html;
 
 
 
 }	

 function getSimul3() {
 
 
   			$url = 'composant/simulations/view/tpl/form2.php'; 
			$f = file_get_contents($url) ; 
			
			$tag[]  =  '{dir}';
			$ext[]  =  ( $this->lg!='ar')?'ltr':'rtl';
			
			$tag[]  =	'{convs}';
			$ext[]  =	$this->getConv();
			
			
			 $param = json_decode( $this->html->param);
			
			 
			
			$tag[]  =	'{tva}';
			$ext[]  =	($param->tva) ? $param->tva : 0 ;
			
			$tag[]  =	'{liens}';
			$ext[]  = $this->lg.'/vehicules/list-'.$this->id.'-0.html';
			
			
			$vehicules = ($this->num )? "html +=affRubHidden('montantBien' , '".$this->rows['prix']."','' );":$this->affListeVehicule(2);


			$tag[]  =	'{listevehicules1}';
			$ext[]  =	$vehicules;


			$apport = ($this->num )?'':"html +=affRubTexte('apportPersonnel','{apportPersonnel}','{lg}','','hasData' );";
			
			$tag[]  =	'{apportPersonnel}';
			$ext[]  =	$apport;
			
			
		    $html = str_replace ( $tag ,$ext , $f) ;
		
		 return $html;
 
 
 
 }	
	

	
 function getConv() {
   
   
	   
	   $se   = '<!-- ajout --><select  class="form-control minimal" id="tauxCharge"  onchange="info()" data-live-search="true" > ';
    if($this->html->conv) 
	{
	   foreach($this->html->conv as $el)   {
	   
	   	$se .= '<option value="'.$el['taux'].'" data-max="'.$el['taux_max'].'">'.addslashes(utf8_decode($el['libelle'])).'</option>';    
	   
	   }
	}
	   $se .=  '</select><!-- ajout -->';
	 	 
		return $se ;
   
   }
   
   
   /****************************/


   private function affListeMarque($t) {
	
 
	$se   = '<!-- ajout --> <select   name="Marques" id="Marques'.(($t==2) ? $t : '' ).'" onchange="affModel'.(($t==2) ? $t : '' ).'()" class=" form-control minimal"  data-live-search="true" >  ';	
	 
	
	$vil =   $this->model->listMarque($t);   //$this->html->listMarque ;
	 
	$i=0;
	$ss=true;
	foreach($vil as $el)  
	   {  
	   
	  
	//$se .=  '  <option data-lg="'.$el['longit'].'" data-lt="'.$el['latit'].'"  '.$check.'   >'.$el['libelle_Fr'].'</option>';    
	$se .=  '  <option value="'.$el['id'].'" data-type="'.$el['type'].'"  >'.$el['libelle'].'  </option>';   
	   
	  $ss =  ($ss)?false:true;
	  $i++; 
	   
	 } 		
			
			 
			$se .=  '</select><!-- ajout -->';
			 
			return $se ;
	
	
	
	}

	/****************************************************/
	private function affListeVehicule($t) {
	
	
	$se   = '<!-- ajout --><select   name="montantBien" id="montantBien'.(($t==2) ? $t : '' ).'"   class="selectpicker form-control minimal" data-live-search="true" > ';	
	 
	
	$vil =   $this->model->listVehicule($t);  
	
	//$this->html->vehicules;



	 
	$i=0;
	$ss=true;
	foreach($vil as $el)  
	   {  
	   
	  
	//$se .=  '  <option data-lg="'.$el['longit'].'" data-lt="'.$el['latit'].'"  '.$check.'   >'.$el['libelle_Fr'].'</option>';    
	$se .=  '  <option value='.$el['prix'].'   >'.$el['lamarque'].' '.$el['lemodel'].' '.$el['motorisation'].'  '.$el['edition'].'</option>';   
	   
	  $ss =  ($ss)?false:true;
	  $i++; 
	   
	 } 		
			
			 
			$se .=  '</select><!-- ajout -->';

			$ma = $this->affListeMarque($t);


            $lib  = ($t==1) ? '{prix auto}' : '{moto}' ;
			$html = "html +=affRubTag('$ma','{marque}','{lg}','id=\"marques-div\"',' hasValue '); 
					 html +=affRubTag('$se','$lib ','{lg}','id=\"vehicules-div\"',' hasValue ');
			";
			       //html +=affRubTag('{vehicule}','{prix auto}','{lg}','',' hasValue ');
			return $html ;
	
	
	
	}
	
	
	 
	
	
	 
	 
	
 
	
	 
	
	
	//Fin classe
}
?>
