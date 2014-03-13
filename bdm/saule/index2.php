<?php
  // Remember to copy files from the SDK's src/ directory to a
  // directory in your application on the server, such as php-sdk/
  require_once('libs/src/facebook.php');
  require_once('libs/TwitterOAuth/TwitterOAuth.php');
  require_once('libs/TwitterOAuth/Exception/TwitterException.php');

  $config = array(
    'appId' => '1449580138609793',
    'secret' => 'bff79031538d7fe767ea8c7aa854d0cb',
    'allowSignedRequest' => false // optional but should be set to false for non-canvas apps
  );

  $facebook = new Facebook($config);
  $user_id = $facebook->getUser();

    /*$twitter = new */
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



  </body>
</html>
