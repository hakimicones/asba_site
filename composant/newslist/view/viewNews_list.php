<?php 

class viewNewslist {
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

	$url  = 'composant/newslist/view/tpl/tpl.html';
	$data = file_get_contents($url) ; 
	$pg ='';
	$p = 1 ;
	$n = 0 ;
	$i = 0 ;
	$modal = '';

	$page = '<ul class="pagination justify-content-center">
	         <li class="page-item first disabled"><a class="page-link" id="link-first"  href="javascript:first()"> <</a></li>';
	$li = 	''
			.'
			<div class="page  active" data-page="'.$p.'"  id="page-'.$p.'">
			
			'
			 
			.'<div class="row"  style="margin-bottom: 15px;">';

        $activelink = " active-link";
		$disabled   = "disabled";
		foreach ($this->rows  as $row )   {  
	 		
			$i++; 
			$n++;
			
			$txt =  $this->getWords(strip_tags($row['full_text']), 10 )  ;

			$text  =  $txt->text ;
			$point =  $txt->point ;

			$img = (file_exists($row['image'])) ? $row['image'] : 'images/news-vide.jpg';
        
			$li .= ' 
					<div class=" col-12 col-sm-6 col-md-4 col-lg-4">
						<div class="card">
								
								<img class="card-img-top" src="'.$img.'" alt="'.$row['title'].'">
								
								<div class="card-body">
								<p> '.$row['title'].' </p>
								<a href="'.$this->lg.'/newslist/detail-'.$row['lien'].'-'.$row['id'].'.html" class="link-news-list">{lire plus}</a>
								</div>
							</div>
					</div>
			
			
			
			'; 

			if ($i==9) {
				$page .= '<li class="page-item '.$disabled.'"><a class="page-link '.$activelink.'" id="link-'.$p.'" href="javascript:affMyPage('.$p.')">'.$p.'</a></li>';
				$p++;
				$pg =    '</div><div  class="page '.$i .'" data-page="'.$p.'" id="page-'.$p.'">';
				$i = 0 ;
				$activelink = "";
				$disabled   = "";
	
	}
				if ($n==3) {
					$n = 0 ;     

					
						
			
							$li .=    '</div>'.$pg.'<div class="row" style="margin-bottom: 15px;">';

				}

		
				$pg = '';
		 
	 	}
		
		$page.= '<li class="page-item last"><a class="page-link" href="javascript:last()">></a></li>';
		$li  .= '</div></div> '.$page.'  ';
		 
		 

		$tag[]  =  '{news}';
		$ext[]  =  $li ;
	  
	 $html = str_replace ( $tag ,$ext , $data) ;
	 
	 
	return $html;
	
	}
	
 	
	/******************************/
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

public function getGalerie() {

	$ul = '<div class="row">';
	$i = 0 ;
	$imgs = explode(';',$this->rows['galerie'])	;

	foreach ($imgs  as $img ) {
		$i++;
		$ul .=  (!empty($img)) ? '  
									<div class=" col-12 col-sm-6 col-md-4 col-lg-3">
										<div class="card  gallery">

											<img class="card-img-top" src="'.$img.'" 
											     data-toggle="modal" data-bigimage="'.$img.'"  data-target="#NewsListModal" 
												 class="img-fluid" alt="galerie-'.$i.'">

										</div>				
									</div>		' 
							   : '';

	}

	$ul .= '</div>';

    return $ul;

}

public function getDetail() { 

	$imgs = $this->getGalerie();

    $modal = '
	<!-- Modal -->
	<div class="modal fade" id="NewsListModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
	
		  
		  <div class="modal-body">
	
		   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>        
	
					<img src="" alt="" id="image" class="img-fluid">
	
			
			
		  </div>
	
		</div>
	  </div>
	</div>  
	';
	
	$script = " 
	<script>
	$(document).ready(function () {

		// Gets the video src from the data-src on each button
		var imageSrc;
		$('#news-". $this->rows['id']." .card-img-top').click(function () {
		   imageSrc = $(this).data('bigimage');

		console.log(imageSrc);
		$('#image').attr('src', imageSrc);

		});
	
	
	
		// when the modal is opened autoplay it  
		$('#myModal').on('shown.bs.modal', function (e) {
	
		  // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
	
		 
		})
	
	
		// reset the modal image
		$('#myModal').on('hide.bs.modal', function (e) {
		  // a poor man's stop video
		  $('#image').attr('src', '');
		})
	
	
	
	
	
	
		// document ready  
	  });
	  </script> 
	  " ;
		
	$html  = '<section id="news-'. $this->rows['id'].'" class="news-detail"  >
	<div class="container"> 
	<h5 class="barre-titre-news"><span class="titre-news">{news}</span></h5>
	<div class="news-content">  '  ;
	$html .= ' <h5>  '. $this->rows['title'].' </h5> ';
	$html .= ' <div class="">  '. $this->rows['full_text'].' </div > '.$imgs;
	 
	
	 
	$html .=  '</div></div>'.$modal.'</section>'.$script;
	 return  $html ;
}
	
	
	//Fin classe
}
?>
