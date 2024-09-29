<?php 

class modelCvtech {
	public $db  ; 
	public $lg  ;  
	public function __construct($c)
	{

		$this->db  = $c->cx->db;
		$this->lg	= $c->lg;
		
		$this->cx  = $c->cx->cx;
	 	$this->num   = (isset($_GET['num']))? (int) $_GET['num']:0;
	}
	
	public function getData($search) {
			
		$this->db->resetSelect();
		$this->db->addSelected('* ','' );
		
		$this->db->addFrom('cv_offre'); 
		 $this->db->addWhere(' `publier` = 1');
		$this->db->addOrderBy('ordre'); 
		
		if (!empty($search)) {
		$s = "'%".$search."%'"; 
		$this->db->addWhere(  'libelle_'.$this->lg.' Like '.$s.'  OR  `niveau_poste`  Like '.$s.' OR  `niv_etude`   Like '.$s.'');
		 }
		 if (!$this->db->select()){  
			$this->cx->getMessageErr('Cvtech->getData: '.$this->db->getErrMessage().'  '.$this->db->q);
			return ''; 
		
		}
        else { $rows =  $this->db->getAllRows();}
		
	  return $rows;
	 
	 }
	 
	 public function getTypeContrat() {
		$this->db->resetSelect();
		$this->db->addSelected('* ','' );
		$this->db->addFrom('cv_type_contrat'); 
		$this->db->addWhere(' `publier` = 1');
		$this->db->addOrderBy('ordre'); 
		
		 
		 if (!$this->db->select()){ 
			
			$this->cx->getMessageErr('Cvtech->getTypeContrat: '.$this->db->getErrMessage().'  '.$this->db->q);
			return ''; 	
		
		}
        else {  $rows =  $this->db->getAllRows();}
		
	  return $rows;
	
	} 
	public function getExperience( ) {
	
	
	$this->db->resetSelect();
		$this->db->addSelected('* ','' );
		$this->db->addFrom('cv_experience'); 
		$this->db->addWhere(' `publier` = 1');
		$this->db->addOrderBy('ordre'); 
		
		 
		 if (!$this->db->select()){  
			
			$this->cx->getMessageErr('Cvtech->getExperience: '.$this->db->getErrMessage().'  '.$this->db->q);
			return ''; 	
		
		}
        else {  $rows =  $this->db->getAllRows();}
		
	  return $rows;
	
	}
	
	public function getNiveau( ) { 
	    
		$this->db->resetSelect();
		$this->db->addSelected('* ','' );
		$this->db->addFrom('cv_formations'); 
		$this->db->addWhere(' `publier` = 1');
		$this->db->addOrderBy('ordre'); 
		
		 if (!$this->db->select()){  
			
			$this->cx->getMessageErr('Cvtech->getNiveau: '.$this->db->getErrMessage().'  '.$this->db->q);
			return '';	
		
		}
        else {  $rows =  $this->db->getAllRows();}
		
	  return $rows;
	
	}


    // Insertion des candidats
	public function getCandidat($data) { 
	
		$this->db->resetInsert();
		
		$this->db->setTableForInsert('cv_candidat');
		
		$this->db->addInserting('nom', ':nom ');
		$this->db->addParamToBind('nom',$data['nom'] );
		
		$this->db->addInserting('adresse', ':adresse');
		$this->db->addParamToBind('adresse',$data['adresse'] );
		
		$this->db->addInserting('wilaya', ':wilaya'); 
		$this->db->addParamToBind('wilaya',$data['wilaya'] );
		
		$this->db->addInserting('tel', ':tel');
		$this->db->addParamToBind('tel',$data['tel'] );		
		
		$this->db->addInserting('mob ', ':mob');
		$this->db->addParamToBind('mob',$data['mob'] );
		
		$this->db->addInserting('email', ':email');
		$this->db->addParamToBind('email',$data['email'] );
		
		$this->db->addInserting('nele ', ':nele');
		$this->db->addParamToBind('nele',$data['nele'] );
		
		$this->db->addInserting('lieu', ':lieu');
		$this->db->addParamToBind('lieu',$data['lieu'] );
		
		$this->db->addInserting('sex', ':sex');
		$this->db->addParamToBind('sex',$data['sex'] );
		
		
		$this->db->addInserting('situation ', ':situation');
		$this->db->addParamToBind('situation',$data['situation'] );
		
		
		$this->db->addInserting('id_offre', ':id_offre');
		$this->db->addParamToBind('id_offre',$data['id_offre'] );
		
		$this->db->addInserting('formations', ':formations');
		$this->db->addParamToBind('formations',$data['formations'] );
		
		$this->db->addInserting('experience', ':experience'); 
		$this->db->addParamToBind('experience',$data['experience'] );
		
		
		
/*			

$this->db->addInserting('ville', ':ville');
		$this->db->addParamToBind('ville',$data['ville'] );
		

	
		*/
		
			if ($this->db->insert()) {
			  $mess  = [ "contenu" => '{add_cv_success}<br>{nous_contacterons}'  ,    "type" => 'success',];
				
			}
			else {
			

				$this->cx->getMessageErr('Cvtech->getCandidat: '.$this->db->getErrMessage().'  '.$this->db->q);
			
				$mess = [ "contenu" => 'ERREUR INSERTION : '  ,    "type" => 'danger',];
				
			}
			return $mess ;
	}
		public function getPostuler() { 
		    
			
			if ($this->num !=0) {
			
			 
		    $this->db->resetSelect();
			$this->db->addSelected('*', ''); 
			
			$this->db->addFrom('cv_offre');
			
			
			
			$this->db->addWhere('id = :id'); 
			$this->db->addParamToBind('id', $this->num );
	
				
			if (!$this->db->select())
			{  
				$this->cx->getMessageErr('Cvtech->getPostuler: '.$this->db->getErrMessage().'  '.$this->db->q);
				return '';
			
			
			}
				else {  $this->rows = $this->db->getNextRow();   return $this->rows ;}
			}		 
			 
			return false;
		
		
		
		}
//Fin classe
}
?>
