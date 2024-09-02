<?php 

include_once("config.php");
include_once('includes/cfg.php');
include_once('includes/cms/modules.php');
include_once('composant/content/contenu.php');

class html_rend  {

	public $head = array() ;
	public $doc;
	public $body;
	public $meta;
	public $link;
	public $title ;
	public $tmp_url;
	public $script ;
	public $style ;
 	public $id ;
	public $slider ;
	public $cx;
	public $tmp;
	public $lg;
	public $rtl;	
	public $param;
	public $ispage;
	public $cfg;
	public $ariane ;
	private $idp;
	
  const URL_BASE = '';
   
public function __construct($c , $tmp  ) {
$this->cfg = new config;
 
if (isset($tmp)&& !empty($tmp) ) {$this->tmp = $tmp ; } else { $this->tmp = 'default';} 
 
	$this->cx = $c ; 
	
	
}


public function getCon() {

if (isset( $_GET['id']    )) { $id = $_GET['id'];} else { $id = 1 ;}
if (isset( $_GET['option'])) { $option = $_GET['option'];} else { $option= 'page' ;}

$c = new connect ; 

return  $c->con()   ;

}
public function getHeader($lg ,$f ,$rtl,$tmp) {


if (isset($tmp)) {} else { $tmp = 'default';}
$this->tmp_url =  $this::URL_BASE . 'themes/'.$tmp ;
include_once('themes/'.$tmp.'/header.php');

 
}

 


public function setHead($h) {

$this->head  =  array($h) ;

}

public function getHead() {

$h = $this->head ;
$hh = '<!-- css-->';
foreach ( $h as $li_head ) {
$hh .= $li_head;

}
return $hh;

}

 

 
public function getBody() {

// Remplacer Style
$html = str_replace('{Style}' , '<style>'.$this->style.'</style>' , $this->body ) ;


//Remplacer Script



echo $html ;
 

}



 



//  Lire XML
public function getDataXml($url) {
}




//******************************

public function getDataHtml(  ) {
$data  = $this->getContenu();
// $data = file_get_contents($url) ;
$dom = new DOMDocument();
libxml_clear_errors();
$previous = libxml_use_internal_errors(true);
$dom->loadHTML($data,LIBXML_NOWARNING );
$extentions = $dom->getElementsByTagName('extention');
 
$ext = array();
$tag = array();
//print_r( $extentions->item(0));
foreach ($extentions as $book) {

    $key =  $book->getAttribute('type');
	$par = $book->getAttribute('value');  
	$id = $book->getAttribute('id');
	
	$method = 'get'.ucfirst($key);
	
	 if (method_exists($this, $method))
    {
      // On appelle le setter.
     
	  $ext[]  =  $this->$method($par,  $this->cx);
	   
	   
	 $tag[]  = '<extention type	="'.$key.'" value="'.$par.'" id="'.$id.'" ></extention>';
	 
    //  print_r($book);
	 
	// $mm .=   ; 
	  
    }  
}

 

$tag[]  = '{URL}';
$ext[]  = $this::URL_BASE . 'themes/'.$this->tmp;


$tag[]  = '{lg}';
$ext[]  =  $this->lg;

$tag[]  = '{title}';
$ext[]  =  $this->title;

$tag[]  = '{page}';
$ext[]  =  $this->ispage;

$tag[]  =  '{base}';
$ext[]  =  $this->cfg->path ;
//echo $this->lg;

if ($this->lg=='Ar') { $meta = '<html dir="rtl" lang="ar"  xml:lang="ar">'; } else {$meta = '<html xmlns="http://www.w3.org/1999/xhtml">'; }

$tag[]  =  '{meta_ar}';
$ext[]  =  $meta ;

	
$this->body = str_replace ( $tag ,$ext , $data) ;




 
libxml_clear_errors();
libxml_use_internal_errors($previous);
 
 

}
public function getPages($id ) {

     $this->id = $id;
	 $db =  $this->cx->db ;
	 $db->emptyParams();
	 $db->resetSelect();
	 $db->addSelected('title', 'title');
	 $db->addSelected('alias', 'alias');
	 $db->addSelected('vedette', 'vedette');
	 $db->addSelected('id_langue', 'id_langue');
	 $db->addSelected('param', 'param');
	 $db->addSelected('ariane', 'ariane');	 	 
	 $db->addFrom('is_page');
	 $db->addWhere('id = :id');
 	 $db->addParamToBind('id', $id );  
	 
if (!$db->select()) { echo 'ERREUR: Pages '.$db->getErrMessage().'<br><br>'; }
        else { 
            
			 $result = $db->getNextRow() ;
			  foreach($result as $page) {
			 
			 print_r(' --- '.$page['param'].' ---');
			 $this->param = json_decode( $page['param']) ;
			 if ($page['vedette']) { $this->ispage =''; } else { $this->ispage ='_page';}
			  
			 $this->ariane = '<section id="ariane"><ol class="breadcrumb" dir="">
			                  <li><a href="index.php"><i class="fa fa-home"></i></a></li>'
							  .$page['ariane'].'</ol></section>';
			 $this->title = $page['title'];
			 
			 if (!empty($page['id_langue']) ) {$this->lg = $page['id_langue'] ; } else { $this->lg= 'Fr';}
			 
			 
}
}
 
 
}

public function getTitle($value) {

return '<div class="title_header container"><h1>'.$this->title.'</h1></div>';

}

public function getContent($id  ) {
$contenu = new contenu ;
$cont =$contenu->getPages( $this->id , $this->cx);


return $cont;
}


public function getModule($value) {

$mod  = new modules($this->cx,$value,$this->lg, $this->id);
$html = $mod->getControl();

return $html ;
}

public function getContenu() {
$url = 'themes/default/body.php';
$data = file_get_contents($url) ;
return $data ;
}

public function getMenu($value) {

include_once('modules/main-menu/main-menu.php');
$menu  = new  main_menu( $this->cx ,$value, 	 $this->lg ) ; 

$m = $menu->affiche(); 

return $m;

}
public function getStyle() { 

return '{Style}' ; 


}


public function getArabe () { 
$st ='';
if ($this->lg=='Ar') { $st =  '<link href="'.$this->param->style.'" rel="stylesheet" type="text/css" />
                               <link href="'.$this->param->style2.'" rel="stylesheet" type="text/css" />';}

return $st;
}

public function getAriane() {  

return $this->ariane;

} 

public function getSlide($value   ) {

if ( $this->param->slider) {

$s ="";
include_once('modules/slider/slider.php');
$slid = new Slider ;
$sl = $slid->getSlider($this->cx);


$this->style  .= $slid->style;	 
return '          <div class="slider_block"> '.$sl .'</div>' ;

  } else { return '';}

}



//is_currency

// Include

public function getInclude($value) {
//'themes/default/add.php'
//include_once($value); 
$inc = file_get_contents($value); 

return $inc;
}

public function getAdd($value) {

return $value;

}




//* fin class       'Bonjour'; // 
}




?>
