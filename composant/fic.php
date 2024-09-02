<?php 
 
$dirname = 'produits'; 

 
$dir = opendir($dirname); 
while($file = readdir($dir)) 
	{ 
	if($file != "." && $file != ".." ){
		if( is_dir( $dirname. "/".$file)) { 
		echo $dirname. "/".$file."/index.php"."<br>"; 
		$f = fopen( $dirname. "/".$file."/index.php","w+");
		fputs($f, '<!DOCTYPE html><title></title>');
	
	    		$sdir =  opendir( $dirname. "/".$file); 
	    			while($f  = readdir($sdir)) {
	    
	    			if($f != "." && $f  != ".." ){
					if( is_dir( $dirname. "/".$file."/".$f )) { 
						echo $dirname. "/".$file."/".$f."/index.php"."<br>"; 
						$f = fopen( $dirname. "/".$file."/".$f."/index.php","w+");
						fputs($f, '<!DOCTYPE html><title></title>');
				
						}
					}
	    
	    			}
	    
	
	
	 
	 
		}   
	} 
	 
}
closedir($dir); 
 


?>