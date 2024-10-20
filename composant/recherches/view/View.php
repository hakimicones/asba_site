<?php 
 
class recherchesView {


public $rows;
public $nbr;
public $message = array() ;


public function __construct($obj)
		{
		 
			 $this->lg		= $obj->lg; 
			 
			 
		 
			 $this->model   = $obj->model;
		}
	public function display() { 


		$url = 'composant/recherches/view/tpl/default.php';
	  $f = file_get_contents($url) ;

	  $input = (isset($_POST['rech-input'])) ? $_POST['rech-input'] : '';

	  if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
				
			// Échapper les caractères spéciaux
			$input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');

			// Supprimer les balises HTML
			$input = strip_tags($input);

			// Limiter la longueur
			$input = substr($input, 0, 255);
			 
		}

				
	    $rows   = $this->model->getContenu($input);

		$tag[]  = '{contenu}';
		$ext[]  =  $this->getContenu($rows,'page'); 
				
		$rows = $this->model->getFatawa($input);
		$tag[]  = '{contenufatawa}';
		$ext[]  =  $this->getFatawa($rows );
		
		$rows = $this->model->getProds( $input);
		$tag[]  = '{contenuproduits}';
		$ext[]  =  $this->getContenu($rows,'produits');		
	
		$rows = $this->model->getNews($input);
		$tag[]  = '{contenunews}';
		$ext[]  =  $this->getContenu($rows,'newslist');
		/**/
		
		$tag[]  = '{rech}';
	 	$ext[]  =  $input;
		
		$data = str_replace ( $tag , $ext , $f) ;
		
 
	return $data;

 }
 
 function getFatawa($rows){
 if ( $this->lg!='ar') { $dir ='direction="ltr"';  } else{  $dir ='direction="rtl"';} 
 $li = '<section id="fatawa-blog"   style="margin-top: 20px;" '.$dir.'><ul class="resultat-list">';
  
   
   if (count($rows->Row)) {
   
   foreach($rows->Row as $row ) {
   
   $intro1 =   explode( '{reponse}' ,$row['full_text'] ) ; 
   $rep    =  (count($intro1)>1)?$intro1[1]:"";
   $li .= '<li>
   
   
   
   
   <div>  <h3 class="fatawa-title"> '. $row['title' ] .' </h3> '
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
		            {reduire} <i class="fa fa-chevron-up" aria-hidden="true"></i></a></div> </div> 
	</li>				
	';
   
   
   
   }
   
    $li .= '</ul></section>';
   
   }  else {
   
   $li = '{not-found}';
   
   
   }
 return $li;
 
 
 
 
 }
 
 
 function getContenu($rows,$option){
 $li = '<ul class="resultat-list">';
  
   $list = ($option=='page') ? 'list' :'detail' ;
   if (count($rows->Row)) {
   
   foreach($rows->Row as $row ) {
   
   $id   =  ($option=='page') ? $row['id'] : ( ($option=='produits') ? 1 : 35  );
   $num  =  ($option=='page') ? 0 :  $row['id'];
   
   $li .= '<li><a href="'.$this->lg.'/'.$option.'/'.$list.'-'.$id .'-'.$num.'.html" class="resultat-link" >'.$row['title'].'</a></li>';
   
   
   
   }
   
    $li .= '</ul>';
   
   }  else {
   
   $li = '{not-found}';
   
   
   }
 return $li;
 
 } 

//fin class 
}

 