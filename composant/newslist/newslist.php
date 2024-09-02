<?php 
include_once('composant/newslist/model/modelNews.php');
include_once('composant/newslist/view/viewNews_list.php');	 
	
	
class newslist { 
	public $cx;
	public $db ;
	public $obj;	
	public $titre; 
	public $ariane;
	public $page_id;

    public function __construct($c)
	{
		 $this->cx  		 = $c; 
		 $this->lg			 = strtolower($c->lg);		 
		 $this->obj 		 = new stdClass();
		 $this->obj->lg 	 = strtolower($c->lg);
		 $this->obj->id 	 = 0 ;
		 
		 
		 $this->obj->liens 	 	= '';
		 $this->ariane		 	=  $c->ariane ;
 		 $this->obj->page_id 	=  $c->id ;
 		 $this->obj->desc    	= '';
 
		 
	}


	private function getInput() {
		$t = '';
	if (  isset($_GET['task']) ) { $t =  $_GET['task'] ;}
	if (  isset($_POST['task']) ) {$t =  $_POST['task'] ;}
	
	if (  isset($_GET['num']) ) { $this->obj->id = (int)   $_GET['num'] ;}
	if (  isset($_GET['num']) ) { $this->obj->id = (int)   $_GET['num'] ;}
	 
	return $t ; 
	
	}
   
   public function display() {
   
 	 
	$tsk = $this->getInput(); 
	
	
    $model 				= new modelNewslist($this->cx->db ,$this->obj);
 
	
    if ( (isset($tsk) && !empty($tsk))    && $tsk!='list' ) {  

 
	 
	$method = 'get'.ucfirst($tsk);
	$row	= $model->$method ($_POST) ; 
	$model->addClick($this->obj->id);
 
 
	$this->ariane .='<li>{news}</li><li>'.$row['title' ].'</li>';
 
 
    
	
	$view  = new viewNewslist($row,$this->obj);
	$data  = $view->$method();
	$ariane 	=  $this->remplace_ariane();
	} else {
    $search ='';
	if (isset($_POST['search'])) {$search =$_POST['search']; }  
	
	
	$row				= $model->getData($search);
	
	$this->ariane .='<li>{news}</li>';


	$view  = new viewNewslist($row,$this->obj);
	$data  = $view->display(); 
	$ariane 	=  $this->remplace_ariane();
	}
	
	
	
	$retour = new stdClass ;
	$retour->data 		= $data; 
	$retour->ariane		= $ariane;
	
	
	
	
	
	$retour->titre		= $this->titre;
	
	return $retour ;
   
   }
  	
	
	public function remplace_ariane() 
    {	
		$ariane = $this->ariane;
		$la 		= explode("</li><li>",$this->ariane);  
		$nb 		= count($la );
		if ($nb > 2 ) {
		$deb 		=  $la[$nb-2] ;
		$la[$nb-2]  = '<a href="'.$this->lg.'/newslist/list-'.$this->cx->id.'-0.html">'.$deb .'</a>';
		$ariane = implode("</li><li>",$la ) ; }
		
		
		return  $ariane ;
	}

// Fin classe 
}
