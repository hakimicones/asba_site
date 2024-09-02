<?php 
class switch_lg { 
	public $script;	
public function __construct($c,$o,$lg)
	{
	 $this->cx 		= $c; 
	 $this->obj 	= $o ;
	 $this->lg 		= $lg;
	 $this->param   = $this->obj->param ;
	}
public function affiche() {
$path = "";

$en = "";

$ar = (strtolower($this->lg)!='ar' && $this->param->ar)?'<a href="ar/accueil.html"><img src="modules/switch-lg/img/ar.png" alt="Ar" class="cl-ar"></a> ':'';
$fr = (strtolower($this->lg)!='fr' && $this->param->fr)?'<a href="fr/accueil.html"><img src="modules/switch-lg/img/fr.png" alt="Fr" class="cl-fr"></a>':'';
//$en = (strtolower($this->lg)!='en' && $this->param->en)?'<a href="en/accueil.html"><img src="modules/switch-lg/img/en.png" alt="En" class="cl-fr"></a>':'';
 
$v = '<div class="div-lg lg">  '.$ar.$fr.$en.'</div>';
 
return $v ;
}




}

?>
