<?php 

class viewNews {
    public $rows ;
	public $lg;
	public $id;
	public $type;
	public $format;
	public $exper;
	public $rtl='ltr';
	public $liens;
	public $page_id;
	public $desc;

	public function __construct($rows, $obj)
		{    
		  
			 $this->rows	= $rows;
			 $this->lg		= $obj->lg; 
			 $this->id		= $obj->id; 
			 $this->liens	= $obj->liens; 
			 $this->page_id	= $obj->page_id;
			 $this->desc	= $obj->desc;
			 
			 if ( $this->lg!='ar') { $this->rtl = "rtl" ;}
			
		}
		
    public function display() { 
	$modal = '';
	$li = 	'<section id="agences"   style="margin-top: 20px;">'
			.'<div class="container"><form action="ar/news/liste-'.$this->page_id.'-0.html" method="post">'
			.$this->getSearchInput()
			.'<ul class="agences">';
		
		foreach ($this->rows  as $row )   {  
	 
		$li .= '<li class="cadre">
		        <div class="row">';
		 
		
		$li .=	 '<h3> <a href="ar/news/detail-'.$this->page_id.'-'.$row['id'].'.html"> '
					 . $row['title'] .'</h3> ';  
		 
		$li .=   '<p>'. $row['full_text'].'</p>'; 
	 	 
		 
	 	}
		
		
		$li .= '</ul></form></div> </section>';
		 
		return $li;
	
	}
	
	
	
	 
	
	
	 
	 
	
 
	
	/******************************/
	public function getSearchInput() { 
	$html = '<div ><input type="text"  onBlur="this.form.submit();" class="search_anim" name="search" placeholder="{recherche}..."></div>' ;
	return $html;
	} 
	
	//************ Details **********************/
	public function getDetail() { 
		 
		
		$html  = '<section id="news-'. $this->rows['id'].'" class=""  ><div class="container contenu cadre">  '  ;
		$html .= ' <h3>  '. $this->rows['title'].' </h3> ';
		$html .= ' <div class="">  '. $this->rows['full_text'].' </div > ';
		 
		
		 
		$html .=  '</div></section>';
	 	return  $html ;
	}
	
	
	
	
	//Fin classe
}
?>
