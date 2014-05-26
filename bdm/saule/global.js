function signinCallback(authResult) {
  if (authResult['access_token']) {
    // Autorisation r�ussie
    // Masquer le bouton de connexion maintenant que l'utilisateur est autoris�, par exemple :
    document.getElementById('signinButton').setAttribute('style', 'display: none');
	exemple_requete();
  } else if (authResult['error']) {
    // Une erreur s'est produite.
    // Codes d'erreur possibles :
    //   "access_denied" - L'utilisateur a refus� l'acc�s � votre application
    //   "immediate_failed" - La connexion automatique de l'utilisateur a �chou�
    // console.log('Une erreur s'est produite : ' + authResult['error']);
  }
  
  alert(JSON.stringify(authResult));
}

function exemple_requete()
{
	var req = gapi.client.request({
		'path': 'https://www.googleapis.com/plus/v1/people/me'
	});
	
	req.execute(exemple_requete_after);
}

function exemple_requete_after(jsonResp, rawResp)
{
	var bjr = document.getElementById('bonjour');
	
	// Ne pas utiliser innerHTML en production !
	// Remplacer par les fonctions DOM qui vont bien !
	bjr.innerHTML = rawResp;
}
