<?php 
 require_once ("includes/Mobile_Detect.php");
class animateur {
	private $cx ;
	private $obj ;
	private $lg ;
	public $li ;
	public $mess = 2 ;
	public $params;
	public $script ;
function browser() {
$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
//you can add different browsers with the same way ..
if(preg_match('/(chromium)[ \/]([\w.]+)/', $ua))
$browser = 'chromium';
elseif(preg_match('/(chrome)[ \/]([\w.]+)/', $ua))
$browser = 'chrome';
elseif(preg_match('/(safari)[ \/]([\w.]+)/', $ua))
$browser = 'safari';
elseif(preg_match('/(opera)[ \/]([\w.]+)/', $ua))
$browser = 'opera';
elseif(preg_match('/(msie)[ \/]([\w.]+)/', $ua))
$browser = 'msie';
elseif(preg_match('/(mozilla)[ \/]([\w.]+)/', $ua))
$browser = 'mozilla';
preg_match('/('.$browser.')[ \/]([\w]+)/', $ua, $version);
return array('name'=>$browser,'version'=>$version[2]);
}
public function __construct($c,$obj,$lg)
	{
	 $this->cx  = $c; 
	 $this->obj = $obj ;
	 $this->lg = $lg;
	 $this->params  = $this->obj->param;
	 
	 $this->db =  $this->cx->db ;
	 
	 
	 $this->browser  = $this->browser();
	 
	//console.log (  $this->browser['name'] ) ;
	 
	} 
 
	 
	 
	
	/***************************************/
	public function affiche() { 
	
	    $this->detect 		= new Mobile_Detect;
	      
		if( $this->detect->isiOS() ){
		
		return ""  ;
 
} else {
		
	 	 
		 $url  = 'modules/animateur/tpl/tpl.php';
		 $data = file_get_contents($url) ; 
		 
		 
		 
		 
		 $tag[]  =  '{video1}';
		 $ext[]  =  $this->params->video1 ;
		 
		 $ext1 = explode(".",$this->params->video1);
		 
		 $tag[]  =  '{ext1}';
		 $ext[]  =  $ext1[1] ;
		 
		 
		 $tag[]  =  '{video2}';
		 $ext[]  =  $this->params->video2;
		 
		 
		 $ext2 = explode(".",$this->params->video2);
		 
		 $tag[]  =  '{ext2}';
		 $ext[]  =  $ext2[1] ;
		 
		 
		 
		 $hauteur1  = ($this->browser['name'] =='mozilla' )? $this->params->hauteur2 : $this->params->hauteur ;
		 //     ($this->browser['name'] =='mozilla' )? $this->params->hauteur + ($this->params->hauteur / 12 )   ;
		 
		 $hauteur2 = $hauteur1 / 2 ;
		  
		 $tag[]  =  '{hauteur1}';
		 $ext[]  =  $hauteur1 ;
		 
		 $tag[]  =  '{hauteur2}';
		 $ext[]  =  $hauteur2 ;
		 
		 $tag[]  =  '{largeur}';
		 $ext[]  =  $this->params->largeur ; 
		 
		 
		 /*
		 $tag[]  =  '{}';
		 $ext[]  =  $this->params-> ;
		 
		 */
		 
		 $tag[]  =  '{image_video}';
		 $ext[]  =  $this->params->image ;
		 
		 
		 $tag[]  =  '{yy}';
		 $ext[]  =   $this->params->position_y ;
		 
		 $tag[]  =  '{xx}';
		 $ext[]  =  $this->params->position_x ;
		 
		 $tag[]  =  '{sens}';
		 $ext[]  =  $this->params->sens ;
		 
		 
		 
		 $tag[]  =  '{freq}';
		 $ext[]  =  $this->params->freq ;
		 
	 
		 
		 
		 $plus   =($this->browser['name'] !='mozilla' )?0:20  ;
		 
		 $tag[]  =  '{plus}';
		 $ext[]  =  $plus ;
		 
		 
		 $html = str_replace ( $tag ,$ext , $data) ;
		 
		 
		return $html;
		 
		 }
	 
	}
}


?>
 

