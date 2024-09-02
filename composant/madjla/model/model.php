<?php 

class modelMadjla {
	public $db  ; 
	public $lg  ;  
	public function __construct($db,$lg)
	{

	 $this->db  = $db;
	 $this->lg	= $lg;
	 $this->num   = (isset($_GET['num']))? (int) $_GET['num']:0;
	}
	
	public function getArticle($id ) {
	$db = $this->db ; 
	$db->emptyParams();
	$db->resetSelect();
	$db->addSelected('c.*', '');
	$db->addSelected('p.title', '');
	$db->addSelected('p.alias', '');
	$db->addSelected('p.id_langue', '');
	$db->addSelected('p.param ', '');
	
	$db->addFrom('is_contenu as c , `is_page` as p');
	$db->addWhere('c.id_item = p.id');
	$db->addWhere('c.id_item = :id');
	$db->addWhere('c.publier = 1 ');
	$db->addWhere('c.id_appli = 1 ');	
	 
	
	$db->addParamToBind('id', $id ); 
	
	
	  if (!$db->select()){ echo 'ERREUR CONTENU: '.$db->getErrMessage().'<br><br>'; }
        else {   
		
		   
            $result = $db->getNextRow();  
             
		  
 	 }
 
	$retour = new stdClass ;
	$retour->data 		= $result['intro_text']; 
 
	$retour->titre		= $result['title'] ;



	
 
	
	return $retour;
 }


public function getEnvArticle() {}	 
	 
//Fin classe
}
?>
