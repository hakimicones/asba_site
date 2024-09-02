<style>
#video-pan .carousel-inner  {
    min-height: 250px;
}
.tab-content div.carousel-item.hidden {
    width: 0;
    height: 0;
    overflow: hidden;
	display:none;
    
}
.carousel-inner .active + .carousel-item + .carousel-item {
    display: none;
}
#video-pan   h2,#video-pan h3,#video-pan h4,#video-pan h5,#video-pan h6 ,#video-pan span , #video-pan p  {
    color: #FFFFFF;
}
.carousel-item , .carousel-inner .active + .carousel-item   { display:none;}

#video-pan  .carousel-control-prev-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' width='8' height='8' viewBox='0 0 8 8'%3e%3cpath d='M5.25 0l-4 4 4 4 1.5-1.5L4.25 4l2.5-2.5L5.25 0z'/%3e%3c/svg%3e");
}
#video-pan .carousel-control-next-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' width='8' height='8' viewBox='0 0 8 8'%3e%3cpath d='M2.75 0l-1.5 1.5L3.75 4l-2.5 2.5L2.75 8l4-4-4-4z'/%3e%3c/svg%3e");
}



{my-styles}
</style>    

<!--	Video Pan 		-->	
 
<div id="video-pan" class="carousel slide" data-ride="carousel" data-interval="10000" data-pause="hover" >
  <div id="video-inner"  class="carousel-inner ">
     
      {videos}
     
  </div>
  <a class="carousel-control-prev" href="#video-pan" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#video-pan" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>				
     
       
   
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      
      <div class="modal-body">
       <span id="loading" class="material-icons">
				<svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
				   <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
				</svg>
		</span>
        <!-- 16:9 aspect ratio -->
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
</div>
        
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>        </button> 
      </div>
 </div></div>
</div>

    
 
            
<!--fin video-pan-->

<script>
$('#video-pan').on('slid.bs.carousel', function (e) {

    var img = $(this).find(".active").data("img") ;
    
     $('#video-inner').css("background-image", 'url("'+img+'")' ) ;

   

     
});



 

window.onload = function () {

//   $('#video-pan').carousel({
//   interval: 2000 ,
//   pause : false
// });


console.log('------------');


  var el = function (id) {
  var $videoSrc;
  
    return document.getElementById(id);
  };
   $('.stm_fancy-iframe').click(function(){
   $('#loading').css('display','block');
   var myModal = new bootstrap.Modal(document.getElementById('myModal'), {
  	keyboard: false
	});
    
	
	$videoSrc = $(this).data( "url" );
	 $("#video").attr('src',$videoSrc); 
   myModal.show();
   
   });
   
   console.log('------------'); 
   
   $('#myModal').on('hide.bs.modal', function (e) {
    // a poor man's stop video
  //  $("#video").attr('src',$videoSrc); 
});
  
  }
</script>							