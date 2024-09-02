<?php 

require_once ("includes/Mobile_Detect.php");

class viewReclamation {
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
			 $this->detect 		= new Mobile_Detect;

	
		}
		
    public function display() { 
	 
	$li = 	'';
	if ( $this->detect->isMobile() ) { 


		       $url = 'composant/reclamation/view/tpl/form1.php';

	 }	else {

              $url = 'composant/reclamation/view/tpl/form.php';

	 }
		
	 
	$f = file_get_contents($url) ;

	$tr= '';

       $art = (isset($this->article)) ? explode('{reduire}',$this->article->data) : array() ;
       if (count($art )>1) {
		  	$article = '<div> '.$art[0].'</div><a href="javascript:;" id="btn-1"  onclick="affDescription(\'pan-1\',\'btn-1\' )"   class="btn btn-primary"  >
				            {lire plus} <i class="fa fa-arrow-down" aria-hidden="true"></i> </a> 
				            <div class="pan-slide"  id="pan-1">'.$art[1].'<a href="javascript:;" id="btn-up-1"  onclick="cacheDescription(1)"   class="btn btn-primary"  >
							{reduire} <i class="fa fa-arrow-up" aria-hidden="true"></i></a>

				            </div>';


       } else {
  			$article =  (count($art )>1) ?  '<div> '.$art[0].'</div>' : '';


       }

     
	
	    $tag[]  = '{ARTICLE}';
		$ext[]  =  $article ;
		
		
	//	$tag[]  =  '{}';
	//	$ext[]  =  3;		
		
		$data = str_replace ( $tag , $ext , $f) ;
		 
	//	return '<link href="composant/reclamation/css/style.css?26J" rel="stylesheet"/>'.$data;



		if ( $this->detect->isMobile() ) { 

				return '<link href="composant/reclamation/css/style_mob.css?'.date("dmY_his").'" rel="stylesheet"/>'.$data;
		} else {
				return '<link href="composant/reclamation/css/style.css" rel="stylesheet"/>'.$data;

		}
		 
	
	}
	 public function displayreclamation() { 
	 
	$li = 	'';
		
		 $url = 'composant/reclamation/view/tpl/reclamation.php';
	$f = file_get_contents($url) ;

	
	    $tag[]  = '{ARTICLE}';
		$ext[]  =  "" ;
		
		
	//	$tag[]  =  '{}';
	//	$ext[]  =  3;		
		
		$data = str_replace ( $tag , $ext , $f) ;

		if ( $this->detect->isMobile() ) { 

				return '<link href="composant/reclamation/css/style_mob.css?'.date().'" rel="stylesheet"/>'.$data;
		} else {
				return '<link href="composant/reclamation/css/style.css" rel="stylesheet"/>'.$data;

		}
		 
		
		 
	
	}
	 public function displayreclamationeng($bc) { 
	 
	$li = 	'';
		
		 $url = 'composant/reclamation/view/tpl/reclamationenrg.php';
	$f = file_get_contents($url) ;

	
	    $tag[]  = '{ARTICLE}';
		$ext[]  =  $article ;
		
		
	//	$tag[]  =  '{}';
	//	$ext[]  =  3;	

	 $tag[]  =  '{bc}';
	 $ext[]  =  $this->getBC($bc);		
			
		
		$data = str_replace ( $tag , $ext , $f) ;
		 
		return $data;
	
	}

	function getBC($bc) {


  //  print_r($bc);

		$ret = '<div class="container"> <div id="accordion"> ' ;
		$i=0;
		foreach($bc as $value) {
  		$i++;
        $ret .= '<div class="card">
				    <div class="card-header" id="heading'.$i.'">
				      <h5 class="mb-0">
				        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse'.$i.'" aria-expanded="false" aria-controls="collapse2">
				             '.$value['title'].'
				        </button>
				      </h5>
				    </div>

			    <div id="collapse'.$i.'" class="collapse" aria-labelledby="heading'.$i.'" data-parent="#accordion">
				      <div class="card-body">
				      <div style="border-bottom:#eee dotted 1px; padding-bottom:10px;margin-bottom:5px;">
				      '.$value['init_msg'].'
				      </div>
				     <a  href="'.$this->lg.'/reclamation/historyticket-'.$this->id.'-'.$value['id'].'.html"> {lire plus}  </a>
				      </div>
			    </div>
		  </div>
    
			


		';}
$ret .= '</div>
			</div>
			<div class="container" >
				<a class="btn btn-default"  href="'.$this->lg.'/blog/list-8-2.html">{recherche}  FAQ  </a>
			</div>


			';
return $ret ;

	}

 public function displayticket() { 
	 
	$li = 	'';

	if ( $this->detect->isMobile() ) {

		$url = 'composant/reclamation/view/tpl/ticket1.php';

	 } else { 
		
		 $url = 'composant/reclamation/view/tpl/ticket.php';
	}


	$f = file_get_contents($url) ;
               if($_GET['task']!="historyticket") {

               	$tag[]  = '{from}';
				$ext[]  =  $this->getform();

               }
               else{  
                 
               	$tag[]  = '{from}';
		$ext[]  =  "";}	
	    $tag[]  = '{ARTICLE}';
		$ext[]  =  '' ;
		
		$data = str_replace ( $tag , $ext , $f) ;
		 
		return '<link href="composant/reclamation/css/style.css?4Aout" rel="stylesheet"/>'.$data;
	
	}
	public function getcommentticket($data)

{
	$html ='<div class="bodyhistory container">
             <div class="timeline">'; 
	 foreach($data as $value) {
                $prive = ($value['prive']) ? 'prive' :'';

                $lock =  ($value['prive']) ? '<i class="fa fa-lock" aria-hidden="true"></i>':'';

                $admin =   ($value['admin_id']) ? 'sup' : '';

 

                $html.= '
				  <div class="entry">
				    <div class="title '.$prive.'  '. $admin.'port">
				      <h3 class="h3history '. $admin.'">'.$value['name'].' </h3>
				      <p class="phistory">'.$value['date'].' '.$lock.'</p>
				    </div>
				    <div class="body">
				      <div class="phistory" >' .$value['text'].'</div>
				      
				    </div>
				  </div>              '  ;    
            }

            $task = $_GET['task'];

            $html.= ($task == 'historyticket') ? '':  ' 
             <br>
             <div style="float: right;width: 100%;">
            	<a href="javascript:setResolu()" id="btn-resolu" class="btn btn-default" >{resolu}</a>

            	 <div id ="divreplies"></div>
            	 </div>
            <!--   fin -->
           
                            '  ; 

                            $html.='  </div>  </div>'; 
            	return $html;
}
public function displayhistory() { 
	 
	$li = 	'';
		
		 $url = 'composant/reclamation/view/tpl/history.php';
	$f = file_get_contents($url) ;

	
	    $tag[]  = '{ARTICLE}';
		$ext[]  =  '' ;
		
		$data = str_replace ( $tag , $ext , $f) ;
		 
		return '<link href="composant/reclamation/css/style.css?26J" rel="stylesheet"/>'.$data ;
	 
	}

	public function displayMess($mess) { 
	 
	 
		 
		return $mess ;
	
	}



		 public function gettype($result) { 
	 
         $html="";
            foreach($result as $value) {
               
                $html.= '<option value="'.$value['id'].'">'.$value['libelle'].'</option> ' ;     
            }
		return $html;
	
	}
	
 	 public function getdepartments($result) { 
	 
         $html="";
            foreach($result as $value) {
            
                $html.= '<option value="'.$value['id'].'">'.$value['name'].'</option> '  ;    
            }
		return $html;
	
	}
		 public function getlistticket($result) { 
	 
         $html="";
                     	

            foreach($result as $value) {
            
                $html.= '
        <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse'.$value['id'].'" aria-expanded="false" aria-controls="collapse'.$value['id'].'">
             '.$value['title'].'
        </button>
      </h5>
    </div>

    <div id="collapse'.$value['id'].'" class="collapse" aria-labelledby="heading'.$value['id'].'" data-parent="#accordion">
      <div class="card-body">
     <p>'.$value['init_msg'].'</p> 
     <a href="{lg}/reclamation/historyticket-259-'.$value['id'].'.html">{lire plus}</a>
      </div>
    </div>
  </div>'  ;    
            }
		return $html;
	
	}
public function getform()
{
	return '<form method="post" class="formticket" id="formticket">
            <textarea name="replies" id="editor1" rows="10" cols="80">
            </textarea>
        
<div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="prive" value="0" onclick="checkboxclick()">
    <label class="form-check-label" for="exampleCheck1" style="padding: 0px 15px;">{prive}</label>
  </div>  
   <br>

            <a href="javascript:" class="btn btn-default" onclick="ergreplies()">{send}</a>

            </form>
            <script src="librairies/ckeditor/ckeditor.js"></script>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor 4
                // instance, using default configuration.'."
                CKEDITOR.config.toolbar = [{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike'  ] }];".'
              //  CKEDITOR.replace( "editor1" );

                 CKEDITOR.replace( "editor1",
                        {
                             
                            uiColor : "#E5EFEE"
                        });
                        function checkboxclick() {
              var checkbox=document.getElementById("exampleCheck1"); 

                   if (checkbox.checked) {
                checkbox.value=1

                 }
                 else{
                  checkbox.value=0
                    }
}
 
        
            </script>';
}



	 
//Fin classe
}


?>
