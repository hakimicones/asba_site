<?php 
include_once('includes/cfg.php');
 



class tests { 

private $cx;
    public $db;
	public $user ;
	public $cfg;
	public 

    function main() { 

        $this->cx = new connect;
		
		
		

        if ($this->cx->con()) {
		    $this->html  = $this->cx ;
            $this->db = $this->cx->db;
			$this->cfg = $this->cx->cfg;
			
            $obj = '';

            if (isset($_POST['task'])) {

                $obj = $_POST['task'];
                
				
            }

            if (!empty($obj)) {
                $this->$obj($_POST);
            }

        }
    }
	
	
	function save($data) {
	
	 $idr = $data['idr'];
	 
	 if ($idr) {
	 
	 $this->update($data);
	 
	 } else {
	 
	 $this->insert($data);
	 
	 }
	
 	
	
	
	
	/*	*/
	    
		
	}
	
	
	/*************************************************************/
	function update($data){
	
	    $this->db->resetUpdate();   
		$this->db->setTableToUpdate('is_reponses'); 		
		$this->db->setUpdatingID('id',$data['idr'])	;
		  
	 
	  
		$this->db->setUpdatingRub( 'reponse' , $data['val'] );
	  
		$this->db->setUpdatingRub( 'reponse_text' ,$data['val']  );
				 
				 
			 
		
		if ($this->db->update()) { 
           
		    
			
			 echo 'Réponse Modifiée avec succés   '   ;
			 
			 
        }
        else {
		
			echo 'ERREUR MODIFICATION Réponse : '.$this->db->getErrMessage().'<br><br>'.$this->db->q  ;
            
        }
		
		 
	   
	   
	
	}
	
	/***********************************************************/
	function insert($data){
	
	  	$this->db->resetInsert();
	 
        $this->db->setTableForInsert('is_reponses'); 
		
		
		$this->db->setInsertingRub('id_question' ,$data['idq']  );
		$this->db->setInsertingRub('id_test' , $data['idt'] );	
		$this->db->setInsertingRub('reponse' , $data['val'] );	
		$this->db->setInsertingRub('reponse_text' ,$data['val']  );	
		$this->db->setInsertingRub('id_testeur' , $data['user'] );	 
		
		
        if ($this->db->insert()) {
		
          echo   'Réponse ajoutée avec succés  '   ;	  
			
        }
        else {
		
		 
			echo 'ERREUR INSERTION Réponse : '.$this->db->getErrMessage().'<br><br>'.$this->db->q  ;
            
        }
	
	
	 
	
	
	//   
	
	} 
	
	 

/*****************************************/
	
	

}



?>
