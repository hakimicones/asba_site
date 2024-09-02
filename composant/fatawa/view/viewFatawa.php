<?php 

class viewFatawa {
    public $rows ;
	public $lg;
	public $id;
	public $type;
	public $format;
	public $exper;
	
	public function __construct($rows, $obj,$cats)
		{


			 $this->rows	= $rows;
			 $this->cats	= $cats;
			 $this->lg		= $obj->lg; 
			 $this->id		= $obj->id; 
			 $this->type	= $obj->type;
			 $this->ariane 	= ''; 
			 $this->titre 	= '';
			 $this->c  = (isset($_POST['cat']))? $_POST['cat']:0;


			 
			 
		}
		
    public function display() { 

        $view = ($this->id!=1) ?   $this->displayFatawa() 
                               : '<div class="container">	
                               			<div class="alert alert-danger" role="alert">
										  Page Introuvable!
										</div>
								  </div>';
        return $view ;
    }

    public function displayFatawa() { 
	$li = '';
	$ty = 0;
	$cls = ' ';
	if ( $this->lg!='ar') { $dir ='direction="ltr"';  } else{  $dir ='direction="rtl"';} 
		
		$this->ariane = '{fatawa}';
		//print_r($this->rows );
		
		if ($this->rows!=0) {
		
		foreach ($this->rows  as $row )   { 
		
	 	
		$this->titre  = $row['lib_cat' ];
	     
		$li .= $this->getBlog($row);
	    $cls = ' ';		 
		 }		
		 
		 }
		$data  = 	'<section id="fatawa-blog"   style="margin-top: 20px;" '.$dir.'>';
		$data .=	'<div class="container  '.$cls.'">';
		$data .= $this->getMenuProduit('') ;
		
		$test = (!isset($_GET['ts'])) ? $this->lg.'/fatawa/list-'.$this->id.'-0-30.html' : 'index.php?option=fatawa&id='.$this->id.'&lg='.$this->lg.'&theme='.$_GET['theme'].'&src=30&num=0' ;
		 
		$link = (isset($_GET['theme'])) ? 'index.php?option=fatawa&id='.$this->id.'&lg='.$this->lg.'&theme='.$_GET['theme']  :  $this->lg.'/fatawa/list-'.$this->id.'-0-30.html' ;
		$data .=	
			  		'<form action="'.$link .'" method="post" id="form-search">'
					.$this->getSearchInput()
					.'
					<div class="fatawa-header"  >'.$this->titre.'</div>
					<ul class="blog" '.$dir.'>'.$li .'</ul></form>  ';
		  
			
		$data .=	 '</div></section>';
		$script = '
		<script>
		function cherche(e) {
		
		if ($(e).val()!="") {
		 $("#form-search").submit();
		}
		 
		
		}
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
		return $data.$script;
	
	} 
	
	
	/******************************/
	public function getSearchInput() { 
	
	 $lab = '<label class="col-xs-12 col-md-3 col-lg-2">{choisir fatawa}</label>';
	 $input = '<div  class="col-xs-12 col-md-5 col-lg-5">
	               <input type="text"  onBlur="cherche(this)" class="search_anim1 form-control " name="search" placeholder="{recherche}...">
			</div>';
	 
      /*
 $p =( $this->lg !="ar")?    $lab.$this->lg .$this->getListCat() . $input  :  $lab   .$this->getListCat(). $input ;

      */

	 $p =( $this->lg !="ar")?     $this->getListCat()    :  $lab   .$this->getListCat()  ;
	
	$html ='<div class="rech row">	 '.$p.' </div>' ;
	return $html;
	}
	/********************************************/
	
	
	function getListCat() {
	$se   = '<!-- ajout --><div id="slc" class="col-xs-12 col-md-3 col-lg-3">
	                          <select onchange="this.form.submit();" name="cat" id="cat" class=" form-control "  style="margin-right: 10px;" > ';	
	 
	
	$vil = $this->cats;
	 
	$i=0;
 	$se .=  '  <option  value="0"     >{categorie}</option>';
	foreach($vil as $el)  
	   {  
	   $sel = ($this->c != $el['id'])?"":"selected";
	  
	//$se .=  '  <option data-lg="'.$el['longit'].'" data-lt="'.$el['latit'].'"  '.$check.'   >'.$el['libelle_Fr'].'</option>';   
	$se .=  '  <option  value="'.$el['id'].'"  '.$sel.'   >'.$el['title'].'</option>';   
	   
	   
	  $i++; 
	   
	 } 		
			
			 
			$se .=  '</select></div><!-- ajout -->';
			 
			return $se ;

	
	
	}
	// Contenu 


	/********************************************************/
	
	
	public function getBlog($row) {
         
		$li = '';
	    $li .= '<li class = "  cadre"> ';
		$intro1 =   explode( '{reponse}' ,$row['full_text'] ) ; 
		$rep    =  (count($intro1)>1)?$intro1[1]:"";
 
		$li .='<div> <h3 class="fatawa-title"> '. $row['title' ] .' </h3>  '
		    
		    .$intro1[0].'</div>
			<div class="div-btn">
			<a class="btn btn-default btn-reponse" href="javascript:;" id="btn-'.$row['id'].'"  
			onclick="affDescription(\'pan-'.$row['id'].'\',\'btn-'.$row['id'].'\' )">  {reponse} <i class="fa fa-chevron-down" aria-hidden="true"></i> </a></div>'; 
	 
	 	$li .= 	 '<div class="pan-slide" id="pan-'.$row['id'].'">'.$rep  .'
		          '.
				  '<ul><li> {date_fatwa}'. $row['date' ] .'</li>'
		    .'    <li>  {num_fatwa}'. $row['num' ] .'</li></ul>'
				  .'<div style="padding-top:20px;" class="reduce">
				  <a href="javascript:;" id="btn-up-'.$row['id'].'"  onclick="cacheDescription( '.$row['id'] .' )"   class="btn btn-primary"  >
		            {reduire} <i class="fa fa-chevron-up" aria-hidden="true"></i></a></div> </div>   '
					 ;
	    $li .= '<li> ';
	   
    return $li ;
	  
    } 
	 public function getMenuProduit($row) {
	/*
		$url = 'composant/blog/view/tpl/form.php';
		$data = file_get_contents($url) ;
		 	
			
				 
	return $data  ;
	*/
	}
//Fin classe
}


?>
