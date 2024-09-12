function masquerBanniereCookies() {
    document.getElementById("cookieBanner").style.display = "none";
  }

  //onclick="cookiesparametrage()" id="cookiesparametrage"
//CoockiesParametrage
  function cookiesparametrage() {
    let cookiePreferencesPopup = document.getElementById('cookiePreferencesPopup');
    let iframecookiePreferencesPopup = cookiePreferencesPopup.contentDocument || cookiePreferencesPopup.contentWindow.document;
  
   if (iframecookiePreferencesPopup.getElementById("CoockiesParametrage").style.display == "none") {
       iframecookiePreferencesPopup.getElementById("CoockiesParametrage").style.display = "block";
       document.getElementById("cookiePreferencesPopup").style.height = "90%";
       console.log("checked");
   } else {
       iframecookiePreferencesPopup.getElementById("CoockiesParametrage").style.display = "none";
       console.log("unchecked");
       document.getElementById("cookiePreferencesPopup").style.height = "60%";
   }
   if (iframecookiePreferencesPopup.getElementById("Analytic").style.display == "none"  &&  iframecookiePreferencesPopup.getElementById("CoockiesParametrage").style.display == "none")
   {
     document.getElementById("cookiePreferencesPopup").style.height = "50%";
   }
  }


  function checkbox() 
  {
    // Obtenir la référence à l'iframe
     var cookiePreferencesPopup = document.getElementById('cookiePreferencesPopup');
     var iframecookiePreferencesPopup = cookiePreferencesPopup.contentDocument || cookiePreferencesPopup.contentWindow.document;
  
    if (iframecookiePreferencesPopup.getElementById("Analytic").style.display == "none") {
        iframecookiePreferencesPopup.getElementById("Analytic").style.display = "block";
        document.getElementById("cookiePreferencesPopup").style.height = "90%";
        console.log("checked");
    } else {
        iframecookiePreferencesPopup.getElementById("Analytic").style.display = "none";
        console.log("unchecked");
        document.getElementById("cookiePreferencesPopup").style.height = "60%";
    }

    if (iframecookiePreferencesPopup.getElementById("Analytic").style.display == "none"  &&  iframecookiePreferencesPopup.getElementById("CoockiesParametrage").style.display == "none")
    {
      document.getElementById("cookiePreferencesPopup").style.height = "50%";
    }
}

function setCookie(nom, valeur, jours) {
    var date = new Date();
    date.setTime(date.getTime() + (jours * 24 * 60 * 60 * 1000));
    var expiration = "expires=" + date.toUTCString();
    document.cookie = nom + "=" + valeur + ";" + expiration + ";path=/";
}


  function desactiveCookies()
  {
    var cookiePreferencesPopup = document.getElementById('cookiePreferencesPopup');
    var iframecookiePreferencesPopup = cookiePreferencesPopup.contentDocument || cookiePreferencesPopup.contentWindow.document;
        

    
        var caseCocher= iframecookiePreferencesPopup.getElementById("maCase");
        if(caseCocher.checked){
          
          setCookie('cookiePreference', 'accepted', 365); 
     
        }else{

          const cookiesToDelete = ["_gat_gtag_UA_140392065_1", "_gid", "_ga"];
          deleteCookies(cookiesToDelete);
          setCookie('cookiePreference', 'rejected', 365);
        }
  }

  function deleteCookies(cookieNames) {
    const expirationDate = 'Thu, 01 Jan 1970 00:00:00 GMT';
  
    if (Array.isArray(cookieNames)) {
      cookieNames.forEach((cookieName) => {
        document.cookie = `${cookieName}=;expires=${expirationDate}`;
      });
    } else {
      document.cookie = `${cookieNames}=;expires=${expirationDate}`;
    }
  }

  // Fonction pour accepter tous les cookies
  function toutAccepter() {
  
    setCookie('cookiePreference', 'accepted', 365); 
    masquerBanniereCookies();
    console.log("Tous les cookies acceptés");
  }

  function PolicyProfunc(){

    var cookiePreferencesPopup = document.getElementById('cookiePreferencesPopup');
    var iframecookiePreferencesPopup = cookiePreferencesPopup.contentDocument || cookiePreferencesPopup.contentWindow.document;
  
	var Policy = document.getElementById("Policy");
    Policy.style.display = "block";
	fermerPreferencesPopup();
    enregistrerPreferences();
  }

  // Fonction pour afficher les paramètres des cookies
  function afficherParametresCookies() {
    console.log("Affichage des paramètres des cookies");
	var Policy = document.getElementById("Policy");
    Policy.style.display = "none";

    var cookieBanner = document.getElementById("cookieBanner");
    cookieBanner.style.display = "none";


	var popupPreferences = document.getElementById("cookiePreferencesPopup");
    popupPreferences.style.display = "block";
  }


  function afficherParametresCookiesPol() {
    console.log("Affichage des paramètres des cookies");
	var Policy = document.getElementById("Policy");
    Policy.style.display = "none";

    var cookieBanner = document.getElementById("cookieBanner");
    cookieBanner.style.display = "none";


	var popupPreferences = document.getElementById("cookiePreferencesPopup");
    popupPreferences.style.display = "block";
  }

    // Fonction pour fermer le pop-up des parametres de cookies
	function fermerPreferencesPopup() {
    //var popupPreferences = document.getElementById("savePreferencesButton");
    //popupPreferences.style.display = "none";
    
    document.getElementById("cookieBanner").style.display = "none";

	//var popupPreferences = document.getElementById("cookiePreferencesPopup");
   // popupPreferences.style.display = "none";
	
  }

  function RefuseCookies() {
    //var popupPreferences = document.getElementById("savePreferencesButton");
    //popupPreferences.style.display = "none";
    const cookiesToDelete = ["_gat_gtag_UA_140392065_1", "_gid", "_ga"];
    deleteCookies(cookiesToDelete);
    setCookie('cookiePreference', 'rejected', 365);
    document.getElementById("cookieBanner").style.display = "none";

	//var popupPreferences = document.getElementById("cookiePreferencesPopup");
   // popupPreferences.style.display = "none";
	
  }

  //RefuseCookies

  function enregistrerPreferences() {


  var popupPreferences = document.getElementById("cookiePreferencesPopup");
  const userCookiePreference = getCookie('cookiePreference');
  if (!userCookiePreference) {
    //cookieBanner.style.display = 'block';

    setCookie('cookiePreference', 'accepted', 365); 
  }
  popupPreferences.style.display = "none";


  fermerPreferencesPopup();
  masquerBanniereCookies();
}

  function StatistiqueSite() {
    document.cookie = "statistiqueUsageSite=true; expires=Thu, 01 Jan 2024 00:00:00 UTC; path=/";
	document.cookie = "optionldcs=true; expires=Wed, 01 Augt 2024 00:00:00 UTC; path =agb.dz";
	
    masquerBanniereCookies();
    console.log("parametreschoisi");
  }

  function getCookie(name) {
    const cookieName = `${name}=`;
    const cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
      let cookie = cookies[i].trim();
      if (cookie.indexOf(cookieName) === 0) {
        return cookie.substring(cookieName.length, cookie.length);
      }
    }
    return null;
  }

  function setCookie(name, value, days) {
    const expires = new Date();
    expires.setTime(expires.getTime() + days * 24 * 60 * 60 * 1000);
    document.cookie = `${name}=${value};expires=${expires.toUTCString()};path=/`;
  }

  // Liaison des fonctions aux boutons en utilisant les id

  cookieBanner.onload = function() {

    var cookieBanner = document.getElementById('cookieBanner');
  var iframecookieBanner = cookieBanner.contentDocument || cookieBanner.contentWindow.document;

//   var name = "_gat_gtag_UA_140392065_1";
//   document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";

//   var name2 = "_gid";
//   document.cookie = name2 + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";

//   var name3 = "_ga";
//   document.cookie = name3 + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";



  

  var cookiePreferencesPopup = document.getElementById('cookiePreferencesPopup');
  var iframecookiePreferencesPopup = cookiePreferencesPopup.contentDocument || cookiePreferencesPopup.contentWindow.document;

  var PolicyPro = document.getElementById('Policy');
  var iframePolicy = PolicyPro.contentDocument || PolicyPro.contentWindow.document;


  
  iframecookieBanner.getElementById("acceptAllButton").addEventListener("click", toutAccepter);
  iframecookieBanner.getElementById("cookieSettingsButton").addEventListener("click", afficherParametresCookies);
  iframecookieBanner.getElementById("RefuseCookies").addEventListener("click", RefuseCookies);
  
 
  //id="cookieSettingsButton" class="button" onclick="afficherParametresCookies()"
  iframecookiePreferencesPopup.getElementById("savePreferencesButton").addEventListener("click", enregistrerPreferences);


  iframecookiePreferencesPopup.getElementById("maCase").addEventListener("change", desactiveCookies );

 //onclick="cookiesparametrage()" id="cookiesparametrage"
 
  iframecookiePreferencesPopup.getElementById("aideAnalytics").addEventListener("click", checkbox);


  //onclick="checkbox()" id="aideAnalytics"
  iframecookiePreferencesPopup.getElementById("Policy").addEventListener("click", PolicyProfunc);
  iframecookiePreferencesPopup.getElementById("cookiesparametrage").addEventListener("click", cookiesparametrage);
  iframePolicy.getElementById("cookieSettingsButtonPol").addEventListener("click", afficherParametresCookiesPol);

  // Vérifiez si l'utilisateur a déjà accepté ou refusé les cookies
const userCookiePreference = getCookie('cookiePreference');

// Si l'utilisateur n'a pas encore fait de choix, affichez la bannière/modal
if (!userCookiePreference) {
  //cookieBanner.style.display = 'block';
  document.getElementById("cookieBanner").style.display = "block";
}else{
  document.getElementById("cookieBanner").style.display = "none";
  if (userCookiePreference=="rejected"){
  const cookiesToDelete = ["_gat_gtag_UA_140392065_1", "_gid", "_ga"];
  deleteCookies(cookiesToDelete);
}

}
 

  //onclick="Policy()" id="Policy"
    // Ce code sera exécuté lorsque l'iframe aura terminé de charger son contenu
    console.log('L\'iframe a été chargée.');
    // Vous pouvez effectuer des opérations ici, comme accéder à des éléments dans l'iframe
};

  