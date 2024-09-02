<?php 
 require_once ("includes/Mobile_Detect.php");

class  news_carous {
	public  $cx ;
	private $obj ;
	public $li ;
	public $lg;
	public $script ;
public function __construct($c,$obj,$lg)
	{
	 $this->cx  = $c; 
	 $this->obj = $obj ;
	 $this->lg = $lg;

	  $this->detect 		= new Mobile_Detect;

	}
public function affiche() { 

	$url  = 'modules/news-carous/tpl.html';
	$data = file_get_contents($url) ; 

	$html =$this->getData() ;

	$tag[]  =  '{news}';
	$ext[]  =  $html->items ;
		
	$tag[]  =  '{my-styles}';
	$ext[]  =  $html->styles ;

	
	$tag[]  =  '{titre}';
	$ext[]  =   $this->obj->param->titre ;
	  
	 $html = str_replace ( $tag ,$ext , $data) ;
	 
	 
	return $html;


}
private function getData() {

	$db =  $this->cx->db ;
	$db->resetSelect();

	$db->addSelected('*', '');  
	$db->addFrom('is_news ');   
	$db->addWhere('publier = 1'); 
	$db->addWhere('id_langue = :id_langue ' ); 
	$db->addParamToBind('id_langue'  ,$this->lg );
  
  	$db->addOrderBy('date DESC');
 
 
  	if (!$db->select()){ echo 'ERREUR: NEWS  '.$db->getErrMessage().'<br><br>'; }
        else {   
 //echo $db->q; 
		 
		$dc = 0;  
		$result = $db->getAllRows();  
		$ul = '';

		foreach($result as $row) :
           

			$txt =  $this->getWords(strip_tags($row['full_text']), 10 )  ;

			$img = (file_exists($row['image'])) ? $row['image'] : 'images/news-vide.jpg';

			$text  =  $txt->text ;
			$point =  $txt->point ;

			$ul .= '
			 <!-- Item-->
			<div class="item">
				<div class="card pad15">
					<img class="card-img-top" src="'.$img.'" alt="'.$row['title'].'">
						<div class="card-body">
						<p> '.$row['title'].' </p>
						<a href="#">'.$this->obj->param->plus.'.</a>
						</div>
			   </div>
			</div>
			 <!-- fin  item-->
			';

		endforeach;	
		 
  
  
 
  
		$data = new stdClass ;
		$data->items = $ul ;
		$data->styles =   ''   ;
		return $data ;
 
}
}

function getWords($txt,$nb) {

	$words = explode(' ', $txt);
	$pairs = [];

	$nn = (count($words)>$nb ) ? $nb : (count($words)-1) ;
	$po = (count($words)>$nb ) ? '...' : '' ;
	
	for ($x = 0; $x <  $nn ; $x++) {
		$pairs[$x] = $words[$x];
	}
	

	$data = new stdClass ;
	$data->text = implode(' ',$pairs);
	$data->point = $po;
    return $data;

}


// Fin Class 
}
?>