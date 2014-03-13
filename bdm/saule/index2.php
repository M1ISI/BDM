<?php
    // Remember to copy files from the SDK's src/ directory to a
    // directory in your application on the server, such as php-sdk/
    require_once('libs/src/facebook.php');
    //require_once('libs/TwitterOAuth/TwitterOAuth.php');
    //require_once('libs/TwitterOAuth/Exception/TwitterException.php');
    require_once('libs/twitteroauth-master/twitteroauth/twitteroauth.php');
    //use TwitterOAuth\TwitterOAuth;

    /*- section facebook -*/
    $config_fb = array(
        'appId' => '1449580138609793',
        'secret' => 'bff79031538d7fe767ea8c7aa854d0cb',
        'allowSignedRequest' => false // optional but should be set to false for non-canvas apps
    );

    $facebook = new Facebook($config_fb);
    $user_id = $facebook->getUser();

    /*- section twitter -*/
    $TW_CONSUMER_KEY = 'IBLEidpRMTjx8BfcBwq3g';
    $TW_CONSUMER_SECRET = 'bpL3MPcuxOI3UIZNtCPoEvNJ7mgiXksc9CyKjm9ok';
    $TW_OAUTH_CALLBACK = 'index2.php';

    $twitter = new TwitterOAuth($TW_CONSUMER_KEY, $TW_CONSUMER_SECRET);
    $tw_request_token = $twitter->getRequestToken($TW_OAUTH_CALLBACK);
    print_r($tw_request_token);
 
    if($tw_request_token)
    {
        $tw_token = $tw_request_token['oauth_token'];
        /*$_SESSION['request_token'] = $token ;
        $_SESSION['request_token_secret'] = $request_token['oauth_token_secret'];*/
            echo $twitter->http_code . "-" . $tw_token;
        switch ($twitter->http_code)
        {
            case 200 :
                $tw_url = $twitter->getAuthorizeURL($tw_token);
                //redirect to Twitter .
                //header('Location: ' . $url);
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
/*
    $config_tw = array(
        'consumer_key' => 'IBLEidpRMTjx8BfcBwq3g',
        'consumer_secret' => 'bpL3MPcuxOI3UIZNtCPoEvNJ7mgiXksc9CyKjm9ok',
        'oauth_token' => '2379319452-ip3YRubJgKYGkyUveWVsGpVDfggA94keaaj5Jl9',
        'oauth_token_secret' => 'a1IHqquvAjiQeGwq6soKcCQmpptPtk2WS75bdFN2KDFl1',
        'output_format' => 'object'
    );*/

    /*$twitter = new TwitterOAuth($config_tw['consumer_key'], $config_tw['consumer_secret'], $config_tw['oauth_token'], $config_tw['oauth_token_secret']);
    $tw_url = $twitter->getAuthorizeURL($config_tw['oauth_token']);*/

?>
<html>
  <head></head>
  <body>

	    <div id="mainLayout">
			<form action="index2.php" method="GET" >
				<input type="text" id="mainField" name="mainField" placeholder="votre recherche" />
				<input type="submit" id="submitButton" value="Rechercher"/>
			</form>
			<?php
				echo "<input type=\"button\" value=\"Facebook\" onclick=\"document.location.href='" . $facebook->getLoginUrl() . "'\"/>\n";
				echo "<input type=\"button\" value=\"Twitter\" onclick=\"document.location.href='" . ' ' . "'\"/>\n";
				echo "<input type=\"button\" value=\"Google+\" onclick=\"document.location.href='" . ' ' . "'\"/>\n";
			?>
		</div>

  <?php
    if($user_id) {

      // We have a user ID, so probably a logged in user.
      // If not, we'll get an exception, which we handle below.
      try {

			$user_profile = $facebook->api('/me','GET');
			$user_friendlist = $facebook->api('/me/friends?fields=id,name,gender');	
			
			if(isset($_GET["mainfield"])){
				$keyword = $_GET["mainfield"];
				echo $keyword;
			}
			
			//Affiche la liste des amis
			$count=0;$Mcount=0;
			foreach($user_friendlist['data'] as $friends){
				$Mcount++;
				echo $friends['name']." ".$friends['gender']."<img src='https://graph.facebook.com/".$friends['id']."/picture' width='50' height='50'  /><br/>";
			}
			
			echo "Nombre d'amis = ".$Mcount;
			

      } catch(FacebookApiException $e) {
        // If the user is logged out, you can have a 
        // user ID even though the access token is invalid.
        // In this case, we'll get an exception, so we'll
        // just ask the user to login again here.
        $login_url = $facebook->getLoginUrl(); 
        echo 'Please <a href="' . $login_url . '">login.</a>';
        error_log($e->getType());
        error_log($e->getMessage());
      }   
    } else {
        echo "Vous n'êtes pas connecté...";
    }

  ?>

<<<<<<< HEAD
    <div id="mainLayout">
        <form action="indexSaule.php" method="GET" >
            <input type="text" id="mainField" name="mainField" placeholder="votre recherche" />
            <input type="submit" id="submitButton" value="Rechercher" />
        </form>
        <?php
            echo "<input type=\"button\" value=\"Facebook\" onclick=\"document.location.href='" . $facebook->getLoginUrl() . "'\"/>\n";
            echo "<input type=\"button\" value=\"Twitter\" onclick=\"document.location.href='" . $tw_url . "'\"/>\n";
            echo "<input type=\"button\" value=\"Google+\" onclick=\"document.location.href='" . ' ' . "'\"/>\n";
        ?>
    </div>
=======

>>>>>>> a1a5938d7d15c5526164be9d6bd7d27ee92bec24

  </body>
</html>
