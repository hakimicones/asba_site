<?php 
class my_html { 
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

return $this->obj->contenu ;
}

}

?>
