<?php
    //importation des modules
	require_once('libs/src/facebook.php');
	require_once('libs/twitteroauth-master/twitteroauth/twitteroauth.php');

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
	    $TW_OAUTH_CALLBACK = 'http://localhost/bdm/bdm/saule/index2.php';

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
			    echo 'Résultats de la recherche pour le mot clé "'.$keyword.'"<br/>';
			    $fql = 'SELECT name, page_url, fan_count from page where contains(\''.$keyword.'\') order by fan_count DESC';
			    $ret_obj = $facebook->api(array(
									       'method' => 'fql.query',
									       'query' => $fql,
									     ));

			    // FQL queries return the results in an array, so we have
			    //  to get the user's name from the first element in the array.
			    for($i = 0; $i < 50; $i++){
				    echo '<a href="'.$ret_obj[$i]['page_url'].'">'.$ret_obj[$i]['name'].'</a> '.$ret_obj[$i]['fan_count'].'<br/>';
			    }
		    }
			
		    //Affiche la liste des amis
		    $count=0;$Mcount=0;
		    foreach($user_friendlist['data'] as $friends){
			    $Mcount++;
			    echo $friends['name']."<img src='https://graph.facebook.com/".$friends['id']."/picture' width='50' height='50'  /><br/>";
		    }
		
		    echo "Nombre d'amis = ".$Mcount;

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
?>
