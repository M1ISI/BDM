<?php
session_start();

require_once('saule/connect_functions.php'); 
try{
	google_connection();
}catch(Google_AuthException $e){}
facebook_connection();
twitter_connection();

echo $authUrl;

?>
