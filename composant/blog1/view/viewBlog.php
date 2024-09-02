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
	    $cls = ' ';
		
		break;
		case 2 :
		
		 $li .= $this->getFaq($row);
		 $cls = '  cadre';	
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
					.'<ul class="blog" style="'.$dir.'">'.$li .'</ul></form>  ';
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
	$menu .= '<li class="nav-item '.$css .'"><a class="a-tab"  data-toggle="tab" href="#tab'.$row['id' ].'">'.$row['libelle'].'</a></li>';
    $cont .= '<div id="nav-itemtab'.$row['id' ].'" class="tab-pane   '.$css .'">'.$row['intro_text'  ].'</div>';
	
	 $this->ariane = $row['lib_cat' ];
 
    }
	  $cont .= '</div>';
	  $menu .= '</ul>';
	  
	  $script='<script> if(window.matchMedia("(max-width:360px)").matches)  {   $("#tabs-menu").removeClass("nav-tabs").addClass("nav-pills nav-justified"); } </script>';
	
	return $menu.$cont.$script;
	
	}
	
	/********************************************************/
	public function getFaq($row) { 
	$li = '';
	 $li .= '<li> ';
		
		$li .=	'<div class="col-sm-12 question"> <a href="javascript:" onclick="affDescription(\'pan-'.$row['id'].'\',\'btn-'.$row['id'].'\' )"> '
					 . $row['libelle' ] .'    </a></div>'   ;
					  
		
		
		$li .= 	 '<div class="pan-slide" id="pan-'.$row['id'].'">'.$row['intro_text'  ]  .'
		          <div style="padding-top:20px;"><a href="javascript:;" id="btn-up-'.$row['id'].'"  onclick="cacheDescription( '.$row['id'] .' )"   class="btn btn-primary"  >
		            {reduire} <i class="fa fa-arrow-up" aria-hidden="true"></i></a></div> </div>   ';

			
		 $li .= '</li>';
		  $this->ariane =  $row['lib_cat' ];
		 
		 return $li ;		
	
	}
	public function getBlog($row) {
         
		$li = '';
	    $li .= '<li class = "  cadre"> ';
		$intro1 =   explode( $row['sep'] ,$row['intro_text'] ) ; // $this->Strip_text(, 260, "");
		$txt    =   (isset($intro1[1]) )?$intro1[1] :"";
	 
		$li .='<div> <h3> '. $row['libelle' ] .'</h3>'
		    .$intro1[0].'</div><a class="btn btn-default" href="javascript:;" id="btn-'.$row['id'].'"  
			onclick="affDescription(\'pan-'.$row['id'].'\',\'btn-'.$row['id'].'\' )">  '.$row['sep'].' </a>'; 
	 
	 	$li .= 	 '<div class="pan-slide" id="pan-'.$row['id'].'">'.$txt  .'
		          <div style="padding-top:20px;"><a href="javascript:;" id="btn-up-'.$row['id'].'"  onclick="cacheDescription( '.$row['id'] .' )"   class="btn btn-primary"  >
		            {reduire} <i class="fa fa-arrow-up" aria-hidden="true"></i></a></div> </div>   ';
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
