<?php 

class viewMotos {
    public $rows ;
	public $lg;
	public $id;
	public function __construct($rows, $html)
		{
			 $this->rows	= $rows;
			 $this->lg		= $html->obj->lg; 
			 $this->id		= $html->obj->id; 
			 $this->html	= $html;
			 $this->num		= $html->num;
			 
			 
			 
		}
    public function getList() {
	
	$modal = '';
	$i=0; 
	
	$li = 	'<section id="Motos"   style="margin-top: 20px;margin-bottom: 20px;">'
			.' '
			.'<div class="container">
			<form action="'.$this->lg.'/motos/list-'.$this->id.'-0.html" method="post">'
			.$this->getSearchInput()
			.'<ul id="motos-list" class="motos">';
		$ind= true;
		foreach ($this->rows  as $row )   { 
		
		 $i++;
		 $cl_l = ($ind)?'bleu':'vert';
		 $ind  = !$ind;
		 
		  $stk  = ($row['stock'])?  ($row['quantite']  / $row['stock'])*100 : 0 ;
		  $photo =(!empty( $row['photo']))?$row['photo'] :  'images/motos/voiture1.png';
		  
		  
		  
		 $li .= '<li class="c_vehicule">
		        <div class="row r_agence '.$cl_l.'">';
		$l1   ='<div id="map-'.$i.'" class="col-sm-4 auto-img "> <a href="javascript:;"   class=" img-'.$this->lg.'" data-toggle="modal" data-target="#modal-img'.$row['id'].'">   
				 <img src="'.$photo.'" height="200"   /> </a></div>';
				 
				 
	 $l2   =	($row['quantite'])?'<div class="col-sm-4 min-80" > <div id="progressbar"> 
	 
	 					
	 					<div id="indicator" style=" width:'.$stk.'%"></div>
						<span class="stk-prc">'.number_format($stk,0).'%</span> 
						<span class="stk-txt">{stock}</span>
						</div> </div>' : '<div class="col-sm-4 " > <img src="images/stock_'.$this->lg.'.jpg" height="100"   /> </a></div>';  
		
		
		$l3   = ' <div class="col-sm-4 auto-title " ><h3> '.$row['lamarque'].' '.$row['lemodel'].' </h3> 
		         <ul class="list_veh">
				 <li><span class="my-label">{motorisation}</span> : '.$row['motorisation'].'</li>
				 <li><span class="my-label">{edition}</span>  : '.$row['edition'].' </li>
				 </ul>
				 <br>
				 
		</div> 
		 '; 
		
		//<progress id="avancement" value="'.$stk.'" max="100"></progress>
		 if ( $this->lg!='ar') { $li .= $l3. $l2 . $l1; } else{ $li .= $l1 .$l2.$l3; } 
		 
		 
		 $fiche = (!empty($row['fiche']))?'<a href="pdf/'.$row['fiche'].'"  target="_blank"
			  style="margin: 10px;"  class="btn btn-primary btn-sim"> {fiche technique}</a>':'';
			  
			  
		$article = ($row['article_'.$this->lg])?'<a href="javascript:;"  data-toggle="modal" data-target="#modal_doc"  
				style="margin: 10px;"  class="btn btn-primary btn-sim" data-art="'.$row['article_'.$this->lg].'"> {dossier}</a>':'';	  
		
		$li .= '<a href="'.$this->lg.'/motos/simulation-'.$this->id.'-'.$row['id'].'.html" 
			style="width: 20%;    margin: 10px;"  class="btn btn-primary">{sim}</a>'
			.$fiche	
			.$article		
			.'</div></li>';
			
			
			
			
			
 		$modal .= $this->getModal($row);
	 	}
		$li .= '</ul></form> '.$modal.'</div>  ';
		$script = '
		<link rel="stylesheet" href="librairies/jquery.paginate.css" />
		<script src="composant/motos/assets/script.js" ></script>
		<script>
		 $(document).on("show.bs.modal", "#modal_doc", function (e) { 
		    
			var btn = e.relatedTarget ;
		    var art = $(btn ).data("art");
	 
		    getArticle(art)
		  
		  });

		//call paginate
		//$(\'#motos-list\').paginate();
		function getArticle(id) {

             
                var donnees = "task=getArticle&id="+id+"&lg='.$this->lg.'"   ; 
 			//$("#modal_doc").empty();

			var data = ajax_send(donnees,"#modal-body"); 
		 
             
                    console.log(data);

		}
		
		function affImg(img,id) {

				$("#"+id).attr("src", img);

		}	
	</script>  ';
		$modal_doc = '<div class="modal fade top-20" id="modal_doc" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
	    <span class="modal-title" id="ModalLabel"> Patientez </span>
	    <a href="#" onclick="PrintElem(\'modal_doc\','.$this->lg.'); return false;" data-toggle="tooltip"   class="btn-imp no-imp">
				<i class="fa  fa-print"></i></a>
	  <button type="button" class="close  no-imp" id="cls-modal"  data-dismiss="modal" aria-label="Close">
      
        
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-body">
          Patientez...   </div> 
      </div>
      
    </div>
  </div>
        </div>';
		return $li.$script.$modal_doc.' </section>'; 
	
	}
	
	public function getMap($row ) {
	$script = " ";
	
	}
	public function getSearchInput() { 
	$html = '<div ><input type="text"  onBlur="this.form.submit();" class="search_anim" name="search" placeholder="{recherche}.."></div>' ;
	return $html;
	}
	
	
	// Modal 
	
	public function getModal($row) {
	
	   $photo =(!empty( $row['photo']))?$row['photo'] :  'images/motos/voiture1.png';
	$params = json_decode($row['param']); 

        
		$btns  = '';
        $btns .=(!empty($params->p1))? ' <a onclick="affImg(\''.$params->p1 .'\',\'img-'.$row['id'].'\')" style="background-color:#'.$params->c1 .';width:25px;height:25px;display: table-cell;border: 1px solid #eee;cursor:pointer"></a> ':'';
        $btns .=(!empty($params->p2))? ' <a onclick="affImg(\''.$params->p2 .'\',\'img-'.$row['id'].'\')" style="background-color:#'.$params->c2 .';width:25px;height:25px;display: table-cell;border: 1px solid #eee;cursor:pointer"></a> ':'';
        $btns .=(!empty($params->p3))? ' <a onclick="affImg(\''.$params->p3 .'\',\'img-'.$row['id'].'\')" style="background-color:#'.$params->c3 .';width:25px;height:25px;display: table-cell;border: 1px solid #eee;cursor:pointer"></a> ':'';
        $btns .=(!empty($params->p4))? ' <a onclick="affImg(\''.$params->p4 .'\',\'img-'.$row['id'].'\')" style="background-color:#'.$params->c4 .';width:25px;height:25px;display: table-cell;border: 1px solid #eee;cursor:pointer"></a> ':'';
        $btns .=(!empty($params->p5))? ' <a onclick="affImg(\''.$params->p5 .'\',\'img-'.$row['id'].'\')" style="background-color:#'.$params->c5 .';width:25px;height:25px;display: table-cell;border: 1px solid #eee;cursor:pointer"></a> ':'';
        $btns .=(!empty($params->p6))? ' <a onclick="affImg(\''.$params->p6 .'\',\'img-'.$row['id'].'\')" style="background-color:#'.$params->c6 .';width:25px;height:25px;display: table-cell;border: 1px solid #eee;cursor:pointer"></a> ':'';	 
	
	$html = ' <div class="modal fade top-20" id="modal-img'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
	    <span class="modal-title" id="exampleModalLabel">'.$row['lamarque'].' '.$row['lemodel'].'  '.$row['motorisation'].' '.$row['edition'].'</span>
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      
        
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <img id="img-'.$row['id'].'"  src="'.$photo.'" height="400"   />  
      </div>
      
      <div class="modal-footer"> '.$btns.'  </div>
      
    </div>
  </div>
</div>';
	
	//'.$row['obs'].'
	return $html;
	}
	
	
	function getSimulation() {
   
   
   
 
            $url = 'composant/motos/view/tpl/form.php'; 
			$f = file_get_contents($url) ;
			
			$div 	= '<div class="auto-title"><h3>'.$this->rows['lamarque'].' '.$this->rows['lemodel'].'</h3> </div>';
			
			 $photo =(!empty( $this->rows['photo']))? '<img src="'.$this->rows['photo'].'" height="200"   />' :  '--';
			
			$tag[]  =  '{auto}';
		    $ext[]  =   $div;
			
			$tag[]  =  '{prix}';
		    $ext[]  =  $this->rows['prix']  ;
			
			$tag[]  =  '{photo}';
		    $ext[]  =  $photo;
			
			$tag[]  =  '{dir}';
			$ext[]  =  ( $this->lg!='ar')?'ltr':'rtl';
			
			$tag[]  =	'{convs}';
			$ext[]  =	$this->getConv();
			
			
			 $param = json_decode( $this->html->param);
			
			 
			
			$tag[]  =	'{tva}';
			$ext[]  =	$param->tva;
			
			$tag[]  =	'{liens}';
			$ext[]  = $this->lg.'/motos/list-'.$this->id.'-0.html';
			
			
			$motos = ($this->num )? "html +=affRubHidden('montantBien' , '".$this->rows['prix']."','' );":$this->affListeVehicule();


			$tag[]  =	'{listemotos}';
			$ext[]  =	$motos;


			$apport = ($this->num )?'':"html +=affRubTexte('apportPersonnel','{apportPersonnel}','{lg}','','hasData' );";
			
			$tag[]  =	'{apportPersonnel}';
			$ext[]  =	$apport;
			
			
		    $html = str_replace ( $tag ,$ext , $f) ;
		
		 return $html;
   }
   
   
   function getConv() {
   
   
	   
	   $se   = '<!-- ajout --><select  class="selectpicker" id="tauxCharge"  onchange="info()" data-live-search="true" > ';
	   foreach($this->html->conv as $el)   {
	   
	   $se .=  '  <option value="'.$el['taux'].'" data-max="'.$el['taux_max'].'">'.addslashes($el['libelle']).'</option>';   
		 
	   
	   }
	   
	   $se .=  '</select><!-- ajout -->';
	 	 
		return $se ;
   
   }
   
   
   /****************************/


   private function affListeMarque() {
	
	
	$se   = '<!-- ajout --><select   name="Marques" id="Marques" onchange="affModel()"  data-live-search="true" > ';	
	 
	
	$vil = $this->html->listMarque ;
	 
	$i=0;
	$ss=true;
	foreach($vil as $el)  
	   {  
	   
	  
	//$se .=  '  <option data-lg="'.$el['longit'].'" data-lt="'.$el['latit'].'"  '.$check.'   >'.$el['libelle_Fr'].'</option>';    
	$se .=  '  <option value='.$el['id'].'   >'.$el['libelle'].'</option>';   
	   
	  $ss =  ($ss)?false:true;
	  $i++; 
	   
	 } 		
			
			 
			$se .=  '</select><!-- ajout -->';
			 
			return $se ;
	
	
	
	}

	/****************************************************/
	private function affListeVehicule() {
	
	
	$se   = '<!-- ajout --><select   name="montantBien" id="montantBien"   class="selectpicker" data-live-search="true" > ';	
	 
	
	$vil = $this->html->motos;



	 
	$i=0;
	$ss=true;
	foreach($vil as $el)  
	   {  
	   
	  
	//$se .=  '  <option data-lg="'.$el['longit'].'" data-lt="'.$el['latit'].'"  '.$check.'   >'.$el['libelle_Fr'].'</option>';    
	$se .=  '  <option value='.$el['prix'].'   >'.$el['lamarque'].' '.$el['lemodel'].' '.$el['motorisation'].'  '.$el['edition'].'</option>';   
	   
	  $ss =  ($ss)?false:true;
	  $i++; 
	   
	 } 		
			
			 
			$se .=  '</select><!-- ajout -->';

			$ma = $this->affListeMarque();



			$html = "html +=affRubTag('$ma','{marque}','{lg}','id=\"marques-div\"',' hasValue '); 
					 html +=affRubTag('$se','{prix auto}','{lg}','id=\"motos-div\"',' hasValue ');
			";
			       //html +=affRubTag('{vehicule}','{prix auto}','{lg}','',' hasValue ');
			return $html ;
	
	
	
	}

//Fin classe
}
?>
