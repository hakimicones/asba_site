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
			
			$tag[]  =	'{tva}';
			$ext[]  =	$param->tva;
			/*
			$tag[]  =	'{}';
			$ext[]  =  ;
			*/
			
			$vehicules =  $this->affListeVehicule();


			$tag[]  =	'{listevehicules}';
			$ext[]  =	$vehicules;


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
		$ext[]  =  $param->tva ;		
	 
		
		$tag[]  =  '{d_t1}';
	 
		$ext[]  =  $param->d_t1 ;
		
		$tag[]  =  '{d_t2}';
		$ext[]  =  $param->d_t2 ;
		
		$tag[]  =  '{d_t3}';
		$ext[]  =  $param->d_t3 ;
			
			
		$html = str_replace ( $tag ,$ext , $f) ;
		
		 return $html;
 
 
 
 }	
 function getSimul1() {
   			$url = 'composant/simulations/view/tpl/form.php'; 
			$f = file_get_contents($url) ;
			
			 
			
			 
			
			 
			
			 
			
		 
			
			$tag[]  =  '{dir}';
			$ext[]  =  ( $this->lg!='ar')?'ltr':'rtl';
			
			$tag[]  =	'{convs}';
			$ext[]  =	$this->getConv();
			
			
			 $param = json_decode( $this->html->param);
			
			 
			
			$tag[]  =	'{tva}';
			$ext[]  =	$param->tva;
			
			$tag[]  =	'{liens}';
			$ext[]  = $this->lg.'/vehicules/list-'.$this->id.'-0.html';
			
			
			$vehicules = ($this->num )? "html +=affRubHidden('montantBien' , '".$this->rows['prix']."','' );":$this->affListeVehicule();


			$tag[]  =	'{listevehicules}';
			$ext[]  =	$vehicules;


			$apport = ($this->num )?'':"html +=affRubTexte('apportPersonnel','{apportPersonnel}','{lg}','','hasData' );";
			
			$tag[]  =	'{apportPersonnel}';
			$ext[]  =	$apport;
			
			
		    $html = str_replace ( $tag ,$ext , $f) ;
		
		 return $html;
 
 
 
 }	
	
 function getConv() {
   
   
	   
	   $se   = '<!-- ajout --><select  class="form-control minimal" id="tauxCharge"  onchange="info()" data-live-search="true" > ';
	   foreach($this->html->conv as $el)   {
	   
	   $se .=  '  <option value="'.$el['taux'].'" data-max="'.$el['taux_max'].'">'.addslashes(utf8_decode($el['libelle'])).'</option>';   
		 
	   
	   }
	   
	   $se .=  '</select><!-- ajout -->';
	 	 
		return $se ;
   
   }
   
   
   /****************************/


   private function affListeMarque() {
	
	
	$se   = '<!-- ajout --> <select   name="Marques" id="Marques" onchange="affModel()" class=" form-control minimal"  data-live-search="true" >  ';	
	 
	
	$vil = $this->html->listMarque ;
	 
	$i=0;
	$ss=true;
	foreach($vil as $el)  
	   {  
	   
	  
	//$se .=  '  <option data-lg="'.$el['longit'].'" data-lt="'.$el['latit'].'"  '.$check.'   >'.$el['libelle_Fr'].'</option>';    
	$se .=  '  <option value='.$el['id'].'   >'.$el['libelle'].'</option>';   
	   
	  $ss =  ($ss)?false:true;
	  $i++; 
	   
	 } 		
			
			 
			$se .=  '</select><!-- ajout -->';
			 
			return $se ;
	
	
	
	}

	/****************************************************/
	private function affListeVehicule() {
	
	
	$se   = '<!-- ajout --><select   name="montantBien" id="montantBien"   class="selectpicker form-control minimal" data-live-search="true" > ';	
	 
	
	$vil = $this->html->vehicules;



	 
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

			$ma = $this->affListeMarque();



			$html = "html +=affRubTag('$ma','{marque}','{lg}','id=\"marques-div\"',' hasValue '); 
					 html +=affRubTag('$se','{prix auto}','{lg}','id=\"vehicules-div\"',' hasValue ');
			";
			       //html +=affRubTag('{vehicule}','{prix auto}','{lg}','',' hasValue ');
			return $html ;
	
	
	
	}
	
	
	 
	
	
	 
	 
	
 
	
	 
	
	
	//Fin classe
}
?>
