<?php 
class lien_cote {
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
	 $this->params  = $this->obj->param;
	}
public function affiche() {

 

 $menu = '<div class="stm_theme_demos"> ';
   for ($i = 1; $i <= 5; $i++) {
   $titre = 'titre'.$i;
   $lien  = 'lien'.$i;
   $icone = 'icone'.$i;
   $menu .= '<a id="icon-'.$i.'" href="'.$this->params->$lien.'" target="_blank" class="stm_theme_demos__icon">  
        			<i class="material-icons" >'.$this->params->$icone.'</i>
        			<span  >'.$this->params->$titre.'</span>
    		</a>
   
   ';
   
  
}

  $menu .= '</div>  ';

   return $menu ;
 

}

/**************************/
}

?>
