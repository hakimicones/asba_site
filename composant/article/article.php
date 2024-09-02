<?php 
include_once('composant/article/model/modelArticle.php');
include_once('composant/article/view/viewArticle.php');	 
	
class article { 
	public $cx;
	public $db ;
	public $obj;	
   public function __construct($c)
	{
		 $this->cx  = $c; 
		 $this->lg	= strtolower($c->lg);
	 
		 
		 $this->obj = new stdClass();
		 $this->obj->lg = strtolower($c->lg);
		 $this->obj->id = $c->id;
		 $this->ariane	= $c->ariane ;
		 
	}
   
   public function display() {
   
    $search ='';
	if (isset($_POST['search'])) {$search =$_POST['search']; }  
	
	$model 	= new modelArticle($this->cx->db ,$this->lg);
	$row	= $model->getData($search);
	
	
	$view  = new viewArticle($row,$this->obj);
	$data  = $view->display();
	
	
	$retour = new stdClass ;
	$retour->data 		= $data; 
	
	$retour->ariane 	= $this->ariane;
	$retour->titre		= $this->cx->title;
	
	return $retour ;
	
   
   }



// Fin classe 
}
