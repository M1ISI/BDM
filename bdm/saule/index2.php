<?php
    session_start();

	//inclusion des modules
    require_once('connect_functions.php');

    //connections
    try{
		google_connection();
	}catch(Google_AuthException $e){}
    facebook_connection();
    twitter_connection();
    /*$s = file_get_contents('/home/fritmayo/store');
    $a = unserialize($s);*/

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Recherche Saule</title>
        <meta charset="utf-8" />
        <!--<script type="text/javascript" src="json2.js"></script>-->
        <script type="text/javascript" src="https://apis.google.com/js/plus.js"></script>
        <script type="text/javascript" src="https://apis.google.com/js/client:plus.js"></script>
        <!--<script type="text/javascript" src="global.js"></script>-->
    </head>

    <body>
	    <div id="mainLayout">
			<form action="index2.php" method="GET" >
				<input type="text" id="mainField" name="mainField" placeholder="votre recherche" />
				<input type="submit" id="submitButton" value="Rechercher"/>
			<!--</form>-->
			<?php
                if(isset($_GET['oauth_token']))
                    echo "<input type=\"hidden\" name=\"oauth_token\" value=".$_GET['oauth_token']."/>\n";
                if(isset($_GET['oauth_verifier']))
                    echo "<input type=\"hidden\" name=\"oauth_verifier\" value=".$_GET['oauth_verifier']."/>\n</form>";

				$fbparams = array('scope' => 'manage_pages');
				echo "<input type=\"button\" value=\"Facebook\" onclick=\"document.location.href='" . $facebook->getLoginUrl($fbparams) . "'\"/>\n";
				echo "<input type=\"button\" value=\"Twitter\" onclick=\"document.location.href='" . $tw_url . "'\"/>\n";
				if(isset($authUrl)) {
					echo "<input type=\"button\" class=\"login\" value=\"Google + Login\" onclick=\"document.location.href='" . $authUrl . "'\"/>\n";
				} else {
					echo "<input type=\"button\" class=\"logout\" value=\"Google + Logout\" onclick=\"document.location.href='?logout'\"/>";
				}
				
				echo "<input type=\"button\" value=\"Retour\" onclick=\"document.location.href=' ../index.php '\"/>\n";
					
			?>
	  <!--      <p>
		        <span id="signinButton">
			        <span
			        class="g-signin"
			        data-callback="signinCallback"
			        data-clientid="55681422846.apps.googleusercontent.com"
			        data-cookiepolicy="single_host_origin"
			        data-requestvisibleactions="http://schemas.google.com/AddActivity"
			        data-scope="https://www.googleapis.com/auth/plus.login">
			        </span>
		        </span>
	        </p>
	        -->
		</div>

    <?php
        facebook_manager($facebook, $user_id);
        twitter_search($twitter);
        google_manager($gClient, $plus)
    ?>

  </body>
</html>
