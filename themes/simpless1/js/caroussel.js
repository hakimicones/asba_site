/*
    Carousel
*/

 
$('.btn-cat').on('click',function(){
								  
 
		// fetch the class of the clicked item
		var ourClass = $(this).data('cat');
		var parClass  = $(this).parent().parent() ;
		  
		 
		// reset the active class on all the buttons
		$(parClass).find('li').removeClass('active');
		// update the active state on our clicked button
		$(this).parent().addClass('active');
		
		 
			// hide all elements that don't share ourClass
			$('.tab-content').children('div:not(.' + ourClass + ')').addClass('hidden')
			// show all elements that do share ourClass
            $('.tab-content').children('div.' + ourClass).removeClass('hidden');
		 
		return false;
 
  });