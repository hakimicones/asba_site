<?php 
class switch_lg { 
	public $script;	
public function __construct($c,$o,$lg)
	{
	 $this->cx 		= $c; 
	 $this->obj 	= $o ;
	 $this->lg 		= $lg;
	 $this->param   = $this->obj->param ;
	 $this->detect 		= $this->obj->detect  ;
	}
public function affiche() {
 $affiche = false ;

switch(true) {
case ($this->detect->isMobile() && $this->param->affiche==2 ) :
 $affiche = true ;
break;
case (!$this->detect->isMobile() && $this->param->affiche==1 ) :
 $affiche = true ;
break;
case (!$this->param->affiche ) :
 $affiche = true ;
break;


}


$v = "";

 
if ($affiche) {
$ar = (strtolower($this->lg)!='ar' && $this->param->ar)?'<a href="ar/accueil.html"><img src="modules/switch-lg/img/ar.png" alt="Ar" class="cl-ar"></a> ':'';
$fr = (strtolower($this->lg)!='fr' && $this->param->fr)?'<a href="fr/accueil.html"><img src="modules/switch-lg/img/fr.png" alt="Fr" class="cl-fr"></a>':'';
$en =  '';
//(strtolower($this->lg)!='en' && $this->param->en)?'<a href="en/accueil.html"><img src="modules/switch-lg/img/en.png" alt="En" class="cl-fr"></a>':'';
 
$v = '<div class="div-lg lg">  '.$ar.$fr.$en.'</div>';
 }
return $v ;
}




}

?>
