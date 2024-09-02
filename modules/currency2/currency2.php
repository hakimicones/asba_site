<?php 
include_once('includes/Mobile_Detect.php');

class currency2 {
	public  $cx ;
	private $obj ;
	public $li ;
	public $lg;
	public $script ;
	

public function __construct($c,$obj,$lg)
	{
	 $this->cx  	= $c; 
	 $this->obj 	= $obj ;
	 $this->lg 		= $lg;
	 $this->detect 	= new Mobile_Detect;	 
	 
	}
public function affiche() {

  $view =( $this->detect->isMobile() ) ? "" : "" ;

 $db =  $this->cx->db ;
 $db->emptyParams();
 $db->resetSelect();
 $db->addSelected('*', '');
 $db->addFrom('is_currency');
 $db->addWhere('publier = 1');

 $format =  ($this->lg == 'en') ? 'Y-d-m' : 'd-m-Y' ; 
 
 $dir 	 =  ($this->lg == 'fr') ? 'ltr' : 'rtl' ;
 
 
 $header = '<div  align="center" id="title-'.$this->obj->param->id_module.'" class="periode" >   
                          '.$this->obj->param->titre.' 
						  {du} <span class="number">'.date($format ,strtotime($this->obj->param->date1)).'</span>  
						  {au} <span class="number">'.date($format ,strtotime($this->obj->param->date2)).'</span>  						  
			</div>';
 $header2 = '<div  align="center" id="title-'.$this->obj->param->id_module.'" class="periode" >   
                          '.$this->obj->param->titre2.' 
						  {du} <span class="number">'.date($format ,strtotime($this->obj->param->date1)).'</span>  
						  {au} <span class="number">'.date($format ,strtotime($this->obj->param->date2)).'</span>  						  
			</div>';	
			
 $header3 = '<div  align="center" id="title-'.$this->obj->param->id_module.'" class="periode" >   
                          '.$this->obj->param->titre3.' 
						  {du} <span class="number">'.date($format ,strtotime($this->obj->param->date1)).'</span>  
						  {au} <span class="number">'.date($format ,strtotime($this->obj->param->date2)).'</span>  						  
			</div>';						
 
$currency = '<section id="'.$this->obj->param->id_module.'" class="'.$this->obj->param->css.'"   dir ="'.$dir .'" > '. $header 
            . (  ( $this->detect->isMobile() ) ? '<ul id="list-'.$this->obj->param->id_module.'"  >' 
                                            : '<table align="center" class="table-currency '.$this->obj->param->css.'" width="60%"> 
											     <tr>
													 <th width="60%"><div class="titre_cadre">{money}</div></th>
													 <th><div class="titre_cadre2"> {achat}</div></th>
													 <th><div class="titre_cadre2">{vente}</div></th>
												 </tr>'  ) ;
												 
$currency1 = '<section id="'.$this->obj->param->id_module.'-1" class="'.$this->obj->param->css.'"   dir ="'.$dir .'" > '. $header2 
            . (  ( $this->detect->isMobile() ) ? '<ul id="list-'.$this->obj->param->id_module.'"  >' 
                                            : '<table align="center" class="table-currency '.$this->obj->param->css.'" width="60%"> 
											     <tr>
													 <th width="60%"><div class="titre_cadre">{money}</div></th>
													 <th><div class="titre_cadre2"> {achat}</div></th>
													 <th><div class="titre_cadre2">{vente}</div></th>
												 </tr>'  ) ;												 
$currency2 = '<section id="'.$this->obj->param->id_module.'" class="'.$this->obj->param->css.'"   dir ="'.$dir .'" > '. $header2 
            . (  ( $this->detect->isMobile() ) ? '<ul id="list-'.$this->obj->param->id_module.'"  >' 
                                            : '<table align="center" class="table-currency '.$this->obj->param->css.'" width="60%"> 
											     <tr>
													 <th width="60%"><div class="titre_cadre">{money}</div></th>
													 <th><div class="titre_cadre2"> {achat}</div></th>
													 <th><div class="titre_cadre2">{vente}</div></th>
												 </tr>'  ) ;

if (!$db->select()){ echo 'ERREUR: CURRENCY '.$db->getErrMessage().'<br><br>'; }
        else {   
            $result = $db->getAllRows();  
		  
			 foreach($result as $li)  {
			 
			 
			  if ($li['vente']!=0 && $li['achat']!=0) {
			 			 
			           $mob = '<li>&nbsp;&nbsp; {achat} : '.$li['achat'].'  | {vente} :'.$li['vente'].' - '.$li['code'].'</li>';
					   $desk = '<tr>
					   			<td><div class="titre_cadre1 bg-color-1">  
								      '.$li['code'].'&nbsp;&nbsp
								      <img src="'.$li['flag'].'" alt="{taux change} '.$li['code'].'" >
									 &nbsp;&nbsp;&nbsp;&nbsp;'.$li['libelle_'.$this->lg].'
									 </div>
									 </td>
					               <td><div class="number titre_cadre2 bg-color-1">'.$li['achat'].'</div> </td>
								<td><div class="number titre_cadre2 bg-color-1">'.$li['vente'].'</div></td>
								</tr>';
			           $currency .= ( $this->detect->isMobile() ) ? $mob : $desk ;
					   
					   }
					   
					   if ($li['vente1']!=0 && $li['achat1']!=0) {
					   
					   $mob1 = '<li>&nbsp;&nbsp; {achat} : '.$li['achat1'].'  | {vente} :'.$li['vente1'].' - '.$li['code'].'</li>';
					   $desk1 = '<tr>
					   			<td><div class="titre_cadre1 bg-color-1">  
								      '.$li['code'].'&nbsp;&nbsp
								      <img src="'.$li['flag'].'" alt="{taux change} '.$li['code'].'" >
									 &nbsp;&nbsp;&nbsp;&nbsp;'.$li['libelle_'.$this->lg].'
									 </div>
									 </td>
					               <td><div class="number titre_cadre2 bg-color-1">'.$li['achat1'].'</div> </td>
								<td><div class="number titre_cadre2 bg-color-1">'.$li['vente1'].'</div></td>
								</tr>';
					   
					   
					   $currency1 .= ( $this->detect->isMobile() ) ? $mob1 : $desk1 ;
					   
					   
					   
					   
					   
					   /***********************************/
					   
					   }
					   
					   if ($li['vente2']!=0 && $li['achat2']!=0) {
					   
					   $mob2  = '<li>&nbsp;&nbsp; {achat} : '.$li['achat2'].'  | {vente} :'.$li['vente2'].' - '.$li['code'].'</li>';
					   $desk2 = '<tr>
										<td><div class="titre_cadre1 bg-color-1">  
											  '.$li['code'].'&nbsp;&nbsp
											  <img src="'.$li['flag'].'" alt="{taux change} '.$li['code'].'" >
											 &nbsp;&nbsp;&nbsp;&nbsp;'.$li['libelle_'.$this->lg].'
											 </div>
											 </td>
										   <td><div class="number titre_cadre2 bg-color-1">'.$li['achat2'].'</div> </td>
										<td><div class="number titre_cadre2 bg-color-1">'.$li['vente2'].'</div></td>
								 </tr>';
					   
					   
					   $currency2 .= ( $this->detect->isMobile() ) ? $mob2 : $desk2;
					   
					   }  
			 
			 }
$sens = (strtolower($this->lg)!='ar') ? 1 : 2 ;			 
 			 
$currency .=   ( $this->detect->isMobile() ) ?  '</ul>' : '</table>';
$currency .=   '</section>';

 			 
$currency1 .=   ( $this->detect->isMobile() ) ?  '</ul>' : '</table>';
$currency1 .=   '</section>';

$currency2 .=   ( $this->detect->isMobile() ) ?  '</ul>' : '</table>';
$currency2 .=   '</section>';
}
return $currency."<hr>".$currency1."<hr>".$currency2 ;

}


}

?>
