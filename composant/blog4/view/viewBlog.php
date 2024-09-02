<?php 

class viewBlog {
    public $rows ;
	public $lg;
	public $id;
	public $type;
	public $format;
	public $exper;
	
	public function __construct($rows, $obj)
		{
			 $this->rows	= $rows;
			 $this->lg		= $obj->lg; 
			 $this->id		= $obj->id; 
			 $this->type	= $obj->type;
			  
		}
		
    public function display() { 
	$li = '';
	$ty = 0;
	$cls = ' ';
	
	if ( $this->lg!='ar') { $dir ='direction="ltr"';  } else{  $dir ='direction="rtl"';} 
	
		//print_r($this->rows );
		foreach ($this->rows  as $row )   { 
		
		$this->ariane = $row['lib_cat' ];
		$this->titre  = $row['lib_cat' ];
	    switch($row['type'] ) {
		
		case 1 :
		$li .= $this->getBlog($row);
	    $cls = ' my-blog';
		
		break;
		case 2 :
		
		 $li .= $this->getFaq($row);
		 $cls = '  cadre faq';	
		 break;
		case 3 :
		$ty = 3;
		 $cls = ' ';
		break;
	 	}
		

		 
		 }		
		 
		
		$data  = 	'<section id="blog"   style="margin-top: 20px;'.$dir.'">';
		$data .=	'<div class="container  '.$cls.'">';
		$data .= $this->getMenuProduit('') ;
		if ( $ty !=3) {
		
		$data .=	
			  		'<form action="'.$this->lg.'/blog/list-'.$this->id.'-'.$row['id_blog'].'.html" method="post">'
					.$this->getSearchInput()
					.'<ul class="blog"  '.$dir.' >'.$li .'</ul></form>  ';
		} else {
		
		$data .= $this->getTabs() ;
		
		}	
			
		$data .=	 '</div></section>';
		return $data;
	
	} 
	
	
	/******************************/
	public function getSearchInput() { 
	$html = '<div ><input type="text"  onBlur="this.form.submit();" class="search_anim" name="search" placeholder="{recherche}..."></div>' ;
	return $html;
	}
	
	// Contenu 
	public function getTabs() {
	
	
	$menu = '<ul id="tabs-menu" class="nav nav-tabs">';
	$cont = '<div class="tab-content">';
	$acti = ''; 
	foreach ($this->rows  as $row )   { 
	
	if (empty($acti)) {$css = 'active' ; $acti = "1";} else { $css = '';};
	$menu .= '<li class="nav-item "><a class="nav-link '.$css .'"  data-toggle="tab" href="#tab'.$row['id' ].'">'.$row['libelle'].'</a></li>';
    $cont .= '<div id="tab'.$row['id' ].'" class="tab-pane     '.$css .'">'.$row['intro_text'  ].'</div>';
	
	 $this->ariane = $row['lib_cat' ];
 
    }
	  $cont .= '</div>';
	  $menu .= '</ul>';
	  
	  $script='<script> if(window.matchMedia("(max-width:360px)").matches)  {   $("#tabs-menu").removeClass("nav-tabs").addClass("nav-pills nav-justified"); } </script>';
	
	return $menu.$cont.$script;
	
	}
	
	/********************************************************/
	public function getFaq($row) { 

		$script = '
		<script>
		function affDescription(elem, btn ) {
			$( "#"+elem ).slideDown( "slow", function() {
			$( "#"+btn ).css({"display":"none"});
		});}
		function cacheDescription(elem  ) {
 
			$( "#pan-"+elem ).slideUp( "slow", function() {
			$( "#btn-"+elem ).fadeOut(300).css({"display":"inline-block"});
		});}
		</script>
		';
	$li = '';
	 $li .= '<li> ';
		
		$li .=	'<div class="col-sm-12 question"> <a href="javascript:" onclick="affDescription(\'pan-'.$row['id'].'\',\'btn-'.$row['id'].'\' )"> '
					 . $row['libelle' ] .'    </a></div>'   ;
					  
		
		
		$li .= 	 '<div class="pan-slide" id="pan-'.$row['id'].'">'.$row['intro_text'  ]  .'
		          <div style="padding-top:20px;"><a href="javascript:;" id="btn-up-'.$row['id'].'"  onclick="cacheDescription( '.$row['id'] .' )"   class="btn btn-primary"  >
		            {reduire} <i class="fa fa-arrow-up" aria-hidden="true"></i></a></div> </div>   ';

			
		 $li .= '</li>';
		  $this->ariane =  $row['lib_cat' ];
		 
		 return $li.$script ;		
	
	}
	public function getBlog($row) {
         
		$li = '';
	    $li .= '<li class = "  cadre"> ';
		$intro1 =   explode( $row['sep'] ,$row['intro_text'] ) ; // $this->Strip_text(, 260, "");
		$txt    =   (isset($intro1[1]) )?$intro1[1] :"";
	 
		$li .='<div class="b-div"> <h3 class="b-title"> '. $row['libelle' ] .'</h3>'
		    .$intro1[0].'</div><div class="div-btn"><a class="btn btn-default btn-reponse" href="javascript:;" id="btn-'.$row['id'].'"  
			onclick="affDescription(\'pan-'.$row['id'].'\',\'btn-'.$row['id'].'\' )">  '.$row['sep'].' <i class="fa fa-chevron-down" aria-hidden="true"></i></a></div>'; 
	 
	 	$li .= 	 '<div class="pan-slide" id="pan-'.$row['id'].'">'.$txt  .'
		          <div style="padding-top:20px;"><a href="javascript:;" id="btn-up-'.$row['id'].'"  onclick="cacheDescription( '.$row['id'] .' )"   class="btn btn-primary"  >
		            {reduire} <i class="fa fa-chevron-up" aria-hidden="true"></i></a></div> </div> ';
	    $li .= '<li> ';
	   
    return $li ;
	  
    } 
	 public function getMenuProduit($row) {
	
		$url = 'composant/blog/view/tpl/form.php';
		$data = file_get_contents($url) ;
		 	
			
				 
	return $data  ;
	}
//Fin classe
}


?>
