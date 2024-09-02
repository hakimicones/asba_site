 <?php 

include_once('includes/cfg.php');
include_once('Adm/includes/sendmail.php');

class avis {

function main() { echo $this->insertData();  }

function insertData() {
$cx  = new connect ; 

if ( $cx->con()) { 
	$db = $cx->db; 
$cfg = $cx->cfg  ;	
$adminMail = $cfg->email_admin;	
$date = date('Y-m-d H:i:s');
$data = $_POST ;

$db->resetInsert();

$db->setTableForInsert('is_avis');

$db->setInsertingRub('nom',$data['nom'] ); 
$db->setInsertingRub('email',$data['email'] ); 
$db->setInsertingRub('date_time', $date ); 
$db->setInsertingRub('message',$data['message'] );
$db->setInsertingRub('sujet',$data['sujet'] );  
if ($db->insert()) {
          $message =  'Message envoy&eacute; avec succ&eacute;s' ;
			
        }
        else {
		
			$message =  'ERREUR INSERTION : '.$db->getErrMessage() ;
            
        }
   return $message ;
	
	}





}





 
//$html = 'Bonjour  <br>'.$message;
//["nom"]

 
 function envoiMail($mail, $sujet,$message) { 
	 	$m= new Mail; // create the mail
		
        $m->From( ADMIN_MAIL );
        $m->To(  $mail );
        $m->Subject( $sujet ); 
		//$logo = $m->ajout_img("images/logo.jpg","image1" );
		//$message .="Administrateur <br /><img src=\"cid:image1\">".$logo;
		$m->Body( $message);        // set the body
       // $m->Cc( "someone@somewhere.fr");
       // $m->Bcc( "someoneelse@somewhere.fr");
        $m->Priority(4) ;        // set the priority to Low
        //$m->Attach( "images/logo.jpg", "image/jpg" ) ;        // attach a file of type image/gif
		
        //alternatively u can get the attachment uploaded from a form
        //and retreive the filename and filetype and pass it to attach methos

        return $m->Send();        // send the mail
        //echo "the mail below has been sent:<br><pre>", $m->Get(), "</pre>";
		
	
	}	
	

 }

 
 
 
 
 
 
 
 
 
 
 ?>
