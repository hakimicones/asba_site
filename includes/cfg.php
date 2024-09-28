<?php 


include_once('includes/sql/db_class_lib.php');
include_once("config.php");

class connect {
public $cfg ;
public $db;
public $bd = '';
private $user = '';
private $pass = '';
public $error = '';

public function getConfig() {


$this->cfg = new config;


}


public function getMessageErr($erreur) 
{

	$h = fopen('sql_error.log','a');
	$err = date('d-m-Y  H:i').' '.$erreur;
	fwrite($h, $err);
	fclose($h);


}

public function con() {

	$this->getConfig();

	try  
	{ 	
	  	
	
	 $this->db  = new Db($this->cfg->dbname, $this->cfg->host, $this->cfg->user, $this->cfg->pass);
	$this->db->select("mysql_set_charset( 'utf8' );");
	}
	
	
	
	catch (Exception $e)
	{ 			$this->error = array ('Erreur connection  : ' . $e->getMessage() );  return false;	}
	
	return true ;

}


public function closeBD() {

$this->db  = null;

}

}



?>
