 <?php 
 
include_once('includes/cfg.php');


class sondage {
public $rows;
function insertRep($id) {


$cx  = new connect ; 

	if ( $cx->con()) { 
		$this->db = $cx->db; 
 		$this->db->resetUpdate();
        $this->db->setTableToUpdate('is_sondage_reponses'); 
		$this->db->addUpdating( 'nb_reponses','nb_reponses+1');  
		$this->db->setUpdatingID('id',$id)	;
if ($this->db->update()) {
            
			$this->message = [ "contenu" => 'Sondage Modifier avec succes  '.$this->db->q  ,    "type" => 'success',];
			return true ;
        }
        else {
		
			$this->message = [ "contenu" => 'ERREUR MODIFICATION : '.$this->db->getErrMessage() ,    "type" => 'danger',];
            return false;
        }
		
		
		} else {
		
			$this->message = [ "contenu" => 'ERREUR Connexion  : ' ,    "type" => 'danger',];
           return false; 
        }
		

}
public function getMessage() {
		 $m='';
		 if (!empty($this->message['contenu'])) {
		 $m = '<div class="alert alert-'.$this->message['type'].' fixed" role="alert">
			   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
			   .$this->message['contenu'].'</div>'; }
		 // print_r( $this->message['contenu'] );
		 return $m;
	 }
	 
function getStat($ids) {

			$this->db->resetSelect();
			$this->db->addSelected('*', ''); 
			$this->db->addFrom('is_sondage_reponses');			
			$this->db->addWhere('id_sondage= :item'); 
		    $this->db->addParamToBind('item',  $ids );
			if ($this->db->select()){  
			$this->rows = $this->db->getAllRows();  
			return true;
			} else {
			$this->message = [ "contenu" => 'ERREUR select : '.$this->db->getErrMessage() ,    "type" => 'danger',]; return false; }
}

function affStat( ) {
	$nbt =0;
	foreach ($this->rows as $row) :
	$nbt = $nbt+$row['nb_reponses'];
	endforeach;
	$div = '<div class="stat">';
		foreach ($this->rows as $row) :
		$p = ($row['nb_reponses']/$nbt)*100 ;
		 $div .= '<div><span class="lib">'.$row['reponse'].' : </span><span> ' .number_format ( $p , 2).' % </span></div>';
		endforeach;
	$div .='</div>';
	return $div;
}	 
function main() {

$id  =   $_POST["reponses"] ;
$ids =   $_POST["id_sondage"] ;
if ($this->insertRep($id)) {

if ($this->getStat($ids)) {  echo $this->affStat(); } else { echo $this->getMessage();}

}

  }

 }
 
 ?>
