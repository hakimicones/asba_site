<?php 
include_once('composant/madjla/model/model.php');
include_once('composant/madjla/view/view.php');	 
	
class madjla { 
	public $cx;
	public $db ;
	public $obj;	
 
   public function __construct($c)
	{
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
   
   $model 				= new modelMadjla($this->cx->db ,$this->lg);
    
	
	$task =   (isset($_POST['task']))?$_POST['task']:'';
	 
	if ( empty($task) && isset($_GET['task'])) { $task = $_GET['task'] ;  }
	
    if  (!empty($task) && $task!='list' ) {  
	
	
	$method = 'get'.ucfirst($task);
	
	$this->ariane .='<li>{'.strtolower($task).'}</li>';
	$ariane 	=  $this->remplace_ariane(); 
	 
 
 	 
	$view  = new viewMadjla($this->obj );
	$data  = $this->$method($_POST , $_FILES  );
	
	} else {
    $search ='';
	 
 	$id=(isset($_GET['id'])) ? (int) $_GET['id']:0 ;
 	$id=(isset($_POST['id'])) ? $_POST['id']:$id ;
	
	$this->obj->article = $model->getArticle($id) ;


	 
	 
	$view  = new viewMadjla( $this->obj);
	$data  = $view->display(); }
	
	
	$retour = new stdClass ;
	$retour->data 		= $data; 
	
	 
	$retour->ariane 	= $this->ariane.' <li> '.$this->cx->title.' </li>' ;
	$retour->titre		= $this->cx->title;
	 
	return $retour ;
   
   }
	public function remplace_ariane() 
    {	
		$ariane = '';
		$la 		= explode("</li><li>",$this->ariane);  
		$nb 		= count($la );
		if ($nb > 2 ) {
		$deb 		=  $la[$nb-2] ;
		$la[$nb-2]  = '<a href="'.$this->lg.'/cvtech/list-'.$this->cx->id.'-1.html">'.$deb .'</a>';
		$ariane = implode("</li><li>",$la ) ; }
		return  $ariane ;
	}
public function getMessage() {



 $m='';
 if (!empty($this->message['contenu'])) {
 $m = '<div class="container"><div class="alert alert-'.$this->message['type'].' fixed" role="alert">
       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
	   .$this->message['contenu'].'</div></div>'; }
 // print_r( $this->message['contenu'] );
 return $m;
 }
public function getEnvArticle($data,$files) {

 
	

$arr_file_types =  ['application/pdf','application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document'] ;

                                                                

if (!(in_array($files['file']['type'], $arr_file_types))) {
	echo "false : ".$files['file']['type'];
	return;
}

 
 

$ext =   strtolower(pathinfo($files['file']['name'],PATHINFO_EXTENSION));
$fic = 'docs/contribution_'. rand(10000, 99999).'.'. $ext;

 


if (move_uploaded_file($files['file']['tmp_name'],  $fic  )) {
 $this->message = [ "contenu" => 'Votre contribution a été envoyée <br>Vous serez contacter ulterieurement <br>  Nous vous remercions ' ,    "type" => 'success',];

 

   if ($this->envMail($data , $fic , $files['file']['type']) ) {


		unlink( $fic);

		$id=(isset($_GET['id'])) ? (int) $_GET['id']:0 ;
 		$id=(isset($_POST['id'])) ? $_POST['id']:$id ;


 		 $model 		= new modelMadjla($this->cx->db ,$this->lg);
		$this->article 	= $model->getArticle($id) ;
	 
		 $this->message = [ "contenu" => $this->article->data ,    "type" => 'success',];

		}
 
} else {


    $this->message = [ "contenu" => 'Erreur de chargement du fichier ' ,    "type" => 'danger',];

		 
	 


}

 return   $this->getMessage() ;


  
}	


function upload($data ,   $fic) {

 






}


function envMail($data, $fic , $type) {

	
	
	    
		$url = 'composant/madjla/view/tpl/body_'. $this->lg.'.php';
		$f = file_get_contents($url) ;
	
	    $tag[]  = '{name}';
		$ext[]  =  $data["name"] ;


		$tag[]  = '{nele}';
		$ext[]  =  $data["nele"] ;


		$tag[]  = '{niveau_scientifique}';
		$ext[]  =  $data["niveau_scientifique"] ;

		$tag[]  = '{specialite}';
		$ext[]  =  $data["specialite"] ;


		$tag[]  = '{memoire}';
		$ext[]  =  $data["memoire"] ;


		$tag[]  = '{universite}';
		$ext[]  =  $data["universite"] ;

		$tag[]  = '{titre}';
		$ext[]  =  $data["titre"];

		$tag[]  = '{fonction}';
		$ext[]  =  $data["fonction"] ;
		
		$tag[]  = '{lieudetravail}';
		$ext[]  =  $data["lieudetravail"] ;

		$tag[]  = '{residence}';
		$ext[]  =  $data["residence"] ;

		$tag[]  = '{tel}';
		$ext[]  =  $data["tel"] ;

		$tag[]  = '{email}';
		$ext[]  = $data["email"]  ;


		/*
	 {}
		$tag[]  = '{}';
		$ext[]  =  $data[""] ;
		*/
		
		 
		
		$body = str_replace ( $tag , $ext , $f) ;

		/*
		$body  = 'Bonjour; '."<br>";

		 
		$body .= "Voici les informations concernant la proposition d'article"."<br>";
		$body .= "Nom et Prénom : ".."<br>";
		$body .= "E-mail : ".."<br>";
		$body .= "Titre : ".."<br>";
		$body .= ""."<br>";
		$body .= 'Cordialement'."<br>";
		$body .= '--------------------------------------------------------'."<br>";		
		$body .= 'Envoyé depuis le site'."<br>";		
		*/
		$mail = new Mail ;	 
		$mail->ctencoding = "base64";
		$mail->From( 'site@alsalamalgeria.com' );
		$mail->To('hakim@icon-dz.com');
		//$mail->
		$mail->Subject('Contribution '.$data["name"]);
		$mail->Body($body,'utf-8');

		$mail->Attach($fic,$type, "inline") ;
		
		 
		
		return $mail->Send() ;

	}

// Fin classe 
}
