<?php 
include_once('includes/sendmail.php');

class modelCvform {
	public $db  ; 
	public $lg  ; 
	public $message ;
	 
	public function __construct($c)
	{

	 $this->db  = $c->cx->db;
	 $this->lg	= $c->lg;
	 $this->cfg = $c->cx->cfg ;
	
	}
	
	 function getSendCv() {
	 
	     $arr_file_types = ['image/png','image/gif','image/jpg','image/jpeg','application/pdf','application/msword',
		                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'] ;
                                                                  
 $ext =   pathinfo($_FILES["jointe"]["name"], PATHINFO_EXTENSION);
 
  
if (!(in_array($_FILES['jointe']['type'], $arr_file_types))) {

 
	return "Erreur de Type  : ".$_FILES['jointe']['type'];
	 
} 
$filename = 'cv/cv'.uniqid().'.'.$ext ;
move_uploaded_file($_FILES['jointe']['tmp_name'],   $filename );
	 
	 return $this->envMail($_POST, $filename );
	 
	
	 // ($_POST);
	
	}
	
	/**********************************/
	function envMail($data , $filename) {
	
		$body  = "Bonjour;  </br>";
		$body .= 'Un nouveau CV a été envoyé via la plateforme du site Web '."</br>";
		$body .= 'Nom '.$data["nom"]."</br>";
		$body .= 'Email '.$data["email"]."</br>";
		$body .= 'Cordialement'."</br>";
		$body .= '--------------------------------------------------------'."</br>";	
		
		$txt = "Bonjour;  \n\r";
		$txt.= 'Un nouveau CV a été envoyé via la plateforme du site Web '."\n\r";
		$txt.= 'Nom '.$data["nom"]."\n\r";
		$txt.= 'Email '.$data["email"]."\n\r";
		$txt.= 'Cordialement'."\n\r";
		$txt.= '--------------------------------------------------------'."\n\r";
		
		
	include_once('includes/mail/Email.php');	 	 

	$host = "e-portail.alsalamalgeria.com";
	$port = 25;
	$username = "gateway@e-portail.alsalamalgeria.com";
	$password = "Hdn75p2?Ret7_k31iHu2s1#3";


	$from = "gateway@e-portail.alsalamalgeria.com";



		$mail = new Email($host, $port);
		$mail->setLogin($username, $password)
		->setFrom($from )
		->setSubject('CV  '.$data["nom"].' [plateforme site web]')
		->setTextMessage($txt )
		->setHtmlMessage($body)
		->addTo($this->cfg->mail_rh);
 
		if ($mail->send()) {

			$this->message= array('type'=>'success' , 'contenu'=>'{votre CV a été envoyé}' );
			return  $this->message;
	

		}
	

		echo 'An error has occurred. Please check the logs below:' . PHP_EOL;
		$fp = fopen('CronMailLog.txt', 'w');
		
		 
	 
		//fwrite($fp, $mail->getLogs());
		fclose($fp);
		 $this->message= array('type'=>'danger' , 'contenu'=>'Erreur detéctée lors de l\'envoie !!!' );
		return $this->message;

	}	  
		
		/*
				
		$body .= 'AL SALAM ALGERIA BANK'."</br>";		
		
		$mail = new Mail ;		
		$mail->From( $this->cfg->email_admin );
		$mail->To( $this->cfg->mail_rh);
		//$mail->
		$mail->Subject('CV  '.$data["nom"].'[plateforme site web]');
		$mail->Body(utf8_decode($body));
		
		$mail->Attach($filename );
		
	 	if  ($mail->Send()) { return ' L\'email a été envoyé. ' ; } else { return 'Email non envoyé   ';}
		
		*/
		
	 
//Fin classe
}
?>
