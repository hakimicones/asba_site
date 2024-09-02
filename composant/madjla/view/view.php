<?php 
include_once('includes/sendmail.php');
class viewMadjla {
    public $rows ;
	public $lg;
	public $id;
	public $type;
	public $format;
	public $exper;
	public function __construct(  $obj)
		{
			 
			 $this->lg		= $obj->lg; 
			 $this->id		= $obj->id; 
			 $this->article	= $obj->article   ;

            
			 
			 
		}
		
    public function display() { 
	 
	$li = 	'';
		
		 $url = 'composant/madjla/view/tpl/form.php';
	$f = file_get_contents($url) ;

	$tr= '';

       $art = explode('{reduire}',$this->article->data) ;
       if (count($art )>1) {
		  	$article = '<div> '.$art[0].'</div><a href="javascript:;" id="btn-1"  onclick="affDescription(\'pan-1\',\'btn-1\' )"   class="btn btn-primary"  >
				            {lire plus} <i class="fa fa-arrow-down" aria-hidden="true"></i> </a> 
				            <div class="pan-slide"  id="pan-1">'.$art[1].'<a href="javascript:;" id="btn-up-1"  onclick="cacheDescription(1)"   class="btn btn-primary"  >
							{reduire} <i class="fa fa-arrow-up" aria-hidden="true"></i></a>

				            </div>';


       } else {
  			$article = '<div> '.$art[0].'</div>';


       }

     
	
	    $tag[]  = '{ARTICLE}';
		$ext[]  =  $article ;
		
		
	//	$tag[]  =  '{}';
	//	$ext[]  =  3;		
		
		$data = str_replace ( $tag , $ext , $f) ;
		 
		return $data;
	
	}
	
	
 	




	 
//Fin classe
}


?>
