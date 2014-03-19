<?php
    /* * Copyright 2011 Google Inc.
    *
    * Licensed under the Apache License, Version 2.0 (the "License");
    * you may not use this file except in compliance with the License.
    * You may obtain a copy of the License at
    *
    * http://www.apache.org/licenses/LICENSE-2.0
    *
    * Unless required by applicable law or agreed to in writing, software
    * distributed under the License is distributed on an "AS IS" BASIS,
    * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
    * See the License for the specific language governing permissions and
    * limitations under the License.
    */
    require_once 'libs/google-api-php-client/src/Google_Client.php';
    require_once 'libs/google-api-php-client/src/contrib/Google_PlusService.php';
  session_start();
  $id = $_POST['id'];
  $client = new Google_Client();
    $client->setApplicationName("Google+ PHP Starter Application");
    // oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
    $client->setClientId('55681422846.apps.googleusercontent.com');
    $client->setClientSecret('9SxgTGewrW5nBw4Unja91R2z');
    $client->setRedirectUri('http://localhost/BDM/bdm/saule/example.php');
    $client->setDeveloperKey('AIzaSyD06KI71Asrz82tdX_eFnkP1YdU6AIRynU');
    $plus = new Google_PlusService($client);
  if (isset($_REQUEST['logout'])) {  
  unset($_SESSION['access_token']);  
  }  
if (isset($_GET['code'])) {  
  $client->authenticate();  
  $_SESSION['access_token'] = $client->getAccessToken();  
  header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);  
  }  
if (isset($_SESSION['access_token'])) {  
  $client->setAccessToken($_SESSION['access_token']);  
  }  
if ($client->getAccessToken()) {  
  $me = $plus->people->get($id);  
$optParams = array('maxResults' => 100);  
  $activities = $plus->activities->listActivities($id, 'public', $optParams);  
// The access token may have been updated lazily.  
  $_SESSION['access_token'] = $client->getAccessToken();  
  } else {  
  $authUrl = $client->createAuthUrl();  
  }  
  ?>  
<!doctype html>  
  <html>  
  <head><link rel='stylesheet' href='style.css' /></head>  
  <body>  
  <header><h1>Google+ Sample App</h1></header>  
  <div class="box">  
<?php if(isset($me) && isset($activities)): ?>  
  <div class="me">  
  <p><a rel="me" href="<?php echo $me['url'] ?>"><?php print $me['displayName'] ?></a></p>  
  <p><?php print $me['tagline'] ?></p>   
  <p><?php print $me['aboutMe'] ?></p>   
  <div><img src="<?php echo $me['image']['url']; ?>?sz=82" /></div>  
  </div>  
  <div class="activities">Your Activities:  
  <?php foreach($activities['items'] as $activity): ?>  
  <div class="activity">  
  <p><a href="<?php print $activity['url'] ?>"><?php print $activity['title'] ?></a></p>  
  </div>  
  <?php endforeach ?>  
  </div>  
  <?php endif ?>  
  <?php  
  if(isset($authUrl)) {  
  print "<a class='login' href='$authUrl'>Connect Me!</a>";  
  } else {  
  //print "<a class='logout' href='?logout'>Logout</a>";  
  }  
  ?>  
  </div>  
  </body>  
  </html> 
              
