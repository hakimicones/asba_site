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
		$data  = 	'<section id="blog"   style="margin-top: 20px;'.$dir.'">';
		$data .=	'<div class="container  '.$cls.'">';
		$data .= $this->getMenuProduit('') ;
		 
		
		$data .=	
			  		'<form action="'.$this->lg.'/fatawa/list-'.$this->id.'-0-30.html" method="post">'
					.$this->getSearchInput()
					.'<ul class="blog" style="'.$dir.'">'.$li .'</ul></form>  ';
		  
			
		$data .=	 '</div></section>';
		return $data;
	
	} 
	
	
	/******************************/
	public function getSearchInput() { 
	 $p =( $this->lg =="ar")? "left 8px;":'right 8px'; 
	
	$html = '<div class="rech"><input type="text" style="background-position:'.$p.'" onBlur="this.form.submit();" class="search_anim1 col-sm-6" name="search" placeholder="{recherche}..."> '.$this->getListCat().' </div>' ;
	return $html;
	}
	/********************************************/
	
	
	function getListCat() {
	$se   = '<!-- ajout --><div id="slc"><select onchange="this.form.submit();" name="cat" id="cat" class="selectpicker1 col-sm-4" data-live-search="true" > ';	
	 
	
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
 
		$li .='<div> <h3> '. $row['title' ] .' </h3>  '
		    .'<ul><li> {date_fatwa}'. $row['date' ] .'</li>'
		    .'    <li>  {num_fatwa}'. $row['num' ] .'</li></ul>'
		    .$intro1[0].'</div><a class="btn btn-default" href="javascript:;" id="btn-'.$row['id'].'"  
			onclick="affDescription(\'pan-'.$row['id'].'\',\'btn-'.$row['id'].'\' )">  {reponse} </a>'; 
	 
	 	$li .= 	 '<div class="pan-slide" id="pan-'.$row['id'].'">'.$rep  .'
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
