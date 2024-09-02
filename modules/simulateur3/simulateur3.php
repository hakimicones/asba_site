<?php 
class simulateur3 {
	private $cx ;
	private $obj ;
	private $lg ;
	public $li ;
	public $mess = 2 ;
	public $params;
	public $script ;

public function __construct($c,$obj,$lg)
	{
	 $this->cx  = $c; 
	 $this->obj = $obj ;
	 $this->lg = $lg;
	 $this->params  = $this->obj->param;

 
	}
	   
	 
	 
	  
	
	
	
	public function affiche() { 


 


    $type = ($this->lg !='ar') ? ' 
                                   <input name="livret" type="radio" value="1" /> {oumnyati}
                                  <input name="livret" type="radio" value="2" />{hadiyati}
                                  <input name="livret" type="radio" value="3" />{omrati}'
                                  :
                                  '
                                    {oumnyati}<input name="livret" type="radio" value="1" />
                                  {hadiyati}<input name="livret" type="radio" value="2" />
                                  {omrati}<input name="livret" type="radio" value="3" />
                                  ';

 $mess = 'text_'.$this->lg;    
 $messRes = 'messRes_'.$this->lg;
;
                              
	
	$html = '<style>

  
    #inputtextmontant {
      border: 1px solid #ced4da;
      }
      label{color:#495057}
       #divsimulation3{
      margin-top: 30px;
    background-color: #ffff;
    padding: 20px;
    }

    .Chiffres { font-family: sans-serif;}
    </style>
     

      <div class="container" id="divsimulation3">
<div class=""> '.$this->params->$mess.' </div>
<hr>
  <div class="form-group">
    <label >{typecompte}</label>
      <select class="form-control" onchange="typecompte() "id ="selcettypecompte">
          <option value="1" selected="selected" > {livretsepargne}</option>
          <option value="2">{bons-investissements}</option>
          <option value="3">{comptes-epargnes} </option>
      </select>
  </div>
  <div class="form-group" id="type-div">
 
   '.$type.'
  </div>
   <div class="form-group">
    <label >{montant-depose}</label>
     <input type="text"  class="form-control-plaintext" id="inputtextmontant" >

    <select class="form-control d-none "  id="inputselectmontant">
     <option value="100000" selected="selected">100.000  {da}</option>
     <option value="500000">500.000  {da}</option>
     <option value="1000000">1.000.000  {da}</option>
     <option value="5000000">5.000.000 {da}</option>
</select>
  </div> 

   <div class="form-group d-none" id="duree-div">
    <label >{dure}</label>
     <select class="form-control" id="blockcompte">
      <option value="3" selected="selected"> 3 {mois}</option>
      <option value="6"> 6 {mois}</option>
      <option value="12">12 {mois} </option>
      <option value="18">18 {mois} </option>
      <option value="24">24 {mois} </option>
      <option value="36">36 {mois} </option>
      <option value="48">48 {mois} </option>
      <option value="60">60 {mois} </option>
    </select>
  </div>
  <button type="button" class="btn btn-secondary" onclick="simuler()">{calcul1}</button>
  <div  >
  <div id="res"></div>
  <h3 id ="resultas2" class="Chiffres" >  </h3>
  <h3 id ="resultas" class="Chiffres" >   </h3>
  <h3 id ="resultas3" class="Chiffres" >   </h3>
  <h3 id ="messRes" class=""></h3>

  </div>

</div>
 <script>
 function typecompte(){

  var c=document.getElementById("selcettypecompte").value; 
  var text = document.getElementById("inputtextmontant");
  var selcet = document.getElementById("inputselectmontant");
  var typediv =  document.getElementById("type-div");
  var duree  = document.getElementById("duree-div");


  var blockcompte = document.getElementById("blockcompte");
   
switch(c) {
  case "1":
    selcet.className="form-control d-none";
    text.className="form-control-plaintext d-block";
    duree.className="form-group d-none";
    typediv.className="form-group";





    break;
  case "2":
      selcet.className="form-control d-block";
      text.className="form-control-plaintext d-none";
      duree.className="form-group ";
    typediv.className="form-group d-none";      
    break;
  case "3":
      selcet.className="form-control d-none";
    text.className=" form-control-plaintext d-block";
    duree.className="form-group ";
    typediv.className="form-group d-none";    

}
 }
 function simuler(){

var formatter = new Intl.NumberFormat("de-DE", {
  style:  "currency",
  currency: "Dzd",
});

 
  var c=document.getElementById("selcettypecompte").value; 
  var text = document.getElementById("inputtextmontant").value;
  var select = document.getElementById("inputselectmontant").value;
  var t = document.getElementById("blockcompte").value;
  var m=0; 
  var p=00; 
  var taux = '.$this->params->tc.'
    if (c==1){
          m  =(((text*taux*12)/1200));
      var m3 =(((text*taux*3)/1200));

       document.getElementById("res").innerHTML =   "<hr>" ;
       document.getElementById("resultas2").innerHTML =   "{montant-remuneration-an} : "+formatter.format(m);

        document.getElementById("resultas3").innerHTML = "{montant-remuneration-3} : "+ formatter.format(m3);; 
        document.getElementById("resultas").innerHTML = "";
         document.getElementById("messRes").innerHTML =  "<hr>'.$this->params->$messRes.'";


    }else {
 
      switch(t) {
                case "3":
                  p='.$this->params->t3.';
                  break;
                case "6":
                  p='.$this->params->t6.';
                  break;
                case "12":
                  p='.$this->params->t12.';
                  break;
                case "18":
                  p='.$this->params->t18.';
                  break;
                case "24":
                  p='.$this->params->t24.';
                  break;
                case "36":
                  p='.$this->params->t36.';
                  break;
                case "48":
                   p='.$this->params->t48.';
                  break;
                case "60":
                  p='.$this->params->t60.';
                  break;
        }
      if(c==2){
     
      m  = (((select*p*t)/1200));
      m2 = (((select*p*12)/1200));
      m3 = (((select*p*3)/1200));

      document.getElementById("res").innerHTML       =   "<hr>" ;
      document.getElementById("resultas3").innerHTML = "{montant-remuneration-3} : "+ formatter.format(m3);
      document.getElementById("resultas2").innerHTML = "{montant-remuneration} : <span>"+ formatter.format(m)+"</span>";
      document.getElementById("resultas").innerHTML = "{montant-remuneration-an} : "+ formatter.format(m2);
      document.getElementById("messRes").innerHTML =  "<hr>'.$this->params->$messRes.'";


      }     else
      {  
      m  = (((text*p*t)/1200)); 
      m2 = (((text*p*12)/1200));
      m3 = (((text*p*3)/1200));
       
      document.getElementById("res").innerHTML        =   "<hr>" ;
      document.getElementById("resultas3").innerHTML = "{montant-remuneration-3} : "+ formatter.format(m3);
      document.getElementById("resultas2").innerHTML  =   "{montant-remuneration} : "+formatter.format(m) ; 
      document.getElementById("resultas").innerHTML   =   "{montant-remuneration-an} : "+  formatter.format(m2);
      document.getElementById("messRes").innerHTML =  "<hr>'.$this->params->$messRes.'";

}
    }

 

 }
 </script>
';
        

		return $html;
	}
}


?>
		
 

