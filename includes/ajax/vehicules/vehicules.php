<?php 

include_once('includes/cfg.php');



class vehicules {
public $db; 
function main() { 
	$postajax =   (isset($_POST['task']))?$_POST['task']:'';
    $cx  = new connect ; 
    $this->lg = (isset($_GET['lg'])) ? $_GET['lg'] :'ar';

if ( $cx->con()) { 
    $this->db = $cx->db; 
    $cfg = $cx->cfg  ;  

    $method =  ucfirst($postajax);
      $this->$method(); }
                 }

   
function AffModel() {

 
        $id =   (isset($_POST['id']))?  (int) $_POST['id']:0;
		
		 
		if($id) {;

	     
		$this->db->resetSelect();
		$this->db->addSelected('v.prix , v.motorisation ,v.edition ', ''); 
		$this->db->addSelected('ma.libelle', 'lamarque'); 
		$this->db->addSelected('mo.libelle', 'lemodel'); 
		
		$this->db->addWhere('ma.id = v.marque'); 
		$this->db->addWhere('mo.id = v.model'); 
		
		$this->db->addWhere('ma.id =  '.$id); 
		
		
	     $this->db->addWhere('v.publier = 1 '); 
		
		$table = ($_POST['type']==1) ? 'is_vehicule v' : 'is_moto v' ;
							
		$this->db->addFrom($table)  ;
		$this->db->addFrom('is_marque ma');
		$this->db->addFrom('is_model mo');
	   
	   
  		if (!$this->db->select()){ echo 'ERREUR: Mi-Slider  '.$this->db->getErrMessage().'<br><br>'. $this->db->q; }
        else {   
 				   
	    
		$result = $this->db->getAllRows();
		 
		 
	    echo $this->affListeVehicule( $result ) ;  
		
		
		}


       } else {
	    echo '$id : '.(int) $_POST['id'];
	    
	   
	   }


}
 

/****************************************************/
	private function affListeVehicule($vil) {
	
	
	$se   = '';	 
	$i=0;
	$ss=true;
	foreach($vil as $el)  
	   {  
	   
	  
	   
	$se .=  ' <option value='.$el['prix'].'   >'.$el['lamarque'].' '.$el['lemodel'].' '.$el['motorisation'].'  '.$el['edition'].'</option>';   
	   
	  
	  $i++; 
	   
	 } 		
			
			 
			$se .=  '';

			 
			       //html +=affRubTag('{vehicule}','{prix auto}','{lg}','',' hasValue ');
			return $se ;
	
	
	
	}
	

/*************************  Class End ************************/	

 }
 
 
 ?>
