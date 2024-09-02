 <div id="produits" class="container">
							  <h3 class="ligne" ><span> {titre} </span> </h3>
							  
							  <nav class="navbar navbar-expand-lg navbar-light bg-light" >
							  
								  <div class="collapse navbar-collapse" id="navbarProds">
										<ul class="navbar-nav mr-auto row ">
										 {cats}
										</ul>  
									</div>
							  </nav>
							  
							  
							  
							  <!-- Top content -->
<style>
.tab-content div.carousel-item.hidden {
    width: 0;
    height: 0;
    overflow: hidden;
	display:none;
    
}

</style>

<div class="top-content">
    <div class="container-fluid">
	
	
	
	
        <div id="{id}" class="carousel slide" data-ride="carousel">	
		
            <div class="carousel-inner row w-100 mx-auto  tab-content" role="listbox"  > 
				
				{items}
				
				
            </div>
			<!-- Fin Cat-2 -->
            <a class="carousel-control-prev" href="#{id}" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>            </a>
            <a class="carousel-control-next" href="#{id}" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>            </a>        </div>
    </div>
</div> 			 
</div>


<script>

window.onload = function () {
$('#{id}').on('slide.bs.carousel', function (e) {
    /*
        CC 2.0 License Iatek LLC 2018 - Attribution required
    */
    var $e = $(e.relatedTarget);
    var idx = $e.index();
    var itemsPerSlide = 5;
    var totalItems = $('.carousel-item').length;
 
    if (idx >= totalItems-(itemsPerSlide-1)) {
        var it = itemsPerSlide - (totalItems - idx);
        for (var i=0; i<it; i++) {
            // append slides to end
            if (e.direction=="left") {
                $('.carousel-item').eq(i).appendTo('.carousel-inner');
            }
            else {
                $('.carousel-item').eq(0).appendTo('.carousel-inner');
            }
        }
    }
});

}
</script>
							