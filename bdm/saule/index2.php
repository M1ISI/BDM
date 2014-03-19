<?php
	//inclusion des modules
    require_once('connect_functions.php');

    //connections
    google_connection();
    facebook_connection();
    twitter_connection();
    

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
			</form>
			<?php
				$fbparams = array('scope' => 'manage_pages');
				echo "<input type=\"button\" value=\"Facebook\" onclick=\"document.location.href='" . $facebook->getLoginUrl($fbparams) . "'\"/>\n";
				echo "<input type=\"button\" value=\"Twitter\" onclick=\"document.location.href='" . $tw_url . "'\"/>\n";
				if(isset($authUrl)) {
					echo "<input type=\"button\" class=\"login\" value=\"Google + Login\" onclick=\"document.location.href='" . $authUrl . "'\"/>\n";
				} else {
					echo "<input type=\"button\" class=\"logout\" value=\"Google + Logout\" onclick=\"document.location.href='?logout'/>";
				}
					
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

  <?php facebook_manager($facebook, $user_id); ?>
  
  <?php google_manager($gClient, $plus)?>

  </body>
</html>
