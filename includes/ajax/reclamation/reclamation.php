<?php 

include_once('includes/cfg.php');



class reclamation {
public $db; 
function main() { 
	$postajax =   (isset($_POST['postajax']))?$_POST['postajax']:'';
    $cx  = new connect ; 
    $this->lg = (isset($_GET['lg'])) ? $_GET['lg'] :'ar';

if ( $cx->con()) { 
    $this->db = $cx->db; 
    $cfg = $cx->cfg  ;  

    $method = 'get'.ucfirst($postajax);
      $this->$method(); }
                 }

    public function varTrad($data) {
    $dom = new DOMDocument();
    $xml =   "lg/".$this->lg."/".ucfirst($this->lg).'.xml';

  
    //$xml =  'lg/ar/Ar.xml';
    // 
        $dom->load($xml);
        $btn = $dom->getElementsByTagName('var');
        $ext = array();
        $tag = array();
        $t = '';
        
         

    //  echo count($btn);
        
        foreach($btn as $b) {


        
            $t .= $b->getAttribute("name").' , ';
            
            $tag[]  =  $b->getAttribute("name");
            $ext[]  =   $b->getAttribute("trad") ;  

            $htmls = $b->getAttribute("trad") . "\r\n" ;
            
        }
        // print_r($ext);    
      
    $html = str_replace ( $tag ,$ext , $data) ;
     

        
    


    return   $html;
    
    }

function getchoix() {
        $id =   (isset($_POST['type']))?$_POST['type']:0;

	         $this->db->resetSelect();
         $this->db->addSelected('id', 'id');
         $this->db->addSelected('libelle_'.$this->lg, 'libelle');
         $this->db->addFrom('hd_type_tickets as u');
         $this->db->addWhere('categorie_id = :id');
         $this->db->addParamToBind('id', $id);

        if ( $this->db->select()) {
            $result =  $this->db->getAllRows();
                      foreach($result as $value) {
                echo    '<option value="'.$value['id'].'">'.$value['libelle'].'</option> '; 
            }

        }
        else {
            echo 'ERROR: '. $this->db->getErrMessage();
            echo '<br><br>';
        }



       


}
public function getnameuser($value)
{
    $this->db->resetSelect();
        $this->db->addSelected('nick_name', '');
         $this->db->addFrom('hd_users as u');
         $this->db->addWhere('id = :id');
         $this->db->addParamToBind('id', $value);

        if ( $this->db->select()) {
            $result =  $this->db->getAllRows();
                      foreach($result as $value2) {
             return $value2['nick_name']; 
            }

        }
        else {
            echo 'ERROR: '. $this->db->getErrMessage();
            return ''; 
        }
}

public function getreplies()
{$data=$_POST; 
     $this->db ->resetInsert();
         $this->db ->setTableForInsert('hd_ticket_replies');
         $this->db ->addInserting('user_id', ':userid');
        $this->db ->addInserting('text', ':text');
        $this->db ->addInserting('ticket_id', ':ticketid');
         
        $this->db ->setInsertingRub("prive",$data['prive']);
         $this->db ->addParamToBind('userid', $data['t']);
        $this->db ->addParamToBind('text', $data['replies']);
        $this->db ->addParamToBind('ticketid', $data['u']);
        
$html=""; 
        if ( $this->db ->insert()) {
            $name= $this->getnameuser($data['t']); 
            if ($name!=''){
                
             $html= '<div class="entry">
    <div class="title">
      <h3 class="h3history">'.$name.'</h3>
      <p class="phistory">'.date("Y-m-d H:m:s").'</p>
    </div>
    <div class="body">
      <p class="phistory" >' .$data['replies'].'</p>
      
    </div>
  </div> ';}
        
        }
        else {
                        echo 'ERROR: '. $this->db->getErrMessage();
                        $html=""; 
            
        }
       
                             
                            echo $html; 
}

public function getemail()
{  $msg=""; 
            $email =   (isset($_POST['email']))?$_POST['email']:"";
              $this->db->resetSelect();
        $this->db->addSelected('id', 'id');
         $this->db->addFrom('hd_users as u');
         $this->db->addWhere('email = :email');
         $this->db->addParamToBind('email', $email);

        if ( $this->db->select()) {
            $result =  $this->db->getAllRows();
                      foreach($result as $value) {
                $msg=  "{email_deja_utiliser}".$value['id'];
            }

        }
        else {
         $msg= 'ERROR: '. $this->db->getErrMessage();
            
        }
		
		
		
			$tag[]  = '{}';
			$ext[]  =  '';
 
       $data = str_replace ( $tag , $ext , $msg) ;
       echo $this->varTrad($data);

}


function getSetResolu() {

    $data=$_POST; 
 

    $this->db->resetUpdate();
    $this->db->setTableToUpdate('hd_tickets');
    $this->db->setIdToUpdate('id = :id');
    $this->db->addParamToBind('id',$data['id'] );
    
     $this->db->setUpdatingRub('resolved',2 );
  
    
    
    
      if ($this->db->update()) {
    //  echo $this->db->q;
             echo '
             <div class="alert alert-success fixed" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
             Le ticket est marqué comme résolu
         </div>
' ; 
      
        }
        else {
       echo 'ERREUR INSERTION : '.$this->db->getErrMessage()."\r\n".$this->db->q;
         
            
        }


}

/*******/

function sendEmail($d , $cle ) {

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


 $this->envoiMail($d['email'], 'Un nouveau ticket', $data);

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
/***********/
 
 function envoiMail1($mail, $sujet,$message) { 
	 	 

$host = "mail.icon-dz.com";
$port = 587;
$username = "contact@icon-dz.com";
$password = "a147z258e369";


$from = "contact@icon-dz.com";
$to = "nouashakim@gmail.com";
$to = "hakimnouas@hotmail.com";

$mail = new Email($host, 465);
$mail->setProtocol(Email::SSL)
    ->setLogin($username, $password)
    ->setFrom($from )
    ->setSubject('Sujet')
    ->setTextMessage('Plain text message')
    ->setHtmlMessage('<strong>HTML  Message Pour Tester</strong>')
    ->addTo($to)
    ->addAttachment(dirname(__DIR__) . '/LICENSE')
    ->addAttachment(dirname(__DIR__) . '/README.md');

if ($mail->send()) {
    echo 'Message Envoye a ' .$to . PHP_EOL;
    exit(0);
}

echo 'An error has occurred. Please check the logs below:' . PHP_EOL;
print_r($mail->getLogs());
	
	}	







	

 }
 
 
 ?>
