<?php 

class modelBlog {
	public $db  ; 
	public $lg  ;  
	public function __construct($db,$lg)
	{

	 $this->db  = $db;
	 $this->lg	= $lg;
	 $this->num   = (isset($_GET['num']))? (int) $_GET['num']:0;
	}
	
	public function getData($search) { 
		
		$this->db->resetSelect();
		$this->db->addSelected('co.* ','' );
		$this->db->addSelected('ca.type ','' );
		$this->db->addSelected('ca.id ','id_blog' );
		$this->db->addSelected('ca.sep ','' );
		$this->db->addSelected('aff_titre ','' );
		$this->db->addSelected('ca.libelle ','lib_cat' );
		
		$this->db->addFrom('is_categorie as ca'); 
		$this->db->addFrom('is_contenu as co');	 
		
		$this->db->addWhere('co.id_item = ca.id');	
		$this->db->addWhere('co.id_item  = :id'); 
        $this->db->addParamToBind('id',  $this->num );
		 $this->db->addWhere('id_appli   = 11');	
		 		
		$this->db->addWhere('  co.publier  = 1');
		$this->db->addOrderBy('ordre'); 
		
		if (!empty($search)) {
			$s = "'%".$search."%'"; 
			$this->db->addWhere(  '(co.libelle  Like '.$s.'  OR  `intro_text`  Like '.$s.')');
		 }
		 if (!$this->db->select())
		 	{  
		 		echo 'ERREUR->getData: '.$this->db->getErrMessage().'<br><br>'.$this->db->q; return '';  
		 	} else {      
		 		$rows =  $this->db->getAllRows(); /*echo '<br><br>'.$this->db->q*/;
		 	}
		
	  	return $rows;
	 
	 }
	 	 
	 
//Fin classe

/*
SELECT co.* , ca.type , ca.id  AS 'id_blog', ca.sep , ca.libelle  AS 'lib_cat'
FROM is_categorie as ca, is_contenu as co
WHERE  co.id_item = ca.id AND co.id_item = 11 AND id_appli   = 11 AND   co.publier  = 1 AND (co.libelle  Like '%التدابير%'  OR  `intro_text`  Like '%التدابير%')
ORDER BY  ordre//نصائح و ارشادات//--- نصائح و ارشادات---   


 

    

*/
}
?>
