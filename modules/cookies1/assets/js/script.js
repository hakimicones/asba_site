
 
$(document).ready(function () 
{

  
    

   inputExist('cookies1') ;
   inputExist('cookies2') ;
   inputExist('cookies3') ;
  
  affichecookiesModal();

  });
  
//

/*************************
 * 
 * **********************/

function inputExist(id) 
{
var input = document.getElementById(id);
if ( input  )   
{

  var cook = getCookie('cookies1');

  

 }

}


// Fonction pour accepter la politique de confidentialité et définir le cookie
function accepter() 
{
      // Définir le cookie d'acceptation avec une expiration d'un an (vous pouvez ajuster cela selon vos besoins)
      document.cookie = 'privacyAccepted=true; expires=' + new Date(Date.now() + 365 * 24 * 60 * 60 * 1000).toUTCString() + '; path=/';      
      // Masquer le popup
      $('#cookiesModal').hide();
	  sendToAjax();
	  
} 

/**************SendToAjax********************/

sendToAjax = function() 
{
	
	var browserName = getBrowserName();
	var donnees = 'acceptation=1&browser='+browserName;
	$.ajax({ 
   		type: 'POST',
		url:  'send_ajx.php?option=cookies',
		data: donnees,
		success:function(response) {
			console.log(response);
			
			}
		});
	
	}
function getBrowserName() {
            var browserName = "Unknown";
            
            if (navigator.userAgent.indexOf("Chrome") != -1) browserName = "Google Chrome";
            else if (navigator.userAgent.indexOf("Firefox") != -1) browserName = "Mozilla Firefox";
            else if (navigator.userAgent.indexOf("Safari") != -1) browserName = "Safari";
            else if (navigator.userAgent.indexOf("MSIE") != -1 || navigator.userAgent.indexOf("Trident") != -1) browserName = "Internet Explorer";
            else if (navigator.userAgent.indexOf("Opera") != -1) browserName = "Opera";

            return browserName;
        }
//******** Affichage Parametrage
   
 parametrer = function() 
   {

          $('#first-content ').fadeOut();
          $('#second-content ').fadeIn();

   } 

/*************************
 * 
 * **********************/
 saveParameter = function() 
   {
    
    var cook2 = document.getElementById('CookCheck2');
    var cook3 = document.getElementById('CookCheck3');
    var cook4 = document.getElementById('CookCheck4');


 
    if (cook2) { cookiesParametrs('cookies1',  !cook2.checked); }
    if (cook3) { cookiesParametrs('cookies2',  !cook3.checked); }
    if (cook4) { cookiesParametrs('cookies3',  !cook4.checked); }


    stopGoogleAnalytics()

    accepter();

          
   } 
/*************************
 * 
 * **********************/
function cookiesParametrs(myCookie , value) 
{

document.cookie = myCookie+'='+value+'; expires=' + new Date(Date.now() + 365 * 24 * 60 * 60 * 1000).toUTCString() + '; path=/';
document.getElementById(myCookie).value = value ;
}

/*************************
 * 
 * **********************/

function getCookie(name) 
{
    function escape(s) { return s.replace(/([.*+?\^$(){}|\[\]\/\\])/g, '\\$1'); }
    var match = document.cookie.match(RegExp('(?:^|;\\s*)' + escape(name) + '=([^;]*)'));
    return match ? match[1] : null;
}
/*************************
 * 
 * **********************/
function affichecookiesModal() 
{
  var intro     = $('#pop-home').css('display');
  var accepter  = getCookie('privacyAccepted');

  if (intro=='none' && accepter != 'true') 
  {
        $('#cookiesModal').show();
  } 
} 



 /*************************
 * Fonction pour arrêter 
 * Google Analytics
 * **********************/ 

function stopGoogleAnalytics() 
{
    // Vérifier si le visiteur a choisi de ne pas accepter Google Analytics
    var cookies1Value = getCookie("cookies1");
    if (cookies1Value !== null && JSON.parse(cookies1Value) === false) {
        // Désactiver Google Analytics ici
        // Par exemple, en supprimant le script Google Analytics du DOM
        var googleSrc = document.getElementById("googleSrc");
        if (googleSrc) {
            googleSrc.parentNode.removeChild(googleSrc);
        }
        var googleTag = document.getElementById("googleTag");
        if (googleTag) {
            googleTag.parentNode.removeChild(googleTag);
        }
        
    }
}

/*************************
* observer
* **********************/
 var observer = new MutationObserver(function(mutationsList, observer) 
 {
    for (var mutation of mutationsList)
    {
         affichecookiesModal();
    }
  }
                                     );


observer.observe(document.getElementById('pop-home'), { attributes: true});
