<?php 

include_once('includes/cfg.php');



class cvtech {
public $db; 
function main() { 
	$postajax =   (isset($_POST['task']))?$_POST['task']:'';
    $cx  = new connect ; 
    $this->lg = (isset($_GET['lg'])) ? $_GET['lg'] :'ar';

if ( $cx->con()) { 
    $this->db = $cx->db; 
    $cfg = $cx->cfg  ;  

    $method =  ucfirst($postajax);
      $this->$method($_POST); }
                 }

   
function AffModel($data) {

 



        $id =   (isset($_POST['id']))?  (int) $_POST['id']:0;
		
		 
		if($id) {;

	     
		$this->db->resetSelect();
		$this->db->addSelected('* ', ''); 
		 
		
		$this->db->addWhere('id_categorie = '. (int) $id ); 

		
	     $this->db->addWhere('publier = 1 '); 
		

	 
							
		 
		$this->db->addFrom('cv_type_offre');
	 
	   
	   
  		if (!$this->db->select()){ echo 'ERREUR: Mi-Slider  '.$this->db->getErrMessage().'<br><br>'. $this->db->q; }
        else {   
 				   
	    
		$result = $this->db->getAllRows();
		 
		 
	    echo $this->affListeSous( $result, $data['lg'] ,$data['label'] ) ;  
		
		
		}


       } else {
	    echo '{"id" : "'. (int) $_POST['id'].'"}';
	    
	   
	   }
	   
 

}
 

/****************************************************/
	private function affListeSous($vil,$lg,$first) {
	
	
	$se   = '';	 
	$i=0;
	$ss=true;
	
	
	$se .=  ' <option value=""   >'. $first.'</option>';
	foreach($vil as $el)  
	   {  
	   
	  
	   
	$se .=  ' <option value="'.$el['id' ].'"   >'.$el['libelle_'.$lg].'</option>';   
	   
	  
	  $i++; 
	   
	 } 		
			
			 
			$ret= array("options"=>$se);

			 
			       //html +=affRubTag('{vehicule}','{prix auto}','{lg}','',' hasValue ');
			return json_encode($ret) ;
	
	
	
	}
	

/*************************  Class End ************************/	

 }
 
 
 ?>
