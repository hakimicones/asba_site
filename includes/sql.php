<?php 
class connect {
public $cfg ;
public $bdd;
public $bd = 'is_alsalam';
private $user = 'root';
private $pass = '';
public $error = '';

public function getConfig() {

include_once("config.php");
$this->cfg = new config;


}

public function con() {

	$this->getConfig();

	try  
	{ 	$this->bdd = new PDO('mysql:host='.$this->cfg->host .';dbname='.$this->cfg->dbname .';charset=utf8', $this->cfg->user,$this->cfg->pass ); 	}
	catch (Exception $e)
	{ 			$this->error = array ('Erreur connection  : ' . $e->getMessage() );  return false;	}
	
	return true ;

}

public function query($sql) {
try {   $result = $this->bdd->query($sql ); }
catch (Exception $e)
	{ 	$this->error = array ('Erreur connection  : ' . $e->getMessage() );  return false;	}	 

$obj =  $result ;
 
return $result ;

}
public function closeBD() {

$this->bdd  = null;

}

}



?>
