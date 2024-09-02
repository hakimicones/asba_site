 <?php 
  include_once('includes/Mobile_Detect.php');
 class modules {
        public $cx  ; 
        public $position  ; 
        public $obj = array()  ;
        private $lg;
        private $idp; 
        public function __construct($c ,$pos , $lg , $id ) {
        $this->obj = new stdClass;
        $this->cx = $c ;
        $this->position = $pos ;
        $this->lg = $lg ;
        $this->idp = $id;
       $this->detect        = new Mobile_Detect;
 }
 
 public function getModel() {}
 
 public function getModules() {

 $db =  $this->cx->db ;	
 $db->resetSelect(); 
 $db->addSelected('*', '');
 $db->addFrom('is_modules as a');
 $db->addFrom('is_modules_pages as b');
 $db->addWhere("a.id = b.id_module  ");
 $db->addWhere("position =  :pos");
 $db->addWhere('b.id_page = :idp');  
 $db->addWhere('a.publier = 1'); 
 
 $db->addParamToBind('pos', $this->position ); 
 $db->addParamToBind('idp', $this->idp );  
 
 $this->obj->url = '';
 
 if (!$db->select()){echo $db->q;  echo 'ERREUR->Module: '.$db->getErrMessage().'<br><br>';  return '';  }
        else {    
		
		 $result = $db->getAllRows(); 
             foreach($result as $page) 
 
			 {
			 $this->obj->url 			= $page['alias'];
			 $this->obj->script1 		= $page['script1'];
			 $this->obj->script2 		= $page['script2'];
			 $this->obj->libelle 		= $page['libelle'];
			 $this->obj->contenu        = $page['contenu'];
			 $this->obj->idp	     = $this->idp;
			 $this->obj->param 	     = json_decode( $page['param']) ;
			 $this->obj->id_module    = $page['id_module'];
                      $this->obj->detect       = $this->detect ;
			  
			  }
			   
  return $this->obj ;
 }

 }
 public function getControl() {
 $html='';
 $script = '';
 $myobj = $this->getModules();
 if ($this->obj->url!='' ) {
 
 include_once('modules/'.$myobj->url.'/'.$this->obj->url.'.php');
 $maclasse =  str_replace('-','_',$this->obj->url);
 $monobjet = new $maclasse($this->cx, $this->obj , strtolower($this->lg));
 
 $html   = $monobjet->affiche(); 
 $script .= $monobjet->script;
 
 }

 $data = new stdClass;
 $data->html    =  $html ;
 $data->script  =  $script ;
 
 return $data ;
 }
 
 public function getView() {
 
 
 
 }
 
 public function getScript()  {
 
 
 
 }
 
 public function getCss()  {
 
 
 
 }
 
 
 
 
 
 }
 
 
 
 
 
 ?>
