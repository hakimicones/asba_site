<?php 

class modelCvtech {
	public $db  ; 
	public $lg  ;  
	public function __construct($c)
	{

	 $this->db  = $c->db;
	 $this->lg	= $c->lg;

	 $this->num   = (isset($_GET['num']))? $_GET['num']:0;

	 
	 
	}
	
	public function getData($search) {
		
		 
		
		$this->db->resetSelect();
		$this->db->addSelected('o.* ','' );
		$this->db->addSelected('e.libelle_'.$this->lg,'lib_exp' );
		$this->db->addSelected('f.libelle_'.$this->lg,'lib_etude' );

		$this->db->addSelected('tof.libelle_'.$this->lg,'lib_type' );

		$this->db->addSelected('t.libelle_'.$this->lg, 'lib_contrat');
		
		$this->db->addFrom('cv_offre o  '); 
		
		$this->db->addJoin("LEFT OUTER JOIN","cv_experience e","o.niveau_poste = e.id");
		$this->db->addJoin("LEFT OUTER JOIN","cv_formations f","o.niv_etude    = f.id");
        $this->db->addJoin('LEFT OUTER JOIN', 'cv_type_contrat t ', ' o.type_contrat = t.id');

		$this->db->addJoin("LEFT OUTER JOIN","cv_type_offre tof","o.type    =  tof.id ");
		
	 
		$this->db->addWhere('o.publier = 1');
		 
		$this->db->addOrderBy('ordre'); 
		
		if (!empty($search['search']) ) {
		$s = "'%".$search['search']."%'"; 
		$this->db->addWhere(  'o.libelle_'.$this->lg.' Like '.$s.'  OR  f.libelle_'.$this->lg.'  Like '.$s.' OR  e.libelle_'.$this->lg.'   Like '.$s.'');
		 }

		 if (isset($search['sous-categories'])) 
		 {
			$this->db->addWhere(' o.type =  ' . (int) $search['sous-categories'] );

		 }



		 if (!$this->db->select()){  echo 'ERREUR->Module: '.$this->db->getErrMessage().'<br><br>'.$this->db->q; return '';  }
        else { $rows =  $this->db->getAllRows();}
		
	  return $rows;
	 
	 }
	 
	  public function getCatégories()
	  {
		$this->db->resetSelect();
		$this->db->addSelected('c.*','' ); 
		 
		  
		
		
		$this->db->addFrom('cv_categorie_offre c  '); 
		$this->db->addWhere(' c.publier = 1  ');
			 
	 
		if (!$this->db->select()){  echo 'ERREUR->Module: '.$this->db->getErrMessage().'<br><br>'; return '';  }
        else {  $rows =  $this->db->getAllRows();}
		
	  return $rows;
	
	} 
	 
	 
	 public function getTypeContrat() {
		$this->db->resetSelect();
		$this->db->addSelected('* ','' );
		$this->db->addFrom('cv_type_contrat'); 
		$this->db->addWhere(' publier = 1');
		$this->db->addOrderBy('ordre'); 
		
		 
		 if (!$this->db->select()){  echo 'ERREUR->Module: '.$this->db->getErrMessage().'<br><br>'; return '';  }
        else {  $rows =  $this->db->getAllRows();}
		
	  return $rows;
	
	} 
	
	
	
	public function getExperience( ) {
	
	
	$this->db->resetSelect();
		$this->db->addSelected('* ','' );
		$this->db->addFrom('cv_experience'); 
		$this->db->addWhere(' publier = 1');
		$this->db->addOrderBy('ordre'); 
		
		 
		 if (!$this->db->select()){  echo 'ERREUR->Module: '.$this->db->getErrMessage().'<br><br>'; return '';  }
        else {  $rows =  $this->db->getAllRows();}
		
	  return $rows;
	
	}
	
	public function getNiveau( ) { 
	    
		$this->db->resetSelect();
		$this->db->addSelected('* ','' );
		$this->db->addFrom('cv_formations'); 
		$this->db->addWhere(' publier = 1');
		$this->db->addOrderBy('ordre'); 
		
		 if (!$this->db->select()){  echo 'ERREUR->Module: '.$this->db->getErrMessage().'<br><br>'; return '';  }
        else {  $rows =  $this->db->getAllRows();}
		
	  return $rows;
	
	}

	 

    // Insertion des candidats
	public function getCandidat($data) 
	{ 
	
		$this->db->resetInsert();


		
		$this->db->setTableForInsert('cv_candidat');
		
		$this->db->addInserting('nom', ':nom ');
		$this->db->addParamToBind('nom',$data['nom'] );

		$this->db->addInserting('prenom', ':prenom ');
		$this->db->addParamToBind('prenom',$data['prenom'] );
		
		$cv = $this->UploadeCV();


        if (!$cv->error) 
        {
			$this->db->addInserting('cv', ':cv'); 
			$this->db->addParamToBind('cv',$cv->name );


		} else {

			$mess = [ "contenu" => 'ERREUR  :  '.$cv->message  ,    "type" => 'danger',];
			return $mess ;
		}
		

		
		$this->db->addInserting('adresse', ':adresse');
		$this->db->addParamToBind('adresse',$data['adresse'] );
		
		
		
		$this->db->addInserting('tel', ':tel');
		$this->db->addParamToBind('tel',$data['tel'] );		
		
		// $this->db->addInserting('mob ', ':mob');
		// $this->db->addParamToBind('mob',$data['mob'] );
		
		$this->db->addInserting('email', ':email');
		$this->db->addParamToBind('email',$data['email'] );
		
		$this->db->addInserting('nele ', ':nele');
		$this->db->addParamToBind('nele',$data['nele'] );
		
		$this->db->addInserting('lieu', ':lieu');
		$this->db->addParamToBind('lieu',$data['lieu'] );
		
		$this->db->addInserting('sex', ':sex');
		$this->db->addParamToBind('sex',$data['sex'] );
		
		
		// $this->db->addInserting('situation ', ':situation');
		// $this->db->addParamToBind('situation',$data['situation'] );
		
		
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
			  $mess  = [ "contenu" => '{add_cv_success}'  ,    "type" => 'success',];
				
			}
			else {
			
				$mess = [ "contenu" => 'ERREUR INSERTION : '.$this->db->getErrMessage() ,    "type" => 'danger',];
				
			}
			return $mess ;
	}

	
	// get App  Data 
	public function getapp() { 

		$this->db->resetSelect();
		$this->db->addSelected('param','');

		$this->db->addFrom('is_appli  ');
		$this->db->addWhere(' id =  9'); 

		if (!$this->db->select())
		{  
			echo 'ERREUR->Module: '.$this->db->getErrMessage().'<br><br>'; return '';  
		} else {  
			$this->rows = $this->db->getNextRow();   return $this->rows['param'] ;
			}
	}
	
	// get App  Data 
	public function UploadeCV() 
	{  
         $obj = new stdClass;
		 $obj->error  = 1 ;

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {



			// Vérifier si un fichier a été téléchargé
			if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === UPLOAD_ERR_OK) {
				$file = $_FILES['pdf_file'];
				$target_dir = "cvtech/"; // Dossier où les fichiers seront stockés
				$target_file = $target_dir . basename($file["name"]);
		
				// Vérifier le type de fichier
				$file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
				$allowed_types = array('pdf');
				if (!in_array($file_type, $allowed_types)) {
					$obj->message =  "Seuls les fichiers PDF sont autorisés.";
					$obj->error  = 1 ;

				} else {
					// Vérifier le type MIME du fichier
					$finfo = finfo_open(FILEINFO_MIME_TYPE);
					$mime_type = finfo_file($finfo, $file["tmp_name"]);
					finfo_close($finfo);
		
					if ($mime_type !== 'application/pdf') {
						$obj->message =  "Le fichier n'est pas un PDF valide.";
						$obj->error  = 1 ;
					} else {
						// Déplacer le fichier téléchargé vers le dossier de destination
						if (move_uploaded_file($file["tmp_name"], $target_file)) {
							
							$obj->error  = 0 ;
							$obj->name  = $target_file ; 
						
						} else {

							$obj->message =  "Une erreur s'est produite lors du téléchargement du fichier.";
						   $obj->error  = 1 ;
							 
							 
						}
					}
				}
			} else {
				 
				$obj->message =  "Aucun fichier n'a été sélectionné.";
				$obj->error  = 1 ;
			}

			 
		}
return $obj;
		 
	}

    // 
	

	// get Offre and content  Data 
	public function getPostuler() { 
		    
			
			if ($this->num !=0) {	
				
				
			$params = json_decode($this->getapp());
			$item   ='item_'. $this->lg;	
		 
			 
		    $this->db->resetSelect();
			$this->db->addSelected(' o.* , c.intro_text', ''); 
			
			$this->db->addFrom('cv_offre o');
			$this->db->addFrom('is_contenu  c');
									
			$this->db->addWhere('o.id = :id'); 
			$this->db->addParamToBind('id', $this->num );
				
			$this->db->addWhere('c.id = :idc'); 
			$this->db->addParamToBind('idc', $params->$item );


			if (!$this->db->select()){  echo 'ERREUR->Module: '.$this->db->getErrMessage().'<br><br>'; return '';  }
				else {  $this->rows = $this->db->getNextRow();   return $this->rows ;}
			}		 
			 
			return false;
		
		
		
		}
//Fin classe
}
?>
