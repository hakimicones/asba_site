<?php 
session_start();
header( 'content-type: text/html; charset=utf-8' );
include_once('includes/main.php');


 
$html = new main(  ) ;
$html->getPages( ); 
 
 
 

?>
 
 