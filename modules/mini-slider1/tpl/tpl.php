
<style>

.carousel-item {
    position: relative;
    display: none;
    float: left;
    width: 100%;
    margin-right: -100%;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    transition: -webkit-transform .6s ease-in-out;
    transition: transform .6s ease-in-out;
    transition: transform .6s ease-in-out,-webkit-transform .6s ease-in-out;
}
.carousel-indicators {
     
    bottom: -25px;
     
}
.carousel-indicators li {
    
    background-color: #666 !important;
     
}
.carousel-indicators .active {
  
    background-color: #000;
	 
}
#carouselExampleControls {
position: absolute;
    top: 46px;
    left: 0;
    width: 100%;
	background:url(images/flex-slider/{bg})	;
	border-bottom: 2px solid #eee;
}
.img-slider { height:140px;}
 .carousel-item.active {
    display: block;
    text-align: center;
}
 
 @media (min-width: 1200px)   { 
 .slider {
		
		 width:100%;
 
 }
 .rslides {   }
 .center {    }
 
 
 }

</style>

<!------/ Slider-------->
         
 			


<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

 <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
     
  </ol>
  <div class="carousel-inner">
    
    {images}
  </div>
   
</div>

	<!------/ Slider---------/-->		
     
 
<script>
  $(function() {
     $('.carousel').carousel()
  });
</script>