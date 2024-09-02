<?php 
class my_video { 
	public $obj ;
	public $cx ;
	public $script ;
public function __construct($c,$o,$lg)
	{
	 $this->cx = $c; 
	 $this->obj = $o ;
	 $this->lg = $lg;
	}
public function affiche() {
$v = '<br><br><div class="container">';
$list = explode(";",$this->obj->contenu);
$n = 12 / (count($list) );

foreach($list as $vid) {
  
 $v .= '<div class="col-sm-'.$n.' col-lg-'.$n.'"> 
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="'.$vid.'" frameborder="0"  allow="encrypted-media" allowfullscreen=""></iframe>
</div></div>';
}

$v .= '</div>';
return $v ;
}




}

?>
