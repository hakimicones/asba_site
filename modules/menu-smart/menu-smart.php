<?php 
class menu_smart {
	public  $cx ;
	private $obj ;
	public $li = "<!-- menu smart -->";	
	public $lg;
	public $param ;
	public $script;

public function __construct($c,$obj,$lg)
	{
	 $this->cx  	= $c; 
	 $this->obj 	= $obj ;
	 $this->lg 		= $lg;
	 $this->param   = $this->obj->param ;
	 
 
	}
	// Textes complets 	id 	title 	type 	link 	html 	id_langue 	niveau 	publier 	id_menu 	icones 	ordre
//**************	
public function affiche() { 
	$db =  $this->cx->db ;
	$db->resetSelect();
	$db->addSelected('*', '');  
	$db->addFrom('is_mega_menu');   
	$db->addWhere('publier = 1'); 
	$db->addWhere('id_menu =  '.$this->param->id_menu);
	$db->addOrderBy('ordre ASC');
	if (!$db->select()){ echo 'ERREUR: Menu SPEC  '.$db->getErrMessage().'<br><br>'; }
        else {   
	 
		$this->li = '<div id="menu_smart-'.$this->param->id_menu.'" class="smart-'.$this->param->sens.'">';
		$result = $db->getAllRows();		 
        $s = '';
		foreach($result as $el)  
	   {  
	   
	 
	   $p = json_decode($el['param']);
	   $id_tag = (isset($p->id_tag ))?$p->id_tag:"";
	  
		   $this->li .='<a href="'.$el['link'].'" id="'.$id_tag .'_btn" class="smart_btn" data-toggle="tooltip" title="" 
						data-original-title="'.$el['title'].'"> ';
		   $this->li .='<span style="display:none; float:left"> '.$el['title'].' </span>';
		   $this->li .='<i class="fa '.$el['icones'].'"></i></a>'; 
		   
		 $s.=" smart_menu('#".$id_tag."_btn') ;";
		 
	   }	   
	   $this->li .= '</div>';
	   $this->script .= "
	   //test2
	   function smart_menu(elem) {	 

		$(elem).mouseover(function(){
   		$(this).clearQueue().animate({
				width: '160px'
			} );
   		$(elem+' span').css('display','block');
 		 
   		$(elem+' span').clearQueue().animate({
				opacity: '1'
			});
   
		});
 
	$(elem).mouseout(function(){
	$(elem+' span').clearQueue().animate({
				opacity: '0'
			});	
   $(elem+' span').css('display','none');
  
   $(this).clearQueue().animate({
				width: '42px'
			});
		});
	
	}".$s .'
		 $(document).ready(function() { 
    	  var time = 0 ; 
    	 		$(".smart_btn").each(function(){
							time = time + 200 ;    	 				 
    	 				  $(this).clearQueue().animate({"margin-'.$this->param->sens.'":  "10px"},time ) ;
    	 		});
        });

	' ;
	   
	   
       
		return $this->li.'<script>
		//test 
		'. $this->script.'</script>';
		
		
		
		
		}

}

}
?>
