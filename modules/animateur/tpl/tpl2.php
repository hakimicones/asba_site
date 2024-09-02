<style>
.btn-anim { float:{sens} ; position: absolute;{sens} : 0 ; }
#image  , #image_page    {     position:fixed; bottom: {yy}px; {sens}:{xx}px;}
#image_page {  bottom:  0px;}
#anim {  bottom: 0;  position: absolute;}
#btn-play , #btn-close {display: inline-block;
			width: 40px;
			height: 40px;
			margin: 0 5px;
			padding: 9px 11px;
			border: 2px solid #aaa;
			border-radius: 50%;
			color: #777;
			background-color: #eee;
			cursor: pointer;
			font-size: 16px;
			text-decoration: none;}

#image  , #image_page    {     position:fixed; bottom: {yy}px; {sens}:{xx}px;}
</style>
<div id="image{page}"  >
<div class="btn-anim">
<a onclick="LanceAnim();" id="btn-play"><i class="fa fa-play" aria-hidden="true"></i></a>
<a id="btn-close"><i class="fa fa-times" aria-hidden="true"></i></a>
</div>
<img id="anim-img" src="images/{dossier-image}/{debut}.png" height="380" >
 
</div>

			 
		
			 
<script>

$( document ).ready(function() {
   var h = $('#anim-img').height();
   $('#image{page}').height(h);
});
$('#btn-play').click(function(){
		$('#btn-play').css("display","none");
			LanceAnim();
	     
			});

		$('#btn-close').click(function(){
		 
 		 
             $("#image{page}").css("display","none");
			 
			 
		}); 
//audio.oncanplaythrough =LanceAnim ;
$.fn.preload = function() {
    this.each(function(){
        $('<img/>')[0].src = this;
    });
}
	 
	var audio = new Audio('audio/{audio}');
	var nbr = {nbr};
	var deb = {debut};
	//*********** Close 
	$('#btn-close').click(function(){
		 
 		 
             $("#image{page}").css("display","none");
			 audio.pause();
			 audio.currentTime = 0;
			 
		}); 
	
	// Usage:
	var imgs = [] ;
	for (var ind = deb; ind < nbr + 1 ; ind++) {
	  imgs.push('images/{dossier-image}/'+ind+'.png');
	}

	$(imgs).preload();
	function LanceAnim() {
		
		var ind = {debut} ; 
		tID = setInterval ( () => {
		ind++;
		
		if (ind>nbr) {  
		tID = 0 ; 		
		audio.pause();
		audio.currentTime = 0;
		$('#btn-play').css("display","block");
		
		} else {
		var img = 'images/{dossier-image}/'+ind+'.png';
		//$('#anim').attr("src",img);
		document.getElementById("anim-img").src=img;
		 
		
		
		}
		
		} , {freq}); 
	   
		audio.play();
		 }
		 
		 
		 
		$(window).load(function() {	
		
		
		 
		
		
	$('#image').fadeIn();
	
	
})
</script>		 