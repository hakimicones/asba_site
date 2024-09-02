<style>
.videopal-hidden {
    position: fixed;
    left: 0;
    top: 0;
    pointer-events: none;
    opacity: .00000001;
	z-index: 5000000;
}
#play {
 	font-size: 48px;
    position: absolute;
    left: 155px;
    top: 50%;
    webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
    -moz-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
	border-radius:50%;
	padding:10px 20px; }
a#play   { color:#0099FF }	
#image  , #image_page    {     position:fixed; z-index: 50000; bottom: {yy}px; {sens}:{xx}px; 
inset: auto auto 0px 0px;
 
 }
#btn-barre {position:absolute; display:none; {sens}:10px; top:-30px; }
#start , #stop , #close {
            display: inline-block;
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

 @media (max-width: 640px)
#image {
    display:none;
} 		
			

</style>
<div id="image{page}"  >
			<video id="video" preload="auto" playsinline="playsinline" webkit-playsinline="webkit-playsinline" class="videopal-hidden">
			
				<source src="video/{video1}" type='video/{ext1}' />
				<source src="video/{video2}" type='video/{ext2}' />
			</video>
			<canvas width="{largeur}" height="{hauteur1}" id="buffer" style=" display:none"></canvas>
			<canvas width="{largeur}" height="{hauteur2}" id="output" style=" background:url(images/{image_video})"></canvas>
			
			
			<div id="btn-barre"  > 
			  <a href="#" id="start"  style="display:none"><i class="fa fa-play" aria-hidden="true" ></i></a>
			  <a href="#" id="stop"><i class="fa fa-pause" aria-hidden="true"></i></a>
			  <a href="javascript:" id="close"><i class="fa fa-times" aria-hidden="true"></i></a> 
			  
			</div>	
	<a href="#" id="play"  ><i class="fa fa-play" aria-hidden="true"></i></a>		
</div>
	
		
		
		
		<script>
		
		
		$( document ).ready(function() {
		
		
		
		
		var plus = {plus} ;
		(function(){
			var outputCanvas = document.getElementById('output'),
				output = outputCanvas.getContext('2d'),
				bufferCanvas = document.getElementById('buffer'),
				buffer = bufferCanvas.getContext('2d'),
				video = document.getElementById('video'),
				width = outputCanvas.width,
				height = outputCanvas.height-plus,
				
				interval;
				video.loop = false;
				//video.poster= buffer.drawImage(video, 0, 0);
				
				//var im = buffer.getImageData(0, 0, width, height);
				//alert(im.toDataURL());
				var v = $("#video").get(0);
				 
				var canvas = document.createElement("canvas");
        		canvas.getContext('2d').drawImage(v, 0, 0, canvas.width, canvas.height);

				 console.log(canvas.toDataURL());
				
				
				 
			function processFrame() {
				buffer.drawImage(video, 0, 0);
				
				// this can be done without alphaData, except in Firefox which doesn't like it when image is bigger than the canvas
				var	image = buffer.getImageData(0, 0, width, height),
					imageData = image.data,
					alphaData = buffer.getImageData(0, height, width, height).data;
					 
				
				for (var i = 3, len = imageData.length; i < len-1; i = i + 4) {
					imageData[i] = alphaData[i-1];
				}
				
				output.putImageData(image, 0, 0, 0, 0, width, height);
			}
			
			 
			video.addEventListener('play', function() {
				clearInterval(interval);
				interval = setInterval(processFrame, 40)
			}, false);
			
			// Firefox doesn't support looping video, so we emulate it this way
			 
			document.getElementById('play').addEventListener('click', function(event) {
			     
				document.getElementById('play').style.display = "none";
				document.getElementById('btn-barre').style.display ="block";
				document.getElementById('output').style.background="none";
				
				
				$("#image{page}").mouseover(function(){		   $("#btn-barre").css("display","block");	});		
				$("#image{page}").mouseout(function(){  $("#btn-barre").css("display","none");	});
				
			 	video.play();
				
				
				event.preventDefault();
			}, false);
			 
			
			document.getElementById('start').addEventListener('click', function(event) {
			    var bg = document.getElementById('output').style.background
				document.getElementById('output').style.background="none";
			 	video.play();
				document.getElementById('start').style.display = "none";
				document.getElementById('stop').style.display = "inline-block";
				
				event.preventDefault();
			}, false);
			
			document.getElementById('stop').addEventListener('click', function(event) {
				video.pause();
				clearInterval(interval);
				event.preventDefault();
				document.getElementById('start').style.display = "inline-block";
				document.getElementById('stop').style.display = "none";
			}, false);
			
			document.getElementById('close').addEventListener('click', function(event) {
				video.pause();
				clearInterval(interval);
				document.getElementById('image{page}').style.display = "none";
			}, false);
			
			
			 
			
			 
		})();
		
		});

 /*
		// Show loading animation.
		  var playPromise = video.play();

		  if (playPromise !== undefined) {
		    playPromise.then(_ => {
		      // Automatic playback started!
		      // Show playing UI.

		      	document.getElementById('play').style.display = "none";
		      	document.getElementById('output').style.background="none";
		      	document.getElementById('btn-barre').style.display ="block";
		    })
		    .catch(error => {
		      // Auto-play was prevented
		      // Show paused UI.

		       


		    });
		  }
*/

 video.onended = function() {
				 document.getElementById('btn-barre').style.display ="block";
				 document.getElementById('start').style.display = "inline-block";
				document.getElementById('stop').style.display = "none";
			};
		 
		</script> 