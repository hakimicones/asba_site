<?php 
include_once('composant/produits/model/modelProduits.php');
include_once('composant/produits/view/viewProduits.php');	 
	
	
	
class produits { 
	public $cx;
	public $db ;
	public $obj;	
	public $titre; 
	public $ariane;
	public $page_id;
	private $task_List = array('list','detail' ,'');
	
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
		 $this->obj->detect = $c->detect; 

		 $this->obj->cx    	= 	$c->cx;	 
		 
	}
	private function getInput() {
	if (  isset($_GET['task']) ) { $t =  $_GET['task'] ;}
	if (  isset($_POST['task']) ) {$t =  $_POST['task'] ;}
	
	if (  isset($_GET['num']) ) { $this->obj->id = (int)   $_GET['num'] ;}
	if (  isset($_POST['num']) ) { $this->obj->id =  $_POST['num'] ;}
	 
	return $t ; 
	
	}
   
   public function display() {
   
 	$retour = new stdClass ;
	$tsk = $this->getInput(); 
	
	
    $model 				= new modelProduits($this->cx->db ,$this->obj);
	
	if (!in_array($tsk,  $this->task_List)) {
	
		$retour->data 		=   '<div class="container"><div class="alert alert-danger"> Fonction '.$tsk.' inconnue </div></div>'; 
		 
		$retour->ariane 	= $this->remplace_ariane(); 
		$retour->titre		= 'Page inconnue';
		
		return $retour ;
         
    }	 
 
	
    if ( (isset($tsk))    && $tsk!='liste' ) {  

 
	 
	$method = 'get'.ucfirst($tsk);
	$row	= $model->$method ($_POST) ; 
	$model->addClick($this->obj->id);
	 if (isset($row['lien'])) {
	$this->obj->liens = $model->getSim($row['lien'] ); }
	$this->obj->desc = $model->getTabsContent();
    if (isset($row['libelle_'.$this->lg])) { 
    $this->ariane .='<li>'.$row['libelle_'.$this->lg].'</li>';
    $this->titre  = ' ';//$row['libelle_'.$this->lg];
     }
	
	$view  = new viewProduits($row,$this->obj);
	$data  = $view->$method();
	 if (isset($row['id'])) { 
	 $fr = (strtolower($this->lg)!="ar")?strtolower($this->lg)."_":'';
	$retour->bg			=  'images/bg_produit/bg_'.$fr.$row['id'].'.jpg'  ; }
	
	
	$ariane 	=  $this->remplace_ariane();
	} else {
    $search ='';
	if (isset($_POST['search'])) {$search =$_POST['search']; }  
	
	
	$row				= $model->getData($search);
	  
	 
	$view  = new viewProduits($row,$this->obj);
	$data  = $view->display(); 
	$ariane 	= $this->ariane ;
	}
	
	
	//2540

	$retour->data 		= $data; 
	$retour->ariane		= $ariane;	
	$retour->titre		= $this->titre;

	
	
	return $retour ;
   
   }
  	
	
	public function remplace_ariane() 
    {	
		$ariane = '';
		$la 		= explode("</li><li>",$this->ariane);  
		$nb 		= count($la );
		if ($nb > 2 ) {
		$deb 		=  $la[$nb-2] ;
		$la[$nb-2]  = '<a href="'.$this->lg.'/page/list-'.$this->cx->id.'-1.html">'.$deb .'</a>';
		$ariane = implode("</li><li>",$la ) ; } else {$ariane = $this->ariane ; }
		return  $ariane ;
	}

// Fin classe 
}
