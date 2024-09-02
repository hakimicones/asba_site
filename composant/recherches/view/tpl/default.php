<div class="container   ">

<div class="resultat-rech">
<h4 dir="{rtl}">   {sujet-recherche} :  {rech} </h4>
</div>
<ul id="tabs-menu" class="nav nav-tabs tabd">
<li class="nav-item "><a class="nav-link active" data-toggle="tab" href="#tab1">{pages}  </a></li>
<li class="nav-item "><a class="nav-link " data-toggle="tab" href="#tab2">{fatawa1}</a></li>
<li class="nav-item "><a class="nav-link " data-toggle="tab" href="#tab3">{produits1}</a></li>
<li class="nav-item "><a class="nav-link " data-toggle="tab" href="#tab4">{news}</a></li>
</ul> <!-- fin -->

<div class="tab-content">
<div id="tab1" class="tab-pane active"> 

{contenu}
</div>
 
<div id="tab2" class="tab-pane"> 
{contenufatawa}

</div>
  
<div id="tab3" class="tab-pane"> 
{contenuproduits}
</div>
  
<div id="tab4" class="tab-pane"> 
{contenunews}
</div>
 
 </div>
 
</div> 
<script> if(window.matchMedia("(max-width:360px)").matches)  {   $("#tabs-menu").removeClass("nav-tabs").addClass("nav-pills nav-justified"); } </script> 
<script>
		function cherche(e) {
		
		if ($(e).val()!="") {
		 $("#form-search").submit();
		}
		 
		
		}
		function affDescription(elem, btn ) {
			$( "#"+elem ).slideDown( "slow", function() {
			$( "#"+btn ).css({"display":"none"});
		});}
		function cacheDescription(elem  ) {
 
			$( "#pan-"+elem ).slideUp( "slow", function() {
			$( "#btn-"+elem ).fadeOut(300).css({"display":"inline-block"});
		});}
		</script>
