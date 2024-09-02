<?php 
class news_letter {
	public  $cx ;
	private $obj ;
	public $li ;
	public $script ;

public function __construct($c,$obj , $lg)
	{
	 $this->cx  = $c; 
	 $this->obj = $obj ;
	 $this->lg = $lg;
	 $this->db =  $c->db ;
	 
	 
	}
	
	public function affiche() { 
	
	if (isset($_POST['cle']) && $_POST['cle'] == $_SESSION['cle'] ) {
	    
		return $this->send($_POST);
	
	} else {
	
	 
		return $this->display();
	
	}
	
	 	
	
	}
	private function send($data){
	
	
	 $this->db->resetInsert();
	 
     $this->db->setTableForInsert('news_acymailing_subscriber');
	 $this->db->setInsertingRub('name',$data['text-name'] ); 
	 $this->db->setInsertingRub('email',$data['mail'] ); 
	 $this->db->setInsertingRub('created', time() ); 
	 if ($this->db->insert()) {
	 
          $html ='<div id="newsletter-pan" class="parallax">
	 			<div class="request_callback container-2">
	             '.$this->obj->param->message.'
			   </div>
	         </div>';
			
        }
        else {
		
			 
			$html ='<div id="newsletter-pan" class="parallax">
	 			<div class="request_callback container-2">
	             '.$this->db->getErrMessage().'
			   </div>
	         </div>';
            
        }
	 
	 
	
	 
	
	return $html;
	}
	private function display() {
	
	 $url  = 'modules/news-letter/tpl/tpl.php';
		 $data = file_get_contents($url) ;  
		 
		 $tag[]  =  '{titre}';
		 $ext[]  = $this->obj->param->titre ;
		 
		 $tag[]  =  '{text}';
		 $ext[]  = $this->obj->param->text ;
		 
		 $tag[]  =  '{cle}';
		 $ext[]  = $_SESSION['cle'];
	 	 
		 $html = str_replace ( $tag ,$ext , $data) ;
		 
		 
		return $html;
	
	
	}
	
	
}


?>
		
 

