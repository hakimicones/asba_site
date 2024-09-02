<?php 
class sondage {
	public  $cx ;
	private $obj ;
	public $li ;
	public $script ;

public function __construct($c,$obj , $lg)
	{
	 $this->cx  = $c; 
	 $this->obj = $obj ;
	 $this->lg = $lg;
	 $this->params  = $this->obj->param;
	 $this->db = $this->cx->db ;
	}
	public function getSondage() {
	
		$this->db->addSelected('r.*', '');
		$this->db->addSelected('q.question', '');
		$this->db->addFrom('is_sondage_reponses r');
		$this->db->addFrom('is_sondage_questions q');
		$this->db->addWhere('r.publier = 1'); 
		$this->db->addWhere('r.id_sondage= q.id'); 
		
		$this->db->addOrderBy('r.ordre ASC');		 
		 
		
		$this->db->addWhere('	id_sondage= :item'); 
		$this->db->addParamToBind('item', $this->params->id_sondage);
		
 		
		if (!$this->db->select()){  echo 'ERREUR->LISTE-Sondage: '.$this->db->getErrMessage().'<br><br>'.$this->db->q; return '';  }
			else {  $this->rows = $this->db->getAllRows();  	 	 }
		 
		return $this->rows ;
	}
	public function affiche() { 
	
	$div  = '';	
	$rows = $this->getSondage() ;
	foreach ($this->rows as $row) :
	
	$div .= '<input name="reponses" class="rep" type="radio" value="'.$row['id'].'" /> '.$row['reponse'].'<br>';
	
	endforeach;
	$q = $row['question'];
	
	$f = file_get_contents( 'modules/sondage/view/default.php') ;
	
		$tag[]  = '{question}';
		$ext[]  =  $q;
		
		
		$tag[]  =  '{reponses}';
		$ext[]  =  $div ;
		$tag[]  =  '{item}';
		$ext[]  =  $this->params->id_sondage;
		
				
		
	$data = str_replace ( $tag , $ext , $f ) ;		 
	$data    .=  '<!-- Sondage -->' ;
	
	
	
	return 	$data;		
	
	}
	
	
}


?>
		
 

