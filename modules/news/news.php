<?php 
 require_once ("includes/Mobile_Detect.php");

class  news {
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
 // echo $db->q; 
		 
		$dc = 0;  
		$result = $db->getAllRows();  
		 $i=0;
		 $s=1;
		$this->li = '<div  class="content-tab"><ul id="page-'.$s.'" class="news-links active g-55"> ';
		 $pagination = '<nav aria-label="Page navigation " class="news-navigation"> <ul class="pagination">';
		 $pagination .='<li    class="btn_page active" ><a class="page-link" id="p'.$s.'" data-page="'.$s.'" href="javascript:">'.$s.'</a></li>	';	
	 foreach($result as $el)  
	   {  
		$i++;
		if ($i>7) {$i=1;  	$s++;
		
		// changer le comportement manuellement 
		$pagination .='<li class="btn_page "   ><a class="page-link" id="p'.$s.'" data-page="'.$s.'" href="javascript:">'.$s.'</a></li>	';
		$this->li .='</ul><ul id="page-'.$s.'" class="news-links">';
		} 
 
		$this->li .= '<li class="news-li">  <a href="'.$this->lg.'/news/detail-'.$el['lien'].'-'.$el['id'].'.html">
					  <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> 
					  <span class="news-title">'.$el['title'].'</span><span class="news-date"><br>'.$el['date'].'</span></a></li>';
			  
		 
 }
 $pagination .='</ul></nav> ';
 $this->li .= '</ul> ';
 //'.$this->obj->libelle  .'
 /*
  




</div>
 */
 
 $mod   = '<a href="javascript:;" id="news" class="news btn_bas2" data-toggle="tooltip" title="" data-original-title="'.$this->obj->libelle  .'" > {news} </a>' ;
 $mod  .='<div id="newPad" style="right: -340px;" class="volet">' ;
 $mod  .='<a href="javascript:;" class="ferme" style="display: none;"><i class="fa fa-arrow-right" ></i></a>' ;

 $mod  .='<div class="widget_title"> <h4><span>{'.$this->obj->libelle .'}</span></h4> </div>';
 $mod  .= $this->li.'</div>';
 $mod .= $pagination.'  </div> '; 
 
 $script="<script> $(document).ready(function(){ $('.news-links').css('display','none');  $('#page-1 ').css('display','block'); }); 
            var h = $( window ).height() -125 ;
		   $('#newPad .content-tab').css('min-height',h+'px');
		   $('#newPad .page-link').click(function() { 
		   var p = $(this).attr(\"data-page\") ; 
		   $('.news-links  ').css('display','none').removeClass(\"active\"); 
		   $('.btn_page').removeClass(\"active\");
		   ;
		   $('#page-'+p).css('display','block').addClass(\"active\"); 
		   $(this).parent().addClass(\"active\");
		   
		   });
		   
		  
		   
		   </script>";
		   $style="<style>
		   .MyPagination { display:table }
		   .MyPagination li { 
		   display:table-cell;
		   -webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3); 
			-moz-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
			box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
			padding:10px;
			margin-left:5px;
			border-radius: 50%;
			background-color:#E1EBE9 }
			.MyPagination li.active {background-color:#0299A7;}
			#menu .MyPagination  .active a {color:white;}
			#menu .MyPagination    a {color:#666;}
			.news-navigation {position: absolute;    bottom: 0;}
		   </style>";
 return $style.$mod.$script;
 
}
}

}
?>
