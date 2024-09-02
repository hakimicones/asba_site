<div class="container">  

<ul class="nav nav-tabs ar" id="tabs" role="tablist" dir="rtl">
	<li class="nav-item selected">
		<a class="nav-link   show active" href="#menu0" role="tab" aria-controls="menu0" aria-selected="true">  {simul vehicule} </a>
	 </li>
	<li class="nav-item ">
		<a class="nav-link  " href="#menu1" role="tab" aria-controls="menu1" aria-selected="false">  {simul immobilier}	</a>
				</li>
				 
				
				</ul>
				
				
	<div class="tab-content" id="SimTabContent">
		<div id="menu0" class="tab-pane fade  show active">
		
		{simul1}
		
		</div>


		<div id="menu1" class="tab-pane fade "> 
		{simul2}
		
		</div>
	 

	</div>

</div>

 
<script>
		 
			   
			 $("#tabs li a").click(function (e) { 
					e.preventDefault();
					$(".nav-item").removeClass("selected");
					$(this).parent().addClass("selected");
					
					$(this).tab("show");
				});
			 
		
       </script>