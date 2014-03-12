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
            var uid;
            var accessToken;

            FB.init({
                appId  : '1449580138609793',
                status : true, // verifie le statut de la connexion
                cookie : true, // active les cookies pour que le serveur puisse accéder à la session
                xfbml  : true  // active le XFBML (HTML de Facebook)
            });

            // Cette fonction vérifie l'état de la connexion et prend en paramètre
		    // une fonction de callback.
		    FB.getLoginStatus(function(response) {
			    if (response.status == 'connected') {
                    alert("connected");
				    // l'utilisateur est connecté à l'application
				    uid = response.authResponse.userID;
				    accessToken = response.authResponse.accessToken;
			    } else if (response.status == 'not_authorized') {
				    // l'utilisateur est connecté à Facebook
				    // mais n'a pas encore ajouté l'application
                    alert("unauthorized");
			    } else {
				    // pas connecté à Facebook
                    alert("not connected");
			    }
			    alert(response.status + " uid=" + uid + " accessToken=" + accessToken);
		    });

            function getAccessToken() {
                return accessToken;
            }
            
            FB.api(
			{
				method: 'fql.query',
				query: 'SELECT name, uid, pic_square FROM user WHERE uid in (SELECT uid2 FROM friend WHERE uid1 = ' + uid
			},
			function(data) {
				console.log(data);
			}
			);

        </script>

	    <div id="mainLayout">
            <form action="indexSaule.php" method="GET" >
                <input type="hidden" name="token" value=getAccessToken(); />
                <input type="text" id="mainField" name="mainField" placeholder="votre recherche" />
            	<input type="submit" id="submitButton" value="Rechercher" />
            </form>
        </div>

        <?php
				//récupération des amis via FQL
		/*		$query = "SELECT name, uid, pic_square FROM user WHERE uid in (SELECT uid2 FROM friend WHERE uid1 = ".$this->uid.")";
				$this->amis = $this->facebook->api(array(
					'method'    => 'fql.query',
					'query'     => $query,
					'callback'  => ''
				));
				foreach ($amis as $ami):
			*/	
				
			  
			  
			  
           /* if(isset($_GET["mainField"]) && isset($_GET["token"]))
            {
                $bfQuery = 'https://graph.facebook.com/fql?q=SELECT+name+FROM+friendlist&access_token=' . $_GET["token"];
                $bfQuery_result = file_get_contents($bfQuery);
                $bfQuery_obj = json_decode($bfQuery_result, true);
                alert($bfQuery_obj);
            }*/
        ?>

        
        <div class="fb-login-button" data-max-rows="1" data-size="medium" data-show-faces="false" data-auto-logout-link="false" ></div>
    </body>
</html>
