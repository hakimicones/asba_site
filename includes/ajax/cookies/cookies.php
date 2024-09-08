 <?php 
ini_set('display_errors', 1);  // Désactive l'affichage des erreurs à l'écran
ini_set('log_errors', 1);      // Active l'enregistrement des erreurs dans un fichier
ini_set('error_log', 'error_log.log');  // Spécifiez le chemin complet vers votre fichier de journal des erreurs


include_once('includes/cfg.php');
include_once('includes/Mobile_Detect.php'); 

class cookies {

function main() {   $this->insertData();  }

function insertData() 
{

	$acceptation = $_POST['acceptation'];
	$browser     = $_POST['browser'];
	$detect 	= new Mobile_Detect;

	$ip =   $_SERVER['REMOTE_ADDR'];
	$cx  = new connect ; 

	if ( $cx->con()) 
	{ 

		$db = $cx->db; 
		$cfg = $cx->cfg  ;	
		$adminMail = $cfg->email_admin;	
		$date = date('Y-m-d H:i:s');
		$data = $_POST ;

		$db->resetInsert();

		$db->setTableForInsert('is_cookies');

		$db->setInsertingRub('IP',$ip ); 
		
		$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'Tablète' : 'Mobile') : 'Computer');
		$info = $deviceType.' :  '.$browser ;

		$db->setInsertingRub('info',  $info  );
		$db->setInsertingRub('acceptation',$acceptation  );  

	if ($db->insert()) {

	          return true ;				
	        }
	        else {
			
				return false;
	            
	        }
	   
		
		}
}
/****************
 * 
 * 
 *****************/
 




/*********** Fin Classe ***************/
}

 ?>
