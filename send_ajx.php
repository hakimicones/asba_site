<?php 
	
 
if (isset($_GET['option'])) {	
 
$option =	$_GET['option'] ;
include_once('includes/ajax/'.$option.'/'.$option.'.php');

$maClasse = new $option();
$maClasse->main();


} 
?>