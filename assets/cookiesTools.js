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
  function deleteCookies(cookieNames) {
    const expirationDate = 'Thu, 01 Jan 1970 00:00:00 GMT';

    if (Array.isArray(cookieNames)) {
      cookieNames.forEach((cookieName) => {
        document.cookie = `${cookieName}=;expires=${expirationDate};path=/;domain=.agb.dz`;
      });
    } else {
      document.cookie = `${cookieNames}=;expires=${expirationDate};path=/;domain=.agb.dz`;
    }
  }
   // Chargez le script de Google Tag Manager lorsque vous en avez besoin
function loadGoogleTagManager() {
   const userCookiePreference = getCookie('cookiePreference');

    if (userCookiePreference=="rejected")
        {
            const cookiesToDelete = [
        "_gat_gtag_UA_264048578_1",
        "_gid",
        "_ga",
        "_ga_P6NDHR7HGN",
        "_ga_FMZBB6Y4Y7"
      ];
  deleteCookies(cookiesToDelete);
        }else{
  const script = document.createElement('script');
  script.src = 'https://www.googletagmanager.com/gtag/js?id=G-P6NDHR7HGN';
  script.async = true;
  document.head.appendChild(script);
}
   
}

// Appelez la fonction pour charger le script
loadGoogleTagManager();
