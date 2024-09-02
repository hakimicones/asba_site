<?php 
class menu_saut {
	public  $cx ;
	private $obj ;
	public $li ;
	public $lg;
	public $script ;
public function __construct($c,$obj,$lg)
	{
	 $this->cx 		= $c; 
	 $this->obj 	= $obj ;
	 $this->lg 		= $lg;
	 $this->param   = $this->obj->param ;
	}
public function affiche() { 
	$ic	= '<div id="m_bas"><div class="row">';
	$tx = '';
	$script = '<script src="librairies/jquery/js/jquery-ui.min.js"></script><script src="modules/menu-saut/js/script.js"></script> ';
	 
 
		 
		
		 
		 
		 
	    
	$ic .= '<div class="col-lg-4 icon"><a class="bouton cl1" data-link="btn_1" href="'.$this->param->lien1.'"><i class="fa '. $this->param->icon1.'"></i></a></div>
	        <div class="col-lg-4 icon"><a class="bouton cl2" data-link="btn_2" href="'.$this->param->lien2.'"><i class="fa  '. $this->param->icon2.'"></i></a></div>
	        <div class="col-lg-4 icon"><a class="bouton cl3" data-link="btn_3" href="'.$this->param->lien3.'"><i class="fa  '. $this->param->icon3.'"></i></a></div>
	
	';
	
	
		
	$tx .= '<div class=" col-lg-4"><a id="btn_1" class="btn_b cl1" href="'.$this->param->lien1.'" data-effect="shake" >  '.$this->param->titre1.' </a></div>
	        <div class=" col-lg-4"><a id="btn_2" class="btn_b cl2" href="'.$this->param->lien2.'" data-effect="shake" >  '.$this->param->titre2.' </a></div>
			<div class=" col-lg-4"><a id="btn_3" class="btn_b cl3" href="'.$this->param->lien3.'" data-effect="shake" >  '.$this->param->titre3.' </a></div>
	
	';
	
	
	
	
	
	
	    
	   	$ic   	 .= '</div></div>';
		 
	   	$this->li = '<div id="menu_func">'.$ic.'<div class="bgb"></div>'.$tx.'</div>'.$script;
		
		return $this->li. $this->getPop('.cl3');
		 
}
 public function getPop($id) {
	  $script = '<script> 
	  var larg_fen = $(window).width();
	  var larg_mod = $("#menu_func").width();
	 
	  var rest = (larg_fen - larg_mod) / 2
	  if(window.matchMedia("(max-width:768px)").matches) {var lft = 200 ; } else {
	   lft = (rest-200)*2; }
	  $("#pop-insc").css("top","-20px");
 
	  			$("'.$id.'").click(function() {
				$("#pop-insc").animate({
						opacity: 1,
						display:"block", 
						right: lft+"px",
						top:"-75px",
						height: "toggle"
					  }, 700, function() {
						// Animation complete.
					  });
					  
				
				});	
				$("#btn-close-news ").click(function() {
				$("#pop-insc").animate({
						opacity: 0.25,
						display:"none", 
						right: "0px",
						top:"-20px",
						height: "toggle"
					  }, 500, function() {
						// Animation complete.
					  }); 	});	
					  
					  
					  
					  /********************************/
					  
					  $("#news_form").submit(function(e){  

							 e.preventDefault();  
							 var donnees = $(this).serialize();	
							   $.ajax({ 
									type: \'POST\',
									url:  \'send_ajx.php?option=newsLetter\',
									data: donnees,
											success:function(response) {
												alert(response);
												
												
												$("#pop-insc").animate({
												opacity: 0.25,
												display:"none", 
												right: "0px",
												top:"-20px",
												height: "toggle"
											  }, 500, function() {
												// Animation complete.
											  }); 
												 
											}
										});  
							});
							
							if(window.matchMedia("(max-width:640px)").matches)  
								{  $("#menu_func .col-lg-4").removeClass("col-lg-4").addClass("col-4")  }
				</script>';
				
				 
	  
	  $div = '<div id="pop-insc" style="display:none;background: #fff;height: 165px;width: 400px; border-radius:0 5px;border:#999 1px solid; position: absolute;opacity: 0.25; margin-top:10px;top:0;">  <form id="news_form"  method="post" >
	  				<h3 style="width:100%; text-align:center;line-height: 20px;margin-top:5px;">{rejoinez la news letter}</h3>
					<div  style="text-align:center;padding:10px">
					  
							<input type="text" name="name"  placeholder="{nom}"        style="border-radius:5px;border:#999 1px solid;margin-bottom:5px;padding-right: 10px;" />
							<input type="email" name="email" placeholder="{votreemail}" style="border-radius:5px;border:#999 1px solid;margin-bottom:5px;padding-right: 10px;" />
						
					</div>	
					<div  style="padding: 5px;border-top: 1px solid #e5e5e5;  ">		
							<button id="btn-send-news" type="submit" class="btn btn-primary">{send}</button>
							<button id="btn-close-news" type="reset" class="btn btn-default">{close}</button>
					</div>	</form>	
	  		 </div>';
			 
			 return $div.$script;
	  
	  }


}
?>
