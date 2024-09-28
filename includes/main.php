<?php 

include_once('includes/cfg.php');
include_once('includes/cms/modules.php');
include_once('composant/content/contenu.php');
include_once('includes/model/modelPage.php');
include_once('includes/Mobile_Detect.php');

class main {
    // Var 
	public $id;
	public $option;
	public $cx;
	public $cfg ;
	public $tmp;
	public $style;
	public $head = array() ;
	public $param;
	public $ispage;
	public $db;
	public $script;	

	public $script1;	
	public $title="";
	public $style_p;

	public $affTitle;
	public $canonical;
	public $affModal ;    // Si PopUP a l'ouverture
	// Const 

	
	 
	
public function conect() { 	$this->cx = new connect ;  	if ( $this->cx->con()) { $this->db = $this->cx->db ; return true ;} else { return false;}	}


   	
public function getOption()
{
    // Générer une clé de session si elle n'existe pas
    if (!isset($_SESSION['cle'])) {
        $_SESSION['cle'] = uniqid();
    }

    // Sécuriser la récupération de la variable 'option'
    $this->option = $this->getSafeInput('option', 'page');

    // Sécuriser la récupération de la variable 'task'
    $this->task = $this->getSafeInput('task', 'list');

    // Sécuriser la récupération de la variable 'lg'
    $this->lg = $this->getSafeInput('lg');

    // Sécuriser la récupération de la variable 'src'
    $this->src = $this->getSafeInput('src', 0);

    // Sécuriser la récupération de la variable 'id'
    $this->id = $this->getSafeInput('id');

    // Sécuriser la récupération de la variable 'test'
    $this->test = $this->getSafeInput('test', 0);

    // Initialiser l'objet Mobile_Detect
    $this->detect = new Mobile_Detect;
}

// Méthode pour sécuriser la récupération des paramètres
private function getSafeInput($key, $default = null)
{
    if (isset($_GET[$key])) {
        return htmlspecialchars($_GET[$key], ENT_QUOTES, 'UTF-8');
    } elseif (isset($_POST[$key])) {
        return htmlspecialchars($_POST[$key], ENT_QUOTES, 'UTF-8');
    } else {
        return $default;
    }
}

	
	
		
	public function getPages(  ) {
	
	if (!isset($_SESSION['ouvert'])) { $_SESSION['ouvert'] = true ; $this->session=0; $_SESSION['cle'] =  uniqid(); } else { $this->session= 1 ;}
	 
	 	$this->getOption();
		 if($this->conect()) {
			 $this->cfg = $this->cx->cfg;
			  
			 $this->tmp = $this->cfg->theme ;
			 if (isset($this->tmp)&& !empty($this->tmp) ) {  } else { $this->tmp = 'default';}
			  if(!isset($this->lg)) {  $this->lg =  $this->cfg->lg_def;  }
			  if ($this->lg ==  $this->cfg->lg_def)  {
			  if(!isset($this->id)   ) {  $this->id =  $this->cfg->pg_def;  } } else {
			  
			  if(!isset($this->id)   ) {  $this->id = 0;  }
			  
			  }
			   
			   
			   
			 $db =  $this->cx->db ;
			
		//*******	
			
			$m		= new modelPage($db);
			
			if ($this->id==0 && isset( $this->lg))  { $this->id = $m->getIdVedette($this->lg) ; }
			
			
			$page 	= $m->getPages($this->id);
			$cl 	= $m->addClick($this->id);
			
			$parent = $m->getParent($this->src);
			 
			
			$row 	= $this->getStat();
			$st 	= $m->insertStat($row);
			
			
			$this->alias = $page['alias'] ;
			 		 					 
			 if ($page['vedette']) { $this->ispage =''; $this->addPos = "_add";} else { $this->ispage ='_page'; $this->addPos = "";}
					  
			 $this->param = json_decode( $page['param']) ;


		  				 
		//  
			 if ($page['vedette']) { $this->ispage =''; $this->style_p='style="display:none;"';  $this->canonical = '<link rel="canonical" href="'.$this->lg.'/accueil.html" />'; } 
			 else { 



			 	$this->ispage ='_page'; 
			 
			     $this->style_p= (!empty($this->param->bg )) ?  'style="background: url('.$this->param->bg.') no-repeat  ;background-size:cover"' 
			                                                :   'style="display:none;"';}
			
			
			  if(!empty($this->ispage )) {
			 $ariane = (!empty($page['ariane'])) ?''.$page['ariane']:'';
			  
			 
			 $this->ariane = '<li><a href="index.php"><i class="fa fa-home"></i></a></li>'.$ariane ;} 
			 else  { $this->ariane="<br>";}
			 
			  
			
			 if(!empty($this->ispage )) {
			 if (isset( $parent['title'])) {
			 $par =  '<li><a href="'.$parent['link'].'">'.$parent['title']."</li></a>";
			 
			 
			 } 
			 else  {$par =""; }
			 
			 if ($this->option== 'page')  $ariane = (!empty($page['ariane'])) ?$page['ariane']:"<li> ".$page['title']."</li>";
			 
			 
					 $this->ariane = '<li><a href="index.php"><i class="fa fa-home"></i></a></li>'.$par
									  . $ariane;
									  
									  
									  
									  } else  { $this->ariane=" <br>";}
					 //Ajouter les cliques
					 
			 
			
			$this->title =	  $page['title']  ;
					  	
			if (isset($this->param->volet1) &&$this->param->volet1) {   } else {$this->affTitle =   'style="display:none"' ;  }
		 
			if ( isset($this->param->volet2) && $this->param->volet2!='false') { 	


			 
			$lh_pop = explode(";",	$this->param->style ) ;



			$pophome = (!$this->session) ? '/**'.$this->session.'**/' :  "
                
				$('#pop-home ').css('display','block');
				 //".gettype($this->param->volet2)."
				$('#wrapper ').css('opacity','0');
			 	//$('#wrapper ').css('display','none');

			 	$('#extra ').css('display','none');
				
				var w = window.innerWidth;
				var h = window.innerHeight;
				$('#pop-home ').css('width',w);
				$('#pop-home ').css('height',h);

				if(window.matchMedia('(max-width:640px)').matches) {

						$('#pop-home ').css('background',' url(".$this->param->style3.")').css('background-size','contain').css('background-color','#fff').css('background-position','center').css('position','fixed').css('top','0');



					} else {
						 
			 	$('#wrapper ').css('opacity','0');
			 	//$('#wrapper ').css('display','none');
			 	$('#extra ').css('display','none');
				$('#pop-home ').css('background','url(".$this->param->style2.")').css('background-size','contain').css('background-color','#fff').css('position','fixed').css('top','0');; 

				$(document).ready(function () { });
				// ".$this->param->style2."
				
				}
				";


				
				
				$this->script1  .=  (!empty($this->ispage )) ?  "
				if(window.matchMedia('(max-width:640px)').matches) {/*rien*/} else {
				\$(document).ready(function () {  setTimeout(  lanceModal , ".$this->param->temps.");     });
				function lanceModal() {\$('#PopUPModal').modal('show');}  
				}
				\$('#PopUPModal .modal-dialog ').css('width','".$this->param->style."');
				\$('#PopUPModal  .modal-content').css('height','".$this->param->taille."');
				\$('#PopUPModal  .modal-content').css('background',' url(".$this->param->style2.")').css('background-size','contain').css('background-color','#fff');
				 
				//".$this->param->volet2 :$pophome  ; 


			//	print_r('<code>'.$pophome.'</code>');
				$this->affModal = $this->getPopup(); }
			  		  
		  $this->meta_desc 	= $page['meta_desc'];
		  $this->keyword    = $page['keyword'];
	   }
 		 if ($this->cfg->offline && !$this->test) { $this->getOffLine() ; }   else 	{ $this->getDataHtml(  ); }
		 $this->getBody();
 
	}	
		
	//******************************
	
	private function getPopup() {
	$modal  = '<div class="modal fade" id="PopUPModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' ;
	$modal .= '<div class="modal-dialog"><div class="modal-content modal-popup"><extention type	="module" value="popup" id="2" ></extention></div></div></div>';
	
	return $modal;
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

		$tag[]  = '{addPos}';
		$ext[]  = $this->addPos;


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
		$ext[]  =  'themes/'.$this->tmp;
		//.$this::URL_BASE 
		
		$tag[]  = '{lg}';
		$ext[]  =  $this->lg;


		$rtl = ($this->lg=='ar') ? 'rtl' : 'ltr';
		$tag[]  = '{rtl}';
		$ext[]  =  $rtl;
		
		$idrech = ($this->lg=='ar') ? 306 : 307;		
		$tag[]  = '{idrech}';
		$ext[]  =  $idrech;
		
		$tag[]  = '{title}';
		$ext[]  =  $this->title;
		
		$tag[]  = '{page}';
		$ext[]  =  $this->ispage;


		$tag[]  = '{addPos}';
		$ext[]  = $this->addPos;
		
		$tag[]  = '{style1}';
		$ext[]  =  $this->style_p;
		
		$tag[]  =  '{base}';
		$ext[]  =  $this->cfg->url ;
 

 		$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		
		$tag[]  =  '{ceURL}';
		$ext[]  =  "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 

		$tag[]  = '{adr}';
		$ext[]  = $actual_link ;


 
		if (strtolower($this->lg)=='ar') { $meta = '<html dir="rtl" lang="ar"  xml:lang="ar">'; } else {$meta = '<html xmlns="http://www.w3.org/1999/xhtml">'; }
		
		$tag[]  =  '{meta_ar}';
		$ext[]  =  $meta ;
		
		
		$tag[]  =  '{meta_desc}';
		$ext[]  =   $this->meta_desc;
		
		$tag[]  =  '{keyword}';
		$ext[]  =   $this->keyword;
		 
		
		$tag[]  =  '{script}';
		$ext[]  =  $this->setScript() ;
		
		
		$tag[]  =  '{canonical}';
		$ext[]  =  $this->canonical;

		//$tag[]  =  '{popup}';
		//$ext[]  =  $this->affModal ; 

		
		$tag[]  =  '{alias}';
		$ext[]  =  (!empty($this->alias)) ? 'id="'.$this->alias.'"' : '' ; 


		
		$tag[]  =  '{mob}';
		$ext[]  =   ($this->detect->isMobile()) ? 'is_mob':'' ;
		
		
			
		$html = str_replace ( $tag ,$ext , $data) ;
		
		$this->body = $html ; 
		
		 
		
		
		
		 
		libxml_clear_errors();
		libxml_use_internal_errors($previous);
		 
		 
	
	}	
	
	
	public function setScript() {  

        
		return  '<script type="text/javascript">'.$this->script.'
  /**************/
			'.$this->script1.'
		</script> '   ;}



	public function getContent($id  ) {
		if ($this->option!= 'page')  {
		
		include_once('composant/'.$this->option.'/'.$this->option.'.php');
		$maclasse 	=  str_replace('-','_',$this->option);
		$monobjet 	= new $maclasse($this);
		$cont 		= $monobjet->display();
		
		} else 
		{
		$v = (empty($this->ispage))?false:true;
		$contenu = new contenu ;
		$cont =$contenu->getPages( $this->id , $this->cx , $this->ariane ,$v ) ; 
		}
		
		$data 			= $cont->data; 
		if (isset( $cont->bg) ){ $this->style_p	=  $this->style_p='style="background: url('.$cont->bg.') no-repeat  ;background-size:cover"';} 
		
		$this->ariane 	=  $cont->ariane  ;
		$this->title	= (isset($cont->titre) && !empty($cont->titre) )?$cont->titre :$this->title ;
		return $data;
		
		
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
		
		$tag[]  = '{ariane}';
		$ext[]  = $this->getArianeFin();

	//	echo count($btn);
		
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
	
	public function getContenu() {
	//$this::URL_BASE .

		$this->tmp =    $this->tmp ;


		if (isset($_GET['theme'])) {
           
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);


		}

		$url =  'themes/'.$this->tmp.'/body.php';
		$data = file_get_contents($url) ;
		
		return $data ;
	}
	
	public function getOffLine() {
	//$this::URL_BASE .
		$url =  'themes/'.$this->tmp.'/off.php';
		$data = file_get_contents($url) ;
		
		$this->body = $data ;
	}
	
	public function getBody() {
	
	// Remplacer Style
	$tag[] = '{Style}' ;
	$ext[] = '<style>'.$this->style.'</style>';
	
	
	$html = str_replace($tag , $ext , $this->body ) ;
	
	
	//Remplacer Script


	


	
	/***************************/
	//ob_clean();
	 echo $this->varTrad($html) ;
	 
	
	}
//extentions

	public function getMenu($value) {
	
		include_once('modules/main-menu/main-menu.php');
		$menu  = new  main_menu( $this->cx ,$value, 	 $this->lg ) ; 
		
		$m = $menu->affiche(); 
		
		return $m;
	
	}
	public function getAriane() {	return '{ariane}';	} 
	public function getArianeFin() {	return '<section id="ariane"><ol class="breadcrumb container" dir=""> '.$this->ariane.'</ol></section>';	} 
	
	public function getArabe () { 
		$st ='';
		
		if (isset($this->lg) && strtolower($this->lg)=='ar') {
		$st =  '<link href="'. 'themes/'.$this->tmp.'/fonts_ar/arabe.css" rel="stylesheet" type="text/css" /> '
			  .'<link href="'. 'themes/'.$this->tmp.'/css/style_ar.css" rel="stylesheet" type="text/css" /> '
		      ." ";}
		
		return $st;
		}
		
		
	public function getTitle($value) {
	
	//$tit = ($this->option== 'page')?'<div class="title_header container"  '.$this->affTitle.'><h1>'.$this->title.'</h1></div>':'';
	$tit =  '<div class="title_header container"  '.$this->affTitle.'><h1>'.$this->title.'</h1></div>' ;
	
	return $tit;}
	
	public function getModule($value) {
	
        if (!isset($this->lg)  ) {$this->lg = $this->cfg->lg_def;}
		$mod  = new modules($this->cx,$value,$this->lg, $this->id);
		$d    = $mod->getControl();
		
		$this->script .= $d->script;
		
		return $d->html ;
		
	}	
	
	public function getSlide($value   ) {
	
			if ( isset($this->param->slider) && $this->param->slider ) {
		
		
			$s ="";
			include_once('modules/slider/slider.php');
			$slid = new Slider ;
			$sl = $slid->getSlider($this->cx,$this->lg );
			
			
			$this->style  .= $slid->style;	 
			return '          <div class="slider_block"> '.$sl .'</div>' ;
	
	  	} else { return '';}
	
	}
	
	public function getStyle() {  return '{Style}' ;  }
	public function setHead($h) {   $this->head  =  array($h) ; }
	public function getHead() {

			$h = $this->head ;
			$hh = '<!-- css-->';
			foreach ( $h as $li_head ) {
			$hh .= $li_head;

		}
		return $hh;

	}
	
	// Statistiques 
	public function getStat() {
	
	   $obj = new stdClass;
			// r�cup�ration de l'heure courante
		$obj->date = date("Y-m-d H:i:s");
		
		// r�cup�ration de l'adresse IP du client (on cherche d'abord � savoir si il est derri�re un proxy)
		if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		  $obj->ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		elseif(isset($_SERVER['HTTP_CLIENT_IP'])) {
		  $obj->ip  = $_SERVER['HTTP_CLIENT_IP'];
		}
		else {
		  $obj->ip = $_SERVER['REMOTE_ADDR'];
		}
		// r�cup�ration du domaine du client
		$obj->host = gethostbyaddr($obj->ip);
		
		// r�cup�ration du navigateur et de l'OS du client
		$obj->navigateur = $_SERVER['HTTP_USER_AGENT'];
		
		// r�cup�ration du REFERER
		if (isset($_SERVER['HTTP_REFERER'])) {
			if (preg_match("/".$_SERVER['HTTP_HOST']."/", $_SERVER['HTTP_REFERER'])) {
			$obj->referer ='';
			}
			else {
			$obj->referer = $_SERVER['HTTP_REFERER'];
			}
		}
		else {
		  $obj->referer ='';
		}
		
		// récupération du nom de la page courante ainsi que ses arguments
		if ($_SERVER['QUERY_STRING'] == "") {
		  $obj->page = $_SERVER['PHP_SELF'];
		}
		else {
		  $obj->page = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
		}
		
		 
		 
		
		return $obj;
	
	}


}
?>