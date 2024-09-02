<?php 
class menu_spec {
	public  $cx ;
	private $obj ;
	public $li ;	public $lg;
	public $param ;
	public $script ;

public function __construct($c,$obj,$lg)
	{
	 $this->cx  	= $c; 
	 $this->obj 	= $obj ;
	 $this->lg 		= $lg;
	 $this->param   = $this->obj->param ;
	 
 
	}
	
//**************	
public function affiche() { 
	$db =  $this->cx->db ;
	$db->resetSelect();
	$db->addSelected('*', '');  
	$db->addFrom('is_menu_spec ');   
	$db->addWhere('publier = 1'); 
	 $db->addWhere('id_cat =  '.$this->param->id_cat);
	$db->addOrderBy('ordre ASC');
	if (!$db->select()){ echo 'ERREUR: Menu SPEC  '.$db->getErrMessage().'<br><br>'; }
        else {   
  
		 
		$this->li = '<div id="menu_spec">';
		$result = $db->getAllRows();
		$lib = 'libelle_'.$this->lg ;
		$script ="<script>";
		foreach($result as $el)  
	   {  
		   $this->li .='<a href="'.$el['lien'].'" id="'.$el['alias'].'_btn" class="smart_btn" data-toggle="tooltip" title="" 
						data-original-title="'.$el[$lib].'"> ';
		   $this->li .='<span style="display:none; float:left"> '.$el[$lib].' </span>';
		   $this->li .=$el['icones'].'</a>'; 
		//   $script .=" smart_menu('#".$el['alias']."_btn') ;</script>";
	   }
		$script .="</script>";
		return $this->li.$script;
		}

}

}
?>
