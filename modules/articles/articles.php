<?php 
class articles {
	private $cx ;
	private $obj ;
	private $lg ;
	public $li ;
	public $mess = 2 ;
	public $params;
	public $script ;

public function __construct($c,$obj,$lg)
	{
	 $this->cx  = $c; 
	 $this->obj = $obj ;
	 $this->lg = $lg;
	 $this->params  = $this->obj->param;
	}
	
	public function model() {
	 
	  
	 
	 $db =  $this->cx->db ;
 
	 $db->resetSelect();
	 
	  $db->addSelected('*', '');  
	  $db->addFrom('is_contenu');
	  $db->addWhere(' id = :id; ');
	  $db->addParamToBind('id', $this->params->id  );
	  $db->addWhere('publier = 1'); 
	  
 		if (!$db->select()){  echo 'ERREUR->Module: '.$db->getErrMessage().'<br><br>'; return '';  }
        else {  $rows = $db->getNextRow(); }
	 		 
		return $rows ;
		return false;
	  
	
	}
	
	public function affiche() { 
	 
		$row = $this->model() ;
		$html = '<section id="'.$row['id_section'].'" class="'.$row['css'].'" >'. $row['intro_text'].'</section>';
		return $html;
	}
}


?>
		
 

