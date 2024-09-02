<?php 
class my_slider {
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

	 $this->_mob    =  $this->obj->detect->isMobile()  ;
	 
      
	 
	 $this->script =  $this->getScript();
	 
	 $this->db =  $this->cx->db ;
	 
	} 
 
	//<ul id="menu" class="menu_ar">
	
	 function getArticles() {
	 
	 	$db =  $this->cx->db ;
		$db->emptyParams();
		$db->resetSelect();
		$db->addSelected('*', '');
	 
	 	$db->addFrom('is_contenu ');
	 	$db->addWhere('id_appli   = 11 AND  id_item  = '.$this->obj->param->articles );
	 	
		 		
	   $db->addWhere(' publier  = 1');
	   $db->addOrderBy('ordre');
	   
	   if (!$db->select()){  echo 'ERREUR-> LISTE ARTICLES SLIDER: '.$db->getErrMessage().'<br><br>'.$db->q ; return '';  }
        else {      $rows =  $db->getAllRows();return $rows;}
		
	  
	 
	 }

 
	
	 function getImageStyle() {

		$i      = 0;
		$style  ='';
		$slides   =''; 
		$title1 = '' ;
		$title2 = '' ;
		$activ    = 'm--active-slide ';
		$images = ($this->_mob) ?  explode(";",$this->obj->param->images_mob) :  explode(";",$this->obj->param->images);
		$chemin = ($this->_mob) ? 'images/slide/mob' : 'images/slide';
         
	 
		$arts   = $this->getArticles();
		
		$page  = $this->obj->param->page ;
		$lire  = explode(";",$this->obj->param->lire );

		if (isset($arts[$i])) {
			   
			$row = $arts[$i];
		 
		 //ar/page/list-10-0.html
		 
		 $title = explode(';',$row['libelle']); 
		 $title1 = $title[0] ;
		 $title2 =  '' ;
		 $url   =  $this->lg.'/page/list-'.$page.'-'.$row['id'].'.html';
	
	}
		
		
		
		foreach($images  as $image  ) 
		 {			   
			  $i++;
			  $title = '';
			  $url   = '';
			  //m--active-control
			   if (isset($arts[$i])) {
			   
			   		$row = $arts[$i];
					
					//ar/page/list-10-0.html
					
					$title = explode(';',$row['libelle']); 
					$title1 = (isset($title[0])) ? $title[0] : '' ;
					$title2 =  '' ;
					$url   =  $this->lg.'/page/list-'.$page.'-'.$row['id'].'.html';
			   
			   }
			   
			  $style .='.example-slider .fnc-slide-'.$i.' .fnc-slide__inner,
						.example-slider .fnc-slide-'.$i.' .fnc-slide__mask-inner {
  								background-image: url("'.$chemin.'/'.$image .'");
						} ' ;
			  $slide  ='<!-- slide start '.$i.'-->
						<div class="fnc-slide m--blend-red '.$activ.'">
							<div class="fnc-slide__inner">
								<div class="fnc-slide__mask">
									<div class="fnc-slide__mask-inner"></div>
								</div>
								<div class="fnc-slide__content">
									<h2 class="fnc-slide__heading">
						  <div class="fnc-slide__heading-line">
							<span>'.$title1.'</span>
						  </div>
						  <div class="fnc-slide__heading-line">
							<span>'.$title2.'</span>
						  </div>
						</h2>
									<a type="button" href="'.$url.'" class="fnc-slide__action-btn">   '.$lire[1].' <span data-text=" '.$lire[0].' ..."> 
									
									
									'.$lire[1].'   </span> </a>
								</div>
							</div>
						</div>
						<!-- slide end -->'; 	

				$slide_mob  ='<!-- slide start '.$i.' Mobile -->
						<div class="fnc-slide m--blend-red '.$activ.'">
							<div class="fnc-slide__inner">
								<div class="fnc-slide__mask">
									<div class="fnc-slide__mask-inner"></div>
								</div>
								
								
							</div>
						</div>
						<!-- slide end -->'; 	

						$slides   .= ($this->_mob) ? $slide_mob : $slide ;		
						
				$activ    = '';			
	
	 		}
			
			
			 $data = new stdClass;
			 $data->slides  = $slides ; 
			 $data->style 	= $style; 
			 
			 return  $data;
	
	}
	public function getScript()  {
		 

		 $script = ($this->_mob) ? '

                   // SCRIPT POUR WIDTH
		 var w = window.innerWidth;
		 $(".fnc-slider").css("max-height",w+"px");
		 $(".demo-cont").css("max-height",w+"px");


		 ' : ''; 
		 return  $script;
	 
	
	}
	
	

	 
	
	/***************************************/
	public function affiche() { 




	 	 
		 $url  = 'modules/my-slider/tpl/tpl.php';
		 $data = file_get_contents($url) ;  
		 
		 $slider = $this->getImageStyle();
		 
		
		 $tag[]  =  '{slides}';
		 $ext[]  =  $slider->slides;
		 
		  $tag[]  =  '{style}';
		 $ext[]   = $slider->style ;
		 
		 
		 $tag[]  =  '{bg}';
		 $ext[]  = '' ;


		 $tag[]  =  '{script}';
		 $ext[]  =  $this->script ;

		 
	 	 
		 $html = str_replace ( $tag ,$ext , $data) ;
		 
		 
		return $html;
	 
	}
	
		 
	/*******************************************/
}


?>
 


