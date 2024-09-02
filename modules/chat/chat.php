<?php 
class chat {
	private $cx ;
	private $obj ;
	private $lg ;
	public $li ;
	public $mess = 2 ;
	public $script ;	

public function __construct($c,$obj,$lg)
	{
	 $this->cx  = $c; 
	 $this->obj = $obj ;
	 $this->lg = $lg;
	 
	}
	
	public function affiche() { 
	$div  = ' ';	
	$data =  $this->getData();		 
	$div    .= $data ;
	$div    .='<a href="javascript:;" id="btn_sup" data-effect="shake" class="btn_bas2 gauche bottom_sup"> {Support Client} </a>';
	return 	$div ;		
	
	}
	public function getData() { 
	$data = file_get_contents( 'modules/chat/view/default.php') ; 
	
	
	$html = str_replace ( '{message_chat}' ,'{message_chat_2}' , $data) ; 
	return $html;
	}
}


?>

