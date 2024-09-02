 function getMenu(curr , id ) {
	 
	 switch(id) {
  case 'page1':
    anim_bg(1);
	if (typeof(getMenu1) == "function")  getMenu1(curr);
    break;
  case 'page2':
    anim_bg(2);
 
    if (typeof(getMenu2) == "function")getMenu2(curr);
	 
    break;
	
   case 'page3':
   anim_bg(3);
     
    if (typeof(getMenu3) == "function") getMenu3(curr);
	 
    break;
	
  case 'page4':
 
	anim_bg(4);
    if (typeof(getMenu4) == "function") getMenu4(curr);
	 
    break;
  case 'page5':
   
  anim_bg(5);
    if (typeof(getMenu5) == "function") getMenu5(curr);
	 
    break;
  case 'page6':
  
  anim_bg(6);
    if (typeof(getMenu6) == "function") getMenu6(curr);
	 
    break;
  case 'page7':
  anim_bg("");
    if (typeof(getMenu7) == "function") getMenu7(curr);
	 
    break;	 
	 
 
  default:
    
	anim_bg(""); 
   break;		
	
}
}	

function anim_bg(id) {
	
 
	
	
}

 

$(document).ready(function() {
	
	 
	$(".bg_cont"    ).attr("src","modules/menu-warda/img/bg_content_mobile.png");
	 
	
	 
});

function ouvreBtn() {
	
	 
	$("#nav1" ).stop().animate({left:10, top:60}, 600, 'easeOutBack') ;
	$("#nav2" ).stop().animate({left:110, top:200}, 800, 'easeOutBack') ;
	$("#nav3" ).stop().animate({left:200, top:330}, 1000, 'easeOutBack') ;
	$("#nav4" ).stop().animate({left:10, top:330}, 1200, 'easeOutBack') ;
	$("#nav5" ).stop().animate({left:110, top:470}, 1400, 'easeOutBack') ;
	$("#nav6" ).stop().animate({left:200, top:60}, 600, 'easeOutBack') ;
	
	
	
	
	
	}

function fermeBtn() {
	
	for (i=1;i<7;i++) {
	 
		
			$("#nav"+ i   ).stop().animate({left:110, top:200}, 600, 'easeOutBack') ;
			
			 
	
	}
	
}

$("#menu  li ").click(function(){

affwarda(this)
	 
});

$(".social  li a").click(function(){
alert(1);
affwarda(this)
	 
});

//
function affwarda(elem) {
	
	var url =  $("#url").val(); 	
var id = elem.id	



fermeBtn();
var page = $("."+id).attr("href").replace(url+'#!/',"");

getMenu($("#"+page) , page )
//console.log($("."+id).attr("href") );
 
$("#"+page).addClass("mobile" );
 var h = $(window).height() - ($(window).height() / 5  )
 
 var t = h*0.87
 

 
$("#"+page).stop().animate({left:10, top:27}, 50, 'easeOutBack') ;


$("#"+page+"  .bg_cont").stop().animate({left:0, top:0,width:'98%' , height:h}, 600, 'easeOutBack') ;
$("#logoId").stop().animate({width:60 , height:80}, 600, 'easeOutBack') ;
$("#"+page+' .pad').css("display",'block');
$("#"+page+' .back').css("display",'block');
$("#"+page+' .back').attr("data-pad",page );
$("#"+page+' .back').stop().animate({left:0, top:t}, 800, 'easeOutBack') ; 
 
$("#"+page+' .pad').stop().animate({opacity:1}, 800, 'easeOutBack') ;


$("#"+page+' .back img').stop().animate({width:80, height:91.45, left:15, top:15}, 600, 'easeOutBack')



	
	
	}

$(".map_back").click(	function(){  
								 
								 
								 
								 
								 
//$(".pages").stop().animate({left:10, top:27}, 50, 'easeOutBack') ;

$(".pages  .bg_cont").stop().animate({left:0, top:0,width:0 , height:0}, 600, 'easeOutBack') ;

$("#logoId").stop().animate({width:100 , height:140}, 600, 'easeOutBack') ;
$('.pages .pad').css("display",'none');
$(' .back').css("display",'none');
$(' .back').attr("data-pad",'' );
$(' .back').stop().animate({left:0, top:0}, 800, 'easeOutBack') ; 
 
$('.pages .pad').stop().animate({opacity:0}, 800, 'easeOutBack') ;

$('.back img').stop().animate({width:80, height:91.45, left:15, top:15}, 600, 'easeOutBack')


ouvreBtn();
								  
						  
								 /*
								 $("#"+page).removeClass("mobile" );
								 
								 $("#bg").animate({opacity: 0},500);
								 $("#bg").css({'background':"url('themes/warda2/images/BG-25.png') no-repeat center -48px "});   
								 $("#bg").animate({opacity: 1},10);							 
								 $(".bg").animate({opacity: 1},1000);
								 */
								 
								 });




$(".back").click(	function(){  
								 
								 
								 
								 
								 
//$(".pages").stop().animate({left:10, top:27}, 50, 'easeOutBack') ;

$(".pages  .bg_cont").stop().animate({left:0, top:0,width:0 , height:0}, 600, 'easeOutBack') ;

$("#logoId").stop().animate({width:100 , height:140}, 600, 'easeOutBack') ;
$('.pages .pad').css("display",'none');
$(' .back').css("display",'none');
$(' .back').attr("data-pad",'' );
$(' .back').stop().animate({left:0, top:0}, 800, 'easeOutBack') ; 
 
$('.pages .pad').stop().animate({opacity:0}, 800, 'easeOutBack') ;

$('.back img').stop().animate({width:80, height:91.45, left:15, top:15}, 600, 'easeOutBack')


ouvreBtn();
								  
						  
								 /*
								 $("#"+page).removeClass("mobile" );
								 
								 $("#bg").animate({opacity: 0},500);
								 $("#bg").css({'background':"url('themes/warda2/images/BG-25.png') no-repeat center -48px "});   
								 $("#bg").animate({opacity: 1},10);							 
								 $(".bg").animate({opacity: 1},1000);
								 */
								 
								 });


$('.back a').hover(function(){
		$('.back img').stop().animate({width:165, height:177, left:5, top:5}, 600, 'easeOutBack')					  
	}, function(){
		$('.back img').stop().animate({width:80, height:91.45, left:15, top:15}, 600, 'easeOutBack')					  
	})


//content switch
	var content=$('#content'),
		nav=$('.menu');
	nav.navs({
		useHash:true	
	})	
	content.tabs({
		actFu:function(_){
			if (_.prev && _.curr) {
				fl_cont=false;
				_.prev.find('.pad').stop().animate({opacity:0}, function(){
					$(this).css({display:'none'});
					_.prev.find('.back').stop().animate({opacity:0}, function(){$(this).css({top:212, left:163, opacity:1, display:'none'}); $(this).css({opacity:'none'})})
					_.prev.find('.bg_cont').stop().animate({top:303, left:281, width:0, height:0}, 600, 'easeInBack', function(){	
																															   
						_.curr.find('.back').css({top:384, left:477, opacity:0, display:'block'}).stop().animate({opacity:1}, function(){$(this).css({opacity:'none'})})
						_.curr.find('.bg_cont').stop().animate({top:0, left:0, width:380, height:606}, 600, 'easeOutBack', function(){
																																								
							_.curr.find('.pad').css({display:'block'}).stop().animate({opacity:1}, function(){
																											 
								 $(this).css({opacity:'none'});
								 
								fl_cont=true;
							})																										
						})	
					})	
				})																											   
			} else {
				if (_.curr) {
					fl_cont=false;
					$('#navigation').css({display:'none'})
					$('#menu > li').stop().animate({top:239, left:385},1000,'easeInBack', function(){
						$(this).find(' > img').stop().animate({top:92, left:88, width:0, height:0},1000,'easeInBack', function(){})
						$('#menu > li').css({display:'none'});
						$('h1').stop().animate({top:-16, left:44}, 600, 'easeInBack')
						_.curr.find('.back').css({display:'block'});
						 
						
						_.curr.find('.back').stop().animate({top:384, left:477}, 600, 'easeOutBack', function(){
							_.curr.find('.bg_cont').stop().animate({top:0, left:0, width:385, height:606}, 600, 'easeOutBack', function(){
							/*	*/	
							var cu = _.curr	
							 
							 _.curr.find('.pad').css({opacity:1, display:'block'});	
							 
							 
							 
							 
			             	getMenu(cu,cu[0].id);
							
							 			
						
								
							$( ".h_btn" ).on("click",function() {
								   var $this   = $(this) 
							         
									
									
									
							 
								});	
								
							//$("#yourElement").after("<p>Element was there</p>").appendTo("body");
							
							var idp = _.curr[0].id ;
							$( ".page-title").appendTo(_.curr.find(".pad .blog "));
							var l = 0 ;
							var t = 0 ;
							
							  
							 
							
																																		
								_.curr.find('.pad').css({display:'block'}).stop().animate({opacity:1}, function(){
									 $(this).css({opacity:'none'});
									 
									fl_cont=true;
								})																										
							})																	
						})
					})
					fl=false;
					$('.navigation area').mouseleave()
				}
				if (_.prev) {
					fl_cont=false;
					_.prev.find('.pad').stop().animate({opacity:0}, function(){
						$(this).css({display:'none'});
						_.prev.find('.bg_cont').stop().animate({top:303, left:281, width:0, height:0}, 600, 'easeInBack', function(){
							$('h1').stop().animate({top:190, left:329}, 600, 'easeInBack')
							_.prev.find('.back').mouseleave();
							_.prev.find('.back').stop().animate({top:212, left:163}, 600, 'easeOutBack', function(){
								_.prev.find('.back').css({display:'none'});
								$('#menu > li').css({display:'block'});
								$('#navigation').css({display:'block'})
								var num=$('#menu > li').length;
								for (i=0;i<num;i++) {
									var th=$('#menu > li').eq(i);
									th.stop().delay(220*i).animate({top:th.data('top'), left:th.data('left')}, 600, 'easeOutBack')
									th.find(' > img').stop().delay(220*i).animate({top:15, left:15, width:145, height:157},600,'easeOutBack', function(){})
								}
								fl_cont=true;
							})
						})	
					})	
				}
			}
		},
		preFu:function(_){						
			$('#content > ul > li').css({position:'absolute'})
			$('.bg_cont').css({top:303, left:281, width:0, height:0})
			$('.pad').css({opacity:0, display:'none'})
			$('.back').css({display:'none'})
			
		}
	})
	$("a#news_btn").click(	function(){   
									 
									 
							  news_open =  (news_open)? false : true ;	 
							 
							 var r_close    = (window.matchMedia("(max-width:640px)").matches)  ? 0 : -340 ;
							 var r_open     = (window.matchMedia("(max-width:640px)").matches)  ? -1000 : 0 ;
							 var right = (news_open) ? r_open 	 : r_close ; 
							 
							 
							        
									 $("#news").animate({right: right },500);   });
