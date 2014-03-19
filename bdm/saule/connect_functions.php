<?php
    //importation des modules
	require_once('libs/facebook/src/facebook.php');
	require_once('libs/twitteroauth-master/twitteroauth/twitteroauth.php');
	require_once 'libs/google-api-php-client/src/Google_Client.php';
    require_once 'libs/google-api-php-client/src/contrib/Google_PlusService.php';
    

    /*- section facebook -*/
    function facebook_connection()
    {
        //pour pouvoir réutiliser ces variables plus loin dans le code (hors de la fonction)
        global $facebook, $user_id;

	    $config_fb = array(
	        'appId' => '1449580138609793',
	        'secret' => 'bff79031538d7fe767ea8c7aa854d0cb',
	        'allowSignedRequest' => false // optional but should be set to false for non-canvas apps
	    );

        //connection
	    $facebook = new Facebook($config_fb);
	    $user_id = $facebook->getUser();
    }

    /*- section twitter -*/
    function twitter_connection()
    {
        //pour pouvoir réutiliser ces variables plus loin dans le code (hors de la fonction)
        global $twitter, $tw_url;

	    $TW_CONSUMER_KEY = 'IBLEidpRMTjx8BfcBwq3g';
	    $TW_CONSUMER_SECRET = 'bpL3MPcuxOI3UIZNtCPoEvNJ7mgiXksc9CyKjm9ok';
	    //$TW_OAUTH_CALLBACK = 'http://localhost/bdm/bdm/saule/index2.php';
	    $TW_OAUTH_CALLBACK = 'http://62.241.123.181/BDM/bdm/saule/index2.php';

        //connection + récupération du token
	    $twitter = new TwitterOAuth($TW_CONSUMER_KEY, $TW_CONSUMER_SECRET);
	    $tw_request_token = $twitter->getRequestToken($TW_OAUTH_CALLBACK);

	    if($tw_request_token)
	    {
		    $tw_token = $tw_request_token['oauth_token'];
		    switch ($twitter->http_code)
		    {
		        case 200 :
			    $tw_url = $twitter->getAuthorizeURL($tw_token);
			    break;

		        default :
			    echo "Connection with twitter Failed";
			    break;
		    }
	    }
	    else //error receiving request token
	    {
		    echo "Error Receiving Request Token";
	    }
    }
    
    function google_connection()
    {
		
	    global $authUrl, $gClient, $plus;
		// oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
		$google_client_id = '55681422846.apps.googleusercontent.com';
		$google_client_secret = '9SxgTGewrW5nBw4Unja91R2z';
		$google_redirect_url = 'http://localhost/BDM/bdm/saule/index2.php';
	    $google_developer_key = 'AIzaSyCKaTTlPODGJcBv_jhifbL_CYBD6S6T6Rc';
	  
		session_start();

		$gClient = new Google_Client();
		$gClient->setApplicationName("Google+ PHP Starter Application");
		// Visit https://code.google.com/apis/console to generate your
		// oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
		$gClient->setClientId($google_client_id);
		$gClient->setClientSecret($google_client_secret);
		$gClient->setRedirectUri($google_redirect_url);
		$gClient->setDeveloperKey($google_developer_key);
		$plus = new Google_PlusService($gClient);

		if (isset($_REQUEST['logout'])) {
		  unset($_SESSION['access_token']);
		}
		
		if (isset($_GET['code'])) {
			$gClient->authenticate($_GET['code']);
			$_SESSION['access_token'] = $gClient->getAccessToken();
			header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
		}

		if (isset($_SESSION['access_token'])) {
			$gClient->setAccessToken($_SESSION['access_token']);
		}

		if (!$gClient->getAccessToken()) {
		  $authUrl = $gClient->createAuthUrl();
		}
	}

    /*retourne la liste d'amis et la liste des pages associées à la recherche*/
    function facebook_manager($facebook, $user_id)
    {
        if($user_id) {

        // We have a user ID, so probably a logged in user.
        // If not, we'll get an exception, which we handle below.
        try {
		    $user_profile = $facebook->api('/me','GET');
		    $user_friendlist = $facebook->api('/me/friends?fields=id,name,gender');	

		    if(isset($_GET["mainField"]) && $_GET["mainField"] != ''){
			    $keyword = $_GET["mainField"];
			    $fql = 'SELECT name, page_url, fan_count, general_info, description, pic_small from page where contains(\''.$keyword.'\') order by fan_count DESC';
			    $ret_obj = $facebook->api(array(
									       'method' => 'fql.query',
									       'query' => $fql,
									     ));

			    // FQL queries return the results in an array, so we have
			    //  to get the user's name from the first element in the array.
			    $nbResults = sizeof($ret_obj);
			    if($nbResults > 20){
					$nbResults = 20;
				}
			    
			    echo $nbResults.' Pages Facebook pour le mot clé "'.$keyword.'"<br/>';
			    for($i = 0; $i < $nbResults; $i++){
				    echo '<img src="https://graph.facebook.com/"'.$ret_obj[$i]['pic_small'];
				    echo '/picture\' width="50" height="50"  /><a href="'.$ret_obj[$i]['page_url'].'">'.$ret_obj[$i]['name'].'</a> ';
				    echo $ret_obj[$i]['fan_count'].'<br/>'.$ret_obj[$i]['general_info'].'<br/>'.$ret_obj[$i]['description'].'<br/>';
			    }
			    echo '<br/><br/><br/>';
		    }
			
		    //Affiche la liste des amis
		    
	/*	    $count=0;$Mcount=0;
		    foreach($user_friendlist['data'] as $friends){
			    $Mcount++;
			    echo $friends['name']."<img src='https://graph.facebook.com/".$friends['id']."/picture' width='50' height='50'  /><br/>";
		    }
		
		    echo "Nombre d'amis = ".$Mcount;
		*/	
            } catch(FacebookApiException $e) {
                // If the user is logged out, you can have a 
                // user ID even though the access token is invalid.
                // In this case, we'll get an exception, so we'll
                // just ask the user to login again here.
                echo $e->getMessage();
                error_log($e->getType());
                error_log($e->getMessage());
            }   
        }
    }
    
    function google_manager($gClient, $plus){
		if ($gClient->getAccessToken()) {
			$me = $plus->people->get('me');
			if(isset($_GET["mainField"]) && $_GET["mainField"] != ''){
			    $keyword = $_GET["mainField"];	
				$params = array(
				  'orderBy' => 'best',
				  'maxResults' => '20'
				);
				$results = $plus->activities->search($keyword, $params);
				echo sizeof($results)." Résultats Google+ pour la recherche \"".$keyword."\"<br/><br/>";
				foreach($results['items'] as $result) {
					echo '<a href="'.$result['url'].'">'.$result['title'].'</a><br/>';
					echo $result['object']['content'].'<br/><br/>';
				}
		  }

		  // The access token may have been updated lazily.
		  $_SESSION['access_token'] = $gClient->getAccessToken();
	  }
	}
?>
