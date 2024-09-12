<?php 
include_once('composant/blog/model/modelBlog.php');
include_once('composant/blog/view/viewBlog.php');	 
	
class blog { 
	public $cx;
	public $db ;
	public $obj;	
	private $task_List = array('list','Tabs','Faq','Blog','');
 
   public function __construct($c)
	{
		
		
		
	 	 
		 $this->cx  = $c; 
		 $this->lg	= strtolower($c->lg);
	 	 
		 $this->obj = new stdClass();
		 $this->obj->lg 	= strtolower($c->lg);
		 $this->obj->id 	= $c->id;
		 $this->obj->type 	= array();
		 $this->ariane	  	=  $c->ariane ;
		 $this->obj->detect = $c->detect;
		 
		 
		// $this->obj->format = array();
		 
	}
   
   
 
   public function display() 
   
   {
   
     $retour = new stdClass ;
	
   
   $model 				= new modelBlog ($this->cx->db ,$this->lg);
    
	
	$task =   (isset($_POST['task']))?    strip_tags($_POST['task']):''; 
	
	if ( empty($task) && isset($_GET['task'])) { $task = strip_tags($_GET['task']) ; 
	 
	
	
	if (!in_array($task,  $this->task_List)) 
	
	{
	
	$retour->data 		= '<div class="alert alert-danger"> Fonction '.$task.'inconnues </div>'; 
	 
	$retour->ariane 	= $this->remplace_ariane(); 
	$retour->titre		=  'Erreur 404';
	
		return $retour ;
        
    } ELSE {
	
	
	print_r($_GET);
	
	}
	
	
    if  (!empty($task) && $task!='list' ) 
	{  
	
		$method = 'get'.ucfirst($task);
		
		$this->ariane .='<li>{'.strtolower($task).'}</li>';
		$ariane 	=  $this->remplace_ariane();
		
		$row	= $model->$method ; 
		
		$view  = new viewBlog ($row,$this->obj);
		$data = call_user_func([$view, $method]);
	
	} else {
	
		$search ='';
		if (isset($_POST['search'])) {$search =$_POST['search']; }  
		
		
		$row				= $model->getData($search); 				 
		 
		$view  = new viewBlog ($row,$this->obj);
		$data  = $view->display(); 
		$this->ariane .= '<li>'.$view->ariane.'</li>';
		
	 
	}
	
	 
	$retour->data 		= $data; 
	 
	$retour->ariane 	= $this->remplace_ariane(); 
	$retour->titre		= $view->titre.'_'.$task;
	 
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
