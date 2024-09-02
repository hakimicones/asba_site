 function openNav() {
  document.getElementById("mySidenav").style.width = "350px";
  
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  
}


$('#openSidebarMenu').click(function(){
									 
									if ($('#top_navis_mob').hasClass('first')) $('#top_navis_mob').removeClass('first');
									else $('#top_navis_mob').addClass('first');
									 
									 
									 });