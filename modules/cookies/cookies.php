<?php 


class cookies 
{
	private $cx ;
	private $obj ;
	private $lg ;
	public $li ;
	public $mess = 2 ;
	public $params;
	public $script ;

public function __construct($c,$obj,$lg)
{
	 $this->cx  = $c; 
	 $this->obj = $obj ;
	 $this->lg = $lg;
	 $this->params  = $this->obj->param;
}
	
	
public function listArticle() 
{
	
    $this->db =  $this->cx->db ;


    $ids = array();


     

	$ids[] = $this->params->intro;    
	  

	if (isset($this->params->necessairesText)) $ids[] = $this->params->necessairesText;    
	if (isset($this->params->cookies1Text)) $ids[] = $this->params->cookies1Text;    
	if (isset($this->params->cookies2Text)) $ids[] = $this->params->cookies2Text;  	  
	if (isset($this->params->cookies3Text)) $ids[] = $this->params->cookies3Text; 

	$this->db->resetSelect();
	$this->db->addSelected('*', ''); 
							
	$this->db->addFrom('is_contenu');

	$this->db->addWhere(' id IN  ('.implode(',', $ids).')'); 
	   
	   
  	if (!$this->db->select())
  	{ 
  		echo 'ERREUR: Mi-Slider  '.$this->db->getErrMessage().'<br><br>'; }
    else 
    {   
 			 
	 
		$result = $this->db->getAllRows();
	    return $result ;  }
	
	}

	
	/****************************************************/
	private function affectArticle() 
	{
		  
	$mesContenu  = array();
	$articles = $this->listArticle();
  
	 
	 
	foreach($articles as $art)  
	{  

	if ( $this->params->intro == $art['id']) $mesContenu['intro'] = $art['intro_text'] ;    
	  

	if ( $this->params->necessairesText == $art['id'] ) $mesContenu['necessairesText'] = $art['intro_text'] ;     
	if ( $this->params->cookies1Text == $art['id'] ) $mesContenu['cookies1Text'] = $art['intro_text'] ;   
	if ( $this->params->cookies2Text == $art['id']) $mesContenu['cookies2Text'] = $art['intro_text'] ;  	  
	if ( $this->params->cookies3Text == $art['id'] ) $mesContenu['cookies3Text'] = $art['intro_text'] ;  
            
	   
	} 		
			
			 
		 
			 
			return $mesContenu ;
	
	/**/
	
	}
	
	 
	
	
	 
	 
	
	 
	/*************************************/
	
	public function affiche() 
	{ 

		ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


	 	$url = 'modules/cookies/tpl/tpl2.php';
		$data = file_get_contents($url) ; 


    	 
		$jsScript = file_get_contents('modules/cookies/assets/js/script.js') ; 
    $tag[]  =  '{jsScript}';
		$ext[]  =  $jsScript  ;

		$style = file_get_contents('modules/cookies/assets/css/style.css') ; 
    $tag[]  =  '{style}';
		$ext[]  =  $style  ;



		$art = $this->affectArticle() ;

		$tag[]  =  '{intro}';
		$ext[]  =  $art['intro'] ; 

		$tag[]  =  '{text}';
		$ext[]  =  $this->textCookies($art); 

/* 	
		$tag[]  =  '{}';
		$ext[]  =  $art[] ; 
		
		 
	*/	
		$tag[]  =  '{titreModule}';
		$ext[]  =  $this->params->titre;

		$tag[]  =  '{parametrer}';
		$ext[]  =  $this->params->parametrer;
		
		$tag[]  =  '{accepter}';
		$ext[]  =  $this->params->accepter;


		$tag[]  =  '{cookies}';
		$ext[]  =  $this->creatCokkiesInput() ; 


		$html = str_replace ( $tag ,$ext , $data) ;
		 
		 
		return $html;
	}



private function textCookies($mesContenu) 
{

$collapse  = $this->creatText($this->params->necessaires,$mesContenu['necessairesText'], false ,1);
$collapse .= $this->creatText($this->params->cookies1,$mesContenu['cookies1Text'], true ,2);

return $collapse;
 

/**/
}

/**/
function creatCokkiesInput()
{

	$inputs = array();

  if (  $this->params->cookies1Text  ) 
  {
		$inputs[] = '<input type="hidden" name="cookies1" id="cookies1">' ;
  }     


	if ( $this->params->cookies2Text ) 
	{
		$inputs[] = '<input type="hidden" name="cookies2" id="cookies2">' ;
	}
	if ( $this->params->cookies3Text ) 
	{
		$inputs[] = '<input type="hidden" name="cookies3" id="cookies3"  >' ;
	}

	return implode( '',$inputs) ;

/**/
}

/**/
function creatText($titre,$text,$btn,$nbr) 
{

 
   	

  $myBtn = ($btn) ?  '	<div class="Toggle">
			      			<input id="CookCheck'.$nbr.'" name="CookCheck'.$nbr.'" type="checkbox" value="1"/>
			      			<label for="CookCheck'.$nbr.'">

			      			 
          					<button class="btn btn-link btn-block text-'.$this->lg.'" type="button" data-toggle="collapse" data-target="#collapse'.$nbr.'" aria-expanded="true" aria-controls="collapse'.$nbr.'">
				          '.$titre.'
				        </button>	

          					</label>
			    		</div>' 
			      	: '<button class="btn btn-link btn-block text-'.$this->lg.' " type="button" data-toggle="collapse" data-target="#collapse'.$nbr.'" aria-expanded="true" aria-controls="collapse'.$nbr.'">
				          '.$titre.'
				        </button>	';

$collapse = '<div class="card">
			    <div class="card-header" id="heading'.$nbr.'">
			      '.$myBtn.'
			    </div>
';
$collapse  .= ' <div id="collapse'.$nbr.'" class="collapse" aria-labelledby="heading'.$nbr.'" 
					data-parent="#cookiesParameter">
					     <div class="card-body">
		        				'.$text.'
		        		 </div>
		         </div>


		  </div>  '; 


return  $collapse ;
	/**/

}

/**********Fin classe ************/

}
?>
 

