<?php 
class menu_maj   {
public $idap; 
public $p;
public $main; 
public function __construct($p , $html)
	{
	  $this->p 		= $p ;
	  $this->main	= $html ;
	  
	}
	
 public function getBtn( $a,$p) { 
   
 
 }	
public function aff($p,$url,$cps) {
 
  return   '<a class="uk-button uk-button-default" href="index.php?option=sessions&view=edit"> Ajouter  </a>' ;

}	

 	
	

}
class menu_edit    {

public function __construct($p, $c)
	{
	   $this->p = $p ;	   
	   $this->user_id = $c->user_id;
	   $this->rows    = $c->rows;
	  
	}
public function getBtn( $a,$p) { 
   
 }
public function aff($p,$url,$cps) {

   $btn1 =  (isset($_GET['type']) && $_GET['type']=='archive')  ? '' :  '<a class="uk-button uk-button-default  right-margin" href="javascript:save()"> Enregistrer</a>'  ;
   return $btn1 .'	<a class="uk-button uk-button-default  right-margin" href="javascript:savecopie()"> Enregistrer une copie</a> 
   					<a class="uk-button uk-button-default" href="index.php?option=sessions">Fermer</a>';
  
}	



}

/**********************/
 class menu_testeurs    {

public function __construct($p, $c)
	{
	   $this->p = $p ;	   
	   $this->user_id = $c->user_id;
	   $this->rows    = $c->rows;
	  
	}
public function getBtn( $a,$p) { 
   
 }
public function aff($p,$url,$cps) {

   return   ' ' ;
  
}	



}

/**********************/

 class menu_archive    {

public function __construct($p, $c)
	{
	   $this->p = $p ;	   
	   $this->user_id = $c->user_id;
	   $this->rows    = $c->rows;
	  
	}
public function getBtn( $a,$p) { 
   
 }
public function aff($p,$url,$cps) {

   return   ' ' ;
  
}	



}


 class menu_realise {

public function __construct($p, $c)
	{
	   $this->p = $p ;	   
	   $this->user_id = $c->user_id;
	   $this->rows    = $c->rows;
	  
	}
public function getBtn( $a,$p) { 
   
 }
public function aff($p,$url,$cps) {

   return   ' ' ;
  
}	



}