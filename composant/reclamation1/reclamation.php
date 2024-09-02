<?php 
include_once('composant/reclamation/model/model.php');
include_once('composant/reclamation/view/view.php');	 
include_once("config.php");
include_once("includes/sendmail.php");
	
class Reclamation { 
	public $cx;
	public $db ;
	public $obj;	
	public $message  ;
	public $arraytask; 

 
   public function __construct($c)
	{

 		
         $n = (isset($_SESSION['rec'])) ? $_SESSION['rec'] : 0  ;
         $n++;
		 $_SESSION['rec'] =$n ;


		// print_r($_SESSION);
	  	 $this->arraytask= array("inscription","validation");
		 $this->cx  = $c; 
		 $this->lg	= strtolower($c->lg);
	 
		 
		 $this->obj = new stdClass();
		 $this->obj->lg 	= strtolower($c->lg);
		 $this->obj->id 	= $c->id;
		 $this->obj->type 	= array();
		 $this->ariane	  	=  $c->ariane ;
		// $this->obj->format = array();
		 
	}
   
   public function display() {
	   
	   $ariane = '';
   	 $model	= new modelReclamation($this->cx->db ,$this->lg);
   			if (isset($_SESSION['hd_email'] )) {

			$d['email'] = $_SESSION['hd_email'] ;
	    	$d['id']    = $_SESSION['hd_id_user'] ;
	    	$d['name'] 	= $_SESSION['hd_name'] ;
   
  
    //$this->ariane .=;
	
	$task =   (isset($_POST['task']))?$_POST['task']:'';

 

	 
	if ( empty($task) && isset($_GET['task'])) { $task = $_GET['task'] ;  }


   
	
    if  (!empty($task) && $task!='list' ) {  
	
	
		$method = 'get'.ucfirst($task);


		$this->ariane .= '<li> <a href="'.$this->lg.'/reclamation/list-'.$this->cx->id.'-0.html">'.$this->cx->title.'</a>  </li><li>{'.strtolower($task).'}</li>';
		
		$ariane 	=  $this->ariane; 
		 
	 
	 	 
		$view  = new viewReclamation($this->obj );
  		

	    	$data  = $this->$method($d , true  );


	
	} else {


   			$this->ariane .=' <li> '.$this->cx->title.' </li>';
   			$ariane    = $this->ariane ;

	    	$data  = $this->getreclamation($d , true  );

	
    }
    } else {


			 

  			$data  = $this->getlogin(); 

  		}
	 
	
	
	$retour = new stdClass ;
	$retour->data 		= $data; 
	
	 
	$retour->ariane 	= $ariane ;
	$retour->titre		= $this->cx->title;
	 
	return $retour ;
   
   }








   public function getlogin()
   {

	$view  = new viewReclamation($this->obj );
   	 $model	= new modelReclamation($this->cx->db ,$this->lg);
   	$task =   (isset($_POST['task']))?$_POST['task']:'';
    if ( empty($task) && isset($_GET['task'])) { $task = $_GET['task'] ;  }
   
  	$this->message 	= $model->getreclamation($_POST);
       if  (!empty($task) ) {

     
       	if (in_array($task, $this->arraytask)) {
             $method = 'get'.ucfirst($task);
 
	    	$data  = $this->$method($_POST , true  );
     
           }

         else{
   	
   
     

     //  	if ($this->message->type!="success"){
		 if (isset($this->message->type) && $this->message->type!="success"){
       		
       		$data= (!empty($_POST)) ?  $this->getMessage() : ''; 
	        $data  .= $view->display();


       	}

       		else{

           $d['email'] = $_SESSION['hd_email'] ;
	    	$d['id']    = $_SESSION['hd_id_user'] ;
	    	$d['name'] 	= $_SESSION['hd_name'] ;

	    	 
       			$data  = $this->getreclamation($d , true  );
       		}}

         
         }

         else{
   	$view  = new viewReclamation( $this->obj);
			$data  = $view->display();
   
   	}
     
   		return $data; 
   }



	public function remplace_ariane() 
    {	
		$ariane = '';
		$la 		= explode("</li><li>",$this->ariane);  
		$nb 		= count($la );

		if ($nb > 2 ) {
		$deb 		=  $la[$nb-2] ;
		$la[$nb-1]  = '<a href="'.$this->lg.'/reclamation/list-'.$this->cx->id.'-0.html">'.$deb .'</a>';
		$ariane = implode("</li><li>",$la ) ; }

		print_r($ariane );
		return  $ariane ;
	}
public function getMessage() {

	 $m='';
	 if (!empty($this->message->contenu)) {
	 $m = '<div class="container"><div class="alert alert-'.$this->message->type.' fixed" role="alert">
	       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
		   .$this->message->contenu.'</div></div>'; }
	 // print_r( $this->message['contenu'] );
	 return $m;
 }


public function getreclamation($data,$files) {
 
   

   	$model = new modelReclamation($this->cx->db ,$this->lg);



   	$this->ret = new stdClass ;	
  
    $this->ret->id   =    $_SESSION['hd_id_user'];


    

   


	$view  = new viewReclamation( $this->obj);



	$ticket 		= $model->gettickets($this->ret->id);
	 	$archive		= $model->gethistory();
            	
             	$btn 			= '

             	<style>
             	#recBtn {

					    background: #02905B;
					    background-image: linear-gradient(to bottom, #02905B, #251919);
					    display: block;
					    height: 62px;
					    width: 62px;
					    position: fixed;
					    right: 10px;
					    top:160px;
					    z-index: 10;
					    -webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
					    -moz-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
					    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
					    border-radius: 30px;
                 }
                 #recBtn i {

						font-size: 35px;
						text-align: center;
						padding: 13px;
						color: #fff;		
             }

             	</style>
             	<a href="ar/reclamation/history-'.$this->obj->id.'-0.html" id="recBtn" class="" data-toggle="tooltip" title="" data-original-title="" style="margin-left: 10px;"><i class="fa fa-list"></i></a>';

	if (empty($ticket->result)) {

		
		
             	$f  = $view->displayreclamation();
             	$type 			=$model->gettype();
             	$departments    =$model->getdepartments();


            


             	$typeview		=$view->gettype($type->result);
             	$departmentsview=$view->getdepartments($departments->result);


 
             	   $tag[]  = '{optiontypeticket}';
		           $ext[]  =  $typeview ;
		           $tag[]  = '{optiondepartementticket}';
		           $ext[]  = $departmentsview ;
		           $tag[]  = '{userid}';
		           $ext[]  = $this->ret->id ;



		           $tag[]  = '{btn}';
		           $ext[]  =  ( $archive ) ? $btn  : '';



		           $data = str_replace ( $tag , $ext , $f) ;
		
	
	}else
		{ 
			 
				$result=$ticket->result; 
				foreach( $result as $value) {


						switch ($value['resolved']) {
						case 0:
						$etat="{en_attente}";
							break;
						case 1:
							
						$etat="{en_cours}";
							break;
						case 2:
						$etat="{resolu}";	
						   break;
						
					}

				   $comment=$model->getcomment($value['id'],$value['user_id']);
			       $f  = $view->displayticket();
		           $tag[]  = '{ticketbody}';
		           $ext[]  =  $value['init_msg'];
		           $tag[]  = '{ticketsujet}';
		           $ext[]  = $value['title'] ;
		           $tag[]  = '{comment}';
		           $ext[]  =$view->getcommentticket($comment->result);
		           $tag[]  = '{ticketid}';
		           $ext[]  = $value['id'];
		           $tag[]  = '{userid}';
		           $ext[]  =  $this->ret->id  ;
                   $tag[]  = '{departementval}';
		           $ext[]  =    $value['departmentname'] ;
				   $tag[]  = '{typeval}';
		           $ext[]  =    $value['categorielibelle'] ;
		           $tag[]  = '{chioxval}';
		           $ext[]  =   $value['typelibelle'] ; 
		           $tag[]  = '{etatticketval}';
		           $ext[]  =   $etat ; 

		           $tag[]  = '{btn}';
		           $ext[]  =  (count($archive)) ? $btn  : '';
		           $data = str_replace ( $tag , $ext , $f) ;}
		       }

	return $data;  

}	
public function getinscription($data,$files) {
	  $model = new modelReclamation($this->cx->db ,$this->lg);
      $ret  = $model->getinscription($data);
/*
	$html ='<div class="container" style="
    background-color: #ffff;
    padding: 30px 10px;">'.$this->getMessage().
			'<p>{Messageactivation} </p></div>';
*/

	/**********************/



	return $this->getEmail($data , $ret->cle  );

/************************/
	return $html;  


}
public function getreclamationeng($data,$files) {

    $model = new modelReclamation($this->cx->db ,$this->lg);

		$this->message = $model->getreclamationenrg($data);

 

	$view  = new viewReclamation( $this->obj);
	$data  =$this->getMessage()."". $view->displayreclamationeng($this->message->bc);



	return $data;  


}	
public function getvalidation() {

	$model 				= new modelReclamation($this->cx->db ,$this->lg);
	 
	$this->message      = $model->validation($data);


	$this->message->contenu .=  '<hr><a href="'.$this->lg.'/reclamation/list-'.$this->cx->id.'-0.html">'.$this->cx->title.'</a>';


	 
	$data  =$this->getMessage()  ;


	return $data;  
	


}	
public function getHistory($data,$files) {
 	$model = new modelReclamation($this->cx->db ,$this->lg);
	$view  = new viewReclamation( $this->obj);



                   
				   $history=$model->gethistory();
			       $f  = $view->displayhistory(); 
		           $tag[]  = '{history}';
		           $ext[]  =  $view->getlistticket($history->result);
		          
		           $data = str_replace ( $tag , $ext , $f) ;
	

return $data; 
}	
public function gethistoryticket()

{
				$model = new modelReclamation($this->cx->db ,$this->lg);
				$view  = new viewReclamation( $this->obj); 	
				$idticket=(isset($_GET['num'])) ? (int) $_GET['num']:0 ;
			 	$ticket 		= $model->gethistorytickets($idticket);
			 	$data=""; 

			 	$result=$ticket->result; 
				foreach( $result as $value) {
					switch ($value['resolved']) {
						case 0:
						$etat="{en_attente}";
							break;
						case 1:
							
						$etat="{en_cours}";
							break;
						case 2:
						$etat="{resolu}";	
						   break;
						
					}
				

	               $comment=$model->getcomment($idticket,$value['user_id']);
			       $f  = $view->displayticket();
		           $tag[]  = '{ticketbody}';
		           $ext[]  =  $value['init_msg'];
		           $tag[]  = '{ticketsujet}';
		           $ext[]  = $value['title'] ;
		           $tag[]  = '{comment}';
		           $ext[]  =$view->getcommentticket($comment->result);
		           $tag[]  = '{ticketid}';
		           $ext[]  = $idticket;
		           $tag[]  = '{userid}';
		           $ext[]  =  $_SESSION['hd_id_user'] ;
		           $tag[]  = '{btn}';
		           $ext[]  = '';
		           $tag[]  = '{departementval}';
		           $ext[]  =    $value['departmentname'] ;
				   $tag[]  = '{typeval}';
		           $ext[]  =    $value['categorielibelle'] ;
		           $tag[]  = '{chioxval}';
		           $ext[]  =   $value['typelibelle'] ; 
		           $tag[]  = '{etatticketval}';
		           $ext[]  =   $etat."" ; 
		           $data = str_replace ( $tag , $ext , $f) ;
		       }
		       return $data; 
}

function upload($data ,   $fic) {

 






}


function getEmail($d , $cle ) {

/*
$view  = new viewReclamation( $this->obj);
$disp  = $view->display(); 
*/

$this->cfg = new config;

$data = array();

$html  = '<h3>Bonjour '.$d['nom'].'</h3>';
$html .= 'Merci pour votre inscription sur le service de réclamation de la banque<br>';
$html .= 'Cliquez sur le lien pour valider votre compte <br>';
$html .= '<a href="'.$this->cfg->url.'/index.php?option=reclamation&task=validation&cle='.$cle.'&id='.$this->obj->id.'">Validation de votre compte </a><br>';
$html .= '---------------------<br>';
$html .= 'Le support Alsalam Bank Algeria';

$data['html'] =  $html;

$txt  = 'Bonjour '.$d['nom']."\r\n";
$txt .= 'Merci pour votre inscription sur le service de réclamation de la banque'."\r\n";
$txt .= 'Copiez le lien sur un un navigateur '."\r\n";
$txt .= $this->cfg->url.'/index.php?option=reclamation&task=validation&cle='.$cle.'&id='.$this->obj->id."\r\n";
$txt .= '-------------------'."\r\n";
$txt .= 'Le support Alsalam Bank Algeria'."\r\n";




$data['txt']  = $txt;


 $this->envoiMail($d['email'], 'Validation de votre Compte', $data);

    $view  = new viewReclamation( $this->obj);
	

	$html ='<div class="container" style="
    background-color: #ffff;
    padding: 30px 10px;">'.$this->getMessage().
			'<p>{Messageactivation} </p></div>';
    $data  = $view->displayMess($html); 
	return    $data;

}

 
 function envoiMail($to, $sujet,$data) { 
include_once('includes/mail/Email.php');	 	 
/*
$host = "mail.icon-dz.com";
$port = 587;
$username = "contact@icon-dz.com";
$password = "a147z258e369";


 
*/
$host = "e-portail.alsalamalgeria.com";
$port = 25;
$username = "gateway@e-portail.alsalamalgeria.com";
$password = "Hdn75p2?Ret7_k31iHu2s1#3";


$from = "gateway@e-portail.alsalamalgeria.com";

//$from = "contact@icon-dz.com";
//$to = "nouashakim@gmail.com";
//$to = "hakimnouas@hotmail.com";

$mail = new Email($host, $port);
$mail->setLogin($username, $password)
    ->setFrom($from )
    ->setSubject($sujet)
    ->setTextMessage($data['txt'] )
    ->setHtmlMessage($data['html'])
    ->addTo($to);
 
if ($mail->send()) {
    return  true;
     
}

echo 'An error has occurred. Please check the logs below:' . PHP_EOL;
print_r($mail->getLogs());
return false;
	
	}	



// Fin classe 
}
