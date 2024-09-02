<?php 
class module_news {
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
		$this->li = '<div  class="content-tab"><ul id="page-'.$s.'" class="news-links active "> ';
		 $pagination = '<nav aria-label="Page navigation "> <ul class="MyPagination">';
		 $pagination .='<li    class="btn_page active" ><a class="page-link" id="p'.$s.'" data-page="'.$s.'" href="javascript:">'.$s.'</a></li>	';	
	 foreach($result as $el)  
	   {  
		$i++;
		if ($i>8) {$i=1;  	$s++;
		
		// changer le comportement manuellement 
		$pagination .='<li class="btn_page "   ><a class="page-link" id="p'.$s.'" data-page="'.$s.'" href="javascript:">'.$s.'</a></li>	';
		$this->li .='</ul><ul id="page-'.$s.'" class="news-links">';
		} 
 
		$this->li .= '<li class="">  <a href="'.$this->lg.'/news/detail-'.$el['lien'].'-'.$el['id'].'.html">
					  <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> '
					  .$el['title'].'<span class="date"><br>'.$el['date'].'</span></a></li>';
			  
		 
 }
 $pagination .='</ul></nav> ';
 $this->li .= '</ul> ';
 //'.$this->obj->libelle  .'
 /*
  




</div>
 */
 
 $mod   = '<a href="javascript:;" id="news" class="news btn_bas2" data-toggle="tooltip" title="" data-original-title="'.$this->obj->libelle  .'" > {news} </a>' ;
 $mod  .='<div id="menu" style="right: -340px;" class="volet">' ;
 $mod  .='<a href="javascript:;" class="ferme" style="display: none;"><i class="fa fa-arrow-right" ></i></a>' ;

 $mod  .='<div class="widget_title"> <h4><span>'.$this->obj->libelle .'</span></h4> </div>';
 $mod  .= $this->li.'</div>';
 $mod .= $pagination.'  </div> '; 
 
 $script="<script> $(document).ready(function(){ $('.news-links').css('display','none');  $('#page-1 ').css('display','block'); }); 
            var h = $( window ).height() -125 ;
		   $('#menu .content-tab').css('min-height',h+'px');
		   $('#menu .page-link').click(function() { 
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
		   </style>";
 return $style.$mod.$script;
 
}
}

}
?>
