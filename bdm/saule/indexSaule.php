<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="styleIndex.css" />
        <title>Recherche saule</title>
    </head>
    <body>

	<script type="text/javascript" src="functions.js"></script>
    <div id="fb-root"></div>

    <script src="http://connect.facebook.net/fr_FR/all.js"></script>
    <script>
        FB.init({
            appId  : '1449580138609793',
            status : true, // verifie le statut de la connexion
            cookie : true, // active les cookies pour que le serveur puisse accéder à la session
            xfbml  : true  // active le XFBML (HTML de Facebook)
        });
    </script>

	<div id="mainLayout">
    <!--<form action= method=>-->
        <input type="text" id="mainFiled" placeholder="votre recherche" />
    	<input type="submit" id="submitButton" value="Rechercher" />
    <!--</form>-->
    </div> 
    
    <div class="fb-login-button" data-max-rows="1" data-size="medium" data-show-faces="false" data-auto-logout-link="false"></div>
    </body>
</html>
