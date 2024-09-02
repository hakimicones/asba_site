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


 
$currency = '<section id="currency"> <ul id="liste-flag" style="display:none">';
switch  ($this->lg ) {
case "fr": 

   $achat = 'Achat';
   $vente = 'Vente';
   $tc_lb = 'Taux de change ';
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
			           $currency .= '<li><img src="'.$li['flag'].'" alt="{taux change} '.$li['code'].'" width="30" height="22">&nbsp;&nbsp; '
			           .$achat.' : '.$li['achat'].'  | '.$vente.':'.$li['vente'].' - '.$li['code'].'</li>';
			 
			 }
$sens = (strtolower($this->lg)!='ar')?1:2;			 
$script= '<script src="modules/currency/js/iscrol.js"></script>'
        .'<script>  $(function(){     $("ul#liste-flag").liScroll({sens: 1});});$("ul#liste-flag").css("display","block");</script>';			 
$currency .=  '</ul> '.$script.'</section>';
}
return $currency ;

}


}

?>
