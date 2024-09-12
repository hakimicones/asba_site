<?php 
	
 
if (isset($_GET['option'])) {	
 
$option =	$_GET['option'] ;

$inc = 'includes/ajax/'.$option.'/'.$option.'.php';

 
if (file_exists($inc )) 
{
include_once('includes/ajax/'.$option.'/'.$option.'.php');

$maClasse = new $option();
$maClasse->main();
}
else {

echo "Option non implementer";

}

} 
?>