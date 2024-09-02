<?php 
class slide_video { 
	public $obj ;
	public $cx ;
	public $script ;
public function __construct($c,$o,$lg)
	{
	 $this->cx = $c; 
	 $this->obj = $o ;
	 $this->lg = $lg;
 
	 $this->detect 		= new Mobile_Detect;
	  
	}

public function affiche() {

	$url  = 'modules/slide-video/tpl/tpl.php';
	$data = file_get_contents($url) ; 

	$html =$this->getData() ;

	$tag[]  =  '{videos}';
	$ext[]  =  $html->items ;

		
		
	$tag[]  =  '{my-styles}';
	$ext[]  =  $html->styles ;
	  
	 $html = str_replace ( $tag ,$ext , $data) ;
	 
	 
	return $html;
 
}

function getArticle() {

	$articles = array();
	$textes = array();

	for ($x = 1; $x <= 4; $x++) {
        $art = 'article'.$x ;
		if ($this->obj->param->$art) $articles[] = $this->obj->param->$art ;

	}
   
    $sql = 'SELECT * FROM `is_contenu` WHERE id in ('.implode(',',$articles).')';

 
		$db =  $this->cx->db ;
                $db->resetSelect();
		 

		if (!$db->select($sql)){ 		
			echo 'ERREUR->SLIDER VIDEO : '.$db->getErrMessage().'<br> <br>';  return "";}
		else { 
			 $rows =   $db->getAllRows(); }
		
		 
			 $i = 0 ;
			 foreach($rows as $row ) :
				$i++;
                $textes[$row['id']] =  $row['intro_text'];
				
			 endforeach;



return $textes ;
 



 
}



public function getData(){

	$styles = array();
	$active = 'active';
	$ul = '';

	$articles = $this->getArticle();

	 
	 

	for ($x = 1; $x <= 4; $x++) {
        $video = 'video'.$x ;
 

        if ( !empty($this->obj->param->$video ) ) {		
		
			$bg = 'image'.$x ;
            $id = 'article'.$x ;

			$styles  = '#video-inner  { background: url('.$this->obj->param->$bg.');}'  ;
		 
		$ul .= '  <!-- debut Slide  '.$x.'-->
		<div class="carousel-item item'.$x.'  '.$active.'"  data-img="'.$this->obj->param->$bg.'" >
			<div class="container">
				<div class="row">
					<div class="info col col-xl-5">
					

							'. ((isset($articles[$this->obj->param->$id])) ? $articles[$this->obj->param->$id]: '' ). '

					</div>
					
					<div class="info col col-xl-7">
						<a href="javascript:" data-url="https://www.youtube.com/embed/'.$this->obj->param->$video.'" class="stm_video_url stm_fancy-iframe"></a>
				
					</div>
				</div>	
			</div>
	   </div>

	   <!-- Fin Slide -->
	   ';
      
	   $active = '';


	}
	  }
   
    $data = new stdClass ;
	$data->items = $ul ;
	$data->styles =   $styles   ;
	return $data ;


}





}

?>
