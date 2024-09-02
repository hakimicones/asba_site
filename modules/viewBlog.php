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
			 $this->detect  = $obj->detect;
			  
		}
		
    public function display() { 
	$li = '';
	$ty = 0;
	$cls = ' ';
	$script = ' ';
	
	if ( $this->lg!='ar') { $dir ='direction="ltr"';  } else{  $dir ='direction="rtl"';} 
	
		//print_r($this->rows );
		foreach ($this->rows  as $row )   { 
		
		$this->ariane 		= $row['lib_cat' ];
		$this->titre  		= $row['lib_cat' ];
		$this->aff_titre 	= $row['aff_titre' ];
	    switch($row['type'] ) {
		
		case 1 :
		$li .= $this->getBlog($row);
	    $cls = ' my-blog';
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
		 
		$myId = (!$this->detect->isMobile()) ? 'blog' :'blog_mob';
		$data  = 	'<section id="'.$myId .'"   style="margin-top: 20px;'.$dir.'">';
		
		
		$data .=	'<div class="container  '.$cls.'">';
		$data .= ($this->aff_titre) ?  '<h3 class="Blog-title" align="center">'.$this->titre.'</h3>': '' ;
		
		if ( $ty !=3) {
		
		$data .=	
			  		'<form action="'.$this->lg.'/blog/list-'.$this->id.'-'.$row['id_blog'].'.html" method="post">'
					.$this->getSearchInput()
					.'<ul class="blog my-blog"  '.$dir.' >'.$li .'</ul></form>  ';
		} else {
		
		$data .= $this->getTabs() ;
		
		}	
			
		$data .=	 '</div></section>'.$script;
		return $data;
	
	} 
	
	
	/******************************/
	public function getSearchInput() { 
		/*
	$html 		= '<div ><input type="text"  onBlur="cherche(this)" class="search_anim" name="search" placeholder="{recherche}..."></div>' ;
	$script 	= '
	<script>
		function cherche(e) {		
			if ($(e).val()!="") {	 $("#form-search").submit();		}		
		}
	</script>'; 
	return $html.$script;
	*/
	}
	
	// Contenu 
	public function getTabs() {
	$i=0;
	 	
			$menu =  (!$this->detect->isMobile()) ? '<ul id="tabs-menu" class="nav nav-tabs">' : '' ;
			$cont = (!$this->detect->isMobile()) ? '<div class="tab-content">' : '<div id="accordion">';
			
			$acti = ''; 
			$show = 'show'; 
			foreach ($this->rows  as $row )   { 
			$i++;
			
			if (empty($acti)) {$css = 'active' ; $acti = "1";} else { $css = '';};
			$menu .= (!$this->detect->isMobile()) ? '<li class="nav-item "><a class="nav-link '.$css .'"  data-toggle="tab" href="#tab'.$row['id' ].'">'.$row['libelle'].'</a></li>' 
			                                     : '';
			$cont .= (!$this->detect->isMobile()) ? '<div id="tab'.$row['id' ].'" class="tab-pane     '.$css .'">'.$row['intro_text'  ].'</div>' 
			                                     : '
												 <div class="card">
													<div class="card-header" id="heading'.$i.'">
													  <h5 class="mb-0">
														<button class="btn btn-link" data-toggle="collapse" data-target="#collapse'.$i.'" aria-expanded="true" aria-controls="collapseOne">
														 '.$row['libelle'].'
														</button>
													  </h5>
													</div>
												
													<div id="collapse'.$i.'" class="collapse '.$show.'" aria-labelledby="heading'.$i.'" data-parent="#accordion">
													  <div class="card-body card-vert">
														 '.$row['intro_text'  ].'
													  </div>
													</div>
												  </div>
												 
												 ';
			 $show = ''; 
			 $this->ariane = $row['lib_cat' ];
		 
			}
			  $cont .= '</div>';
			  $menu .= ($this->detect->isMobile()) ? '</ul>' : '';
			  
			  
			  
			  
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
	 $li .= '<li class="cadre"> ';
		
		$li .=	'<div class="col-sm-12 question"> <a href="javascript:affDescription(\'pan-'.$row['id'].'\',\'btn-'.$row['id'].'\' )" > '
					 . $row['libelle' ] .'    </a></div>'   ;
					  
		
		
		$li .= 	 '<div class="pan-slide" id="pan-'.$row['id'].'">'.$row['intro_text'  ]  .'
		          <div style="padding-top:20px;" class="reduce">
				     <a href="javascript:;" id="btn-up-'.$row['id'].'"  onclick="cacheDescription( '.$row['id'] .' )"   class="btn btn-primary"  >
		            {reduire} <i class="fa fa-chevron-up" aria-hidden="true"></i></a></div> </div>   ';

			
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
