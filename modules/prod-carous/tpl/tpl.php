<style>
   /* test*/
   #carouselProd .MultiCarousel { float: left; overflow: hidden; padding: 15px  ; width: 100%; position:relative;z-index: 100000; }
   #carouselProd .MultiCarousel .MultiCarousel-inner { transition: 1s ease all; float: left; margin-left:0;}
   #carouselProd.MultiCarousel .MultiCarousel-inner .item { float: left;}
   #carouselProd .MultiCarousel .MultiCarousel-inner .item > div {  margin:15px;}
   #carouselProd .MultiCarousel .leftLst, .MultiCarousel .rightLst { position:absolute; border-radius:50%;top:calc(50% - 20px); }
   #carouselProd .MultiCarousel .leftLst { left:0;  /* test*/ }
   #carouselProd .MultiCarousel .rightLst { right:0; }
   .is_mob  #carouselProd.MultiCarousel .leftLst { left:25px;   }
   .is_mob #carouselProd.MultiCarousel .rightLst { right:25px; }
   #carouselNews .leftLst.over, .MultiCarousel .rightLst.over { pointer-events: none;   }
   
   .is_mob #carouselProd .MultiCarousel .leftLst { left:5px;  /* test*/ }
   .is_mob #carouselProd .MultiCarousel .rightLst { right:5px; }
   .hidden {
   display:none;
   }
</style>
<div id="produits" class="container">
   <!-- Debut Produit Caroussel -->
   <h3 class="ligne" ><span> {titre} </span> </h3>
   <nav class="navbar navbar-expand-lg navbar-light bg-light" >
      <div class="collapse navbar-collapse show  " id="navbarProds">
         <ul class="navbar-nav    ">
            {cats}
         </ul>
      </div>
   </nav>


   <!-- Top content -->
   <div  id="carouselProd">
      <div class="MultiCarousel" data-items="1,2,3,4" data-slide="1" id="MultiCarousel1" data-interval="1000">
         <div class="MultiCarousel-inner" style="transform: translateX(0px); width: 7695px;">  
            {items} 
         </div>
         <button class="leftLst xx carousel-control-prev-icon over"></button>
         <button class="rightLst ll carousel-control-next-icon"></button>
      </div>
    </div>
<!-- Fin Produit Caroussel -->
</div>


<script>
   $(document).ready(function () {
     var itemsMainDiv = ('.MultiCarousel');
     var itemsDiv = ('.MultiCarousel-inner');
     var itemWidth = "";
   
     $('.leftLst, .rightLst').click(function () {
         var condition = $(this).hasClass("leftLst");
         if (condition)
             click(0, this);
         else
             click(1, this)
     });
   
     ResCarouselSize();
   
   
   
   
     $(window).resize(function () {
         ResCarouselSize();
     });
   
     //this function define the size of the items
     function ResCarouselSize() {
         var incno = 0;
         var dataItems = ("data-items");
         var itemClass = ('.item');
         var id = 0;
         var btnParentSb = '';
         var itemsSplit = '';
         var sampwidth = $(itemsMainDiv).width();
         var bodyWidth = $('body').width();
		 
		 console.log(bodyWidth);
         $(itemsDiv).each(function () {
             id = id + 1;
             var itemNumbers = $(this).find(itemClass).length;
             btnParentSb = $(this).parent().attr(dataItems);
             itemsSplit = btnParentSb.split(',');
             $(this).parent().attr("id", "MultiCarousel" + id);
   
   
             if (bodyWidth >= 1200) {
                 incno = itemsSplit[3];
                 itemWidth = (sampwidth / incno ) +1;
				console.log(incno); 
				 
             }
             else if (bodyWidth >= 992) {
                 incno = itemsSplit[2];
                 itemWidth = (sampwidth / incno ) + 1;
             }
             else if (bodyWidth >= 768) {
                 incno = itemsSplit[1];
                 itemWidth = sampwidth / incno;
             }
             else {
                 incno = itemsSplit[0];
                 itemWidth = sampwidth / incno;
             }
             $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
             $(this).find(itemClass).each(function () {
                 $(this).outerWidth(itemWidth);
             });
   
             $(".leftLst").addClass("over");
             $(".rightLst").removeClass("over");
   
         });
     }
   
   
     //this function used to move the items
     function ResCarousel(e, el, s) {
         var leftBtn = ('.leftLst');
         var rightBtn = ('.rightLst');
         var translateXval = '';
         var divStyle = $(el + ' ' + itemsDiv).css('transform');
	//	 console.log('divStyle : '+divStyle)
         var values = divStyle.match(/-?[\d\.]+/g);
         var xds = Math.abs(values[4]);
		 
		 

		 
         if (e == 0) {
             translateXval = parseInt(xds) - parseInt(itemWidth * s);
             $(el + ' ' + rightBtn).removeClass("over");
   		 
             if (translateXval <= itemWidth / 2) {
                 translateXval = 0;
                 $(el + ' ' + leftBtn).addClass("over");
             }
         }
         else if (e == 1) {
		     //
			 let myWidth = 0 ;
			 let nbr = 0 ;
			 $(el).find('.item').not('.hidden').each(function(){
			 
			 myWidth +=$(this).width();
			 nbr++;
			 });
			 
			// console.log('myWidth ', myWidth , 'Nbr ',nbr) ;
//			 console.log('itemsDiv ' ,   $(el).find(itemsDiv).width());
//			 console.log('el ',$(el).width() ) ;
             var itemsCondition = myWidth - $(el).width() ;
             translateXval = parseInt(xds) + parseInt(itemWidth * s);
             $(el + ' ' + leftBtn).removeClass("over");
   console.log('translateXval',translateXval);
    console.log(' itemsCondition - itemWidth / 2',itemsCondition - itemWidth / 2 );
             if (translateXval >= itemsCondition - itemWidth / 2) {
                 translateXval = itemsCondition;
                 $(el + ' ' + rightBtn).addClass("over");
             }
         }
	//	  console.log(translateXval);
         $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -(translateXval) + 'px)');
     }
   
     //It is used to get some elements from btn
     function click(ell, ee) {
         var Parent = "#" + $(ee).parent().attr("id");
         var slide = $(Parent).attr("data-slide");
         ResCarousel(ell, Parent, slide);
		 
		 
     }
   
     $(".btn-cat").click(function(){
          
         var cat  = $(this).data('cat');
   
            $("#carouselProd .item " ).removeClass("hidden");
            $("#carouselProd .item " ).not('.'+cat).addClass("hidden");
   
             
             
   
     });
   
   });
   
   
</script>