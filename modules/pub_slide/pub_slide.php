<?php 
class currency {
	public  $cx ;
	private $obj ;
	public $li ;
	public $lg;
	public $script ;
	

public function __construct($c,$obj,$lg)
	{
	 $this->cx  = $c; 
	 $this->obj = $obj ;
	 $this->lg = $lg;	 
	}
public function affiche() {

 $db =  $this->cx->db ;
 $db->emptyParams();
 $db->resetSelect();
 $db->addSelected('*', '');
 $db->addFrom('is_currency');
 $db->addWhere('publier = 1');


 
$currency = '<section id="currency"><div class="defileParent"><ul class="defile">';
switch  ($this->lg ) {
case "fr": 

   $achat = 'Achat';
   $vente = 'Vente';
   break;
case "en": 

   $achat = 'Purchase';
   $vente = 'Sale';
   break;
case "ar": 

   $achat = '{achat}';
   $vente = '{vente}';
   break;
default :
  $achat =  'Achat';
   $vente = 'Vente';
   break; 

}

if (!$db->select()){ echo 'ERREUR: CURRENCY '.$db->getErrMessage().'<br><br>'; }
        else {   
            $result = $db->getAllRows();  
		  
			 foreach($result as $li)  {
			           $currency .= '<li><img src="'.$li['flag'].'" alt="usd" width="30" height="22">&nbsp;&nbsp; '
			           .$achat.' : '.$li['achat'].'  | '.$vente.':'.$li['vente'].'</li>';
			 
			 }
			 
			 
$currency .=  '</ul></div></section>';
}
return $currency ;

}


}

?>
