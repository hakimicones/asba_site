 <?php 
 
include_once('includes/cfg.php');


class outils {

function main() {
	
 
	$this->cx  = new connect ; 
	
		if ( $this->cx->con()) { 
			$this->db = $this->cx->db;	 
			  $obj = '' ;
			 
			if(isset($_POST['task'])){ $obj = $_POST['task']; }  
		 
			 
			if (!empty($obj)) { $this->$obj(  $_POST  ); }  	
		 
	}
	} 


  public function listVehicule($id) {
	
    $this->db =  $this->cx->db ;
	  
	$this->db->resetSelect();
	$this->db->addSelected('v.*', ''); 
	 
	$this->db->addSelected('mo.libelle', 'lemodel'); 	
	 
	$this->db->addWhere('mo.id = v.model'); 
	$this->db->addWhere('v.marque = '.$id);  
 						
	$this->db->addFrom('is_vehicule v');
	 
	$this->db->addFrom('is_model mo');
	   
	   
  		if (!$this->db->select()){ echo 'ERREUR: Mi-Slider  '.$this->db->getErrMessage().'<br><br>'; }
        else {   
 				//echo $db->q;
	 
		$result = $this->db->getAllRows();
	    return $result ;  }
	
	}

  private function affVehicules ($data) {
	
	
	$se   =  '<!-- ajout --><select   name="montantBien" id="montantBien"   class="form-control" data-live-search="true" > ';	
	 
	
	$vil = $this->listVehicule($data['id']);
	 
	$i=0;
	$ss=true;
	foreach($vil as $el)  
	   {  
	   
	  
	//$se .=  '  <option data-lg="'.$el['longit'].'" data-lt="'.$el['latit'].'"  '.$check.'   >'.$el['libelle_Fr'].'</option>';    
	$se .=  '  <option value='.$el['prix'].'   >  '.$el['lemodel'].' '.$el['motorisation'].'  '.$el['edition'].'</option>';   
	   
	  $ss =  ($ss)?false:true;
	  $i++; 
	   
	 } 		
			
			 
			 $se .=  '</select><!-- ajout -->';
			 
			echo $se ;
	
	
	
	}

   

	private function getArticle( $data){

		$this->db =  $this->cx->db ;
	  
		$this->db->resetSelect();
		$this->db->addSelected('*', ''); 
		$this->db->addWhere('id = '.$data['id']); 
		$this->db->addFrom('is_contenu');
	   
	   
  		if (!$this->db->select()){ echo 'ERREUR: Mi-Slider  '.$this->db->getErrMessage().'<br><br>'; }
        else {   
 				//echo $db->q;
	 
		$result = $this->db->getNextRow();
	      }
	
	 



	 
	$data = array('title'=>  $result['libelle'] , 'content' =>  $result['intro_text']    );
 
	$html =  json_encode($data);
	 echo $html;
	
	
	
	}


private function getArticle1( $data){



 
	
	echo '<div class="modal-content">     
	             <div class="modal-header">	    
	                      <span class="modal-title" id="ModalLabel">fffff</span>	    
	                       <a href="javascript:" onclick="'."PrintElem('modal_doc',ar)".'; return false;" data-toggle="tooltip" class="btn-imp no-imp">	<i class="fa  fa-print"></i></a>	  
	                       <button type="button" class="close  no-imp" id="cls-modal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>      
	            </div>	  
	            <div class="modal-body" id="modal-body">	  555	  </div>	  
			</div>' ;
	}

 
 }
 
 ?>
