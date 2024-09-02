
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


 .carousel-control.right {
    right: 0;
    left: auto;
    background-image: -webkit-linear-gradient(left,rgba(0,0,0,.0001) 0,rgba(0,0,0,.5) 100%);
    background-image: -o-linear-gradient(left,rgba(0,0,0,.0001) 0,rgba(0,0,0,.5) 100%);
    background-image: -webkit-gradient(linear,left top,right top,from(rgba(0,0,0,.0001)),to(rgba(0,0,0,.5)));
    background-image: linear-gradient(to right,rgba(0,0,0,.0001) 0,rgba(0,0,0,.5) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#00000000', endColorstr='#80000000', GradientType=1);
    background-repeat: repeat-x;
}
.carousel-control {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    width: 15%;
    font-size: 20px;
    color: #fff;
    text-align: center;
    text-shadow: 0 1px 2px rgba(0,0,0,.6);
    background-color: rgba(0,0,0,0);
    filter: alpha(opacity=50);
    opacity: .5;
}
.carousel-control:focus, .carousel-control:hover {
    color: #fff;
    text-decoration: none;
    filter: alpha(opacity=90);
    outline: 0;
    opacity: .9;
}
.carousel-control .glyphicon-chevron-right, .carousel-control .icon-next {
    right: 50%;
    margin-right: -10px;
}

</style>

<!------/ Slider-------->
         
 			


<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

 {points}
  <div class="carousel-inner">
    
    {images}
  </div>
   
 <!-- Controls -->
  <a class="left carousel-control" href="#carouselExampleControls" role="button" data-slide="prev">
    
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carouselExampleControls" role="button" data-slide="next">
    
    <span class="sr-only">Next</span>
  </a> 


</div>

	<!------/ Slider---------/-->		
     
 
<script>
  $(function() {
     $('#carouselExampleControls').carousel()
  });
</script>