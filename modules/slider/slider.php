<?php 
class Slider {
	public $style  ;
	public $script1 ;
	public $script2 ;
	public $script ;
 
	 
public function getSlider($cx , $lg) {

	$db =  $cx->db ;
	$db->emptyParams();
	$db->resetSelect();
	$db->addSelected('a.id', 'id');	
	$db->addSelected('id_slider', 'id_slider');
	$db->addSelected('type', 'type');
	$db->addSelected('b.backgroud', 'backgroud_slide');
	$db->addSelected('a.background', 'background');	
	$db->addSelected('content', 'content');
	$db->addSelected('animation', 'animation');
	$db->addSelected('left_pos', 'left_pos');
	$db->addSelected('top_pos', 'top_pos');
	$db->addSelected('right_pos', 'right_pos');
	$db->addSelected('width', 'width');
	$db->addSelected('height', 'height');
	$db->addSelected('z_index', 'z_index');
	$db->addSelected('a.ordre', 'ordre');	
 
	$db->addFrom('`is_slider_caption` as a , is_slider as b ');
	
	$db->addWhere('a.id_slider = b.id');
	$db->addWhere('b.publier = 1');
	
	$db->addWhere('b.id_langue = :lg');
	$db->addParamToBind('lg', $lg  );
	
	$db->addOrderBy('b.ordre ASC , a.id_slider ');

						
$li_slides = '<ul class="slides">';
$sl = 0;


if ($db->select()) {
     $result = $db->getAllRows();
   
    foreach($result as $slide) { 
		
    if ($sl != $slide['id_slider'] ) {
	if ($sl !="" ) {$li_slides   .='</div></li>'; }  /**/
	$this->style  .= '.flexslider.top_slider .slides li.s'. $slide['id_slider'] .' { background-image:url('. $slide['backgroud_slide'].'); background-size: cover;}   ' ;    
	$sl = $slide['id_slider'];
	$li_slides   .=  '<li class="s'. $slide['id_slider']  .' " '
			              .'>'
						  .'<div class="container">' ; 
			}  
			
			//id`, `id_slider`, `content`, `animation`, ``, ``, ``, ``, `width`, ``
						  
			$li_slides       .='<div class="flex_caption'.$slide['id'].'  '.$slide['animation'].'">'
						  . $slide['content'] 
						  .'</div>' ;
			$this->style       .= '.top_slider .slides .flex_caption'. $slide['id'] .' {
			                   position:absolute;    z-index:'. $slide['z_index'] .' ;
			                  top: '.$slide['top_pos'].'px; ';	
			if 	($slide['width']  != 0 ) { $this->style        .= 'width:'.$slide['width'].'px;';} 
			if 	($slide['height'] != 0 ) { $this->style        .= 'height:'.$slide['height'].'px;';} 
							  
			if 	($slide['right_pos'] != 0 ) { $this->style   .= 'right:'.$slide['right_pos'].'px;';}  	
			if 	($slide['left_pos'] != 0 ) 	{ $this->style       .= 'left:'.$slide['left_pos'].'px;';}		  		  
						  
			if 	($slide['type'] == 2 )
			//.top_slider .slide1 ,
			 { $this->style   .= 'background-image:url( '.$slide['background'].'); background-repeat:no-repeat; background-size:100% auto;}';	 }   
			 else  {$this->style        .='}';}
						  
			 if ($sl <> $slide['id_slider'] ) { $li_slides       .='</div>' ; } ;	/**/		
			   
					 
			} 
		  
		  $li_slides   .='</li></ul>';
  
		  $slides =   '<div class="flexslider top_slider">'. $li_slides  .'   </div>';
		   
		   return  $slides ;
		   } else {echo 'ERRURR: Slider '.$db->getErrMessage().'<br><br>';
		   
		   
		   }
		   
		  
		 
		    
		   
			 
		   
		     } 
			 
			  
			 
			 
			 
			 }
			 
			
			 
			 ?>