<html>

 <body>
<?php

    $app_id = "1449580138609793";
    $app_secret = "bff79031538d7fe767ea8c7aa854d0cb";

    try
    {
        include_once ('libs/src/facebook.php');
    }
    catch(Exception $o)
    {
     print_r($o);
    }

    $fb = new Facebook(array(
     'appId'  => $app_id,
      'secret' => $app_secret,
      'cookie' => true
    ));

    $user = $fb->getUser();
    $loginUrl = $fb->getLoginUrl(array
      (
                'scope'         => 'email'
            )
        );

    if ($user)
    {
      try
      {
        $fbuser=$fb->api('/me/friends?fields=id,name,gender');
         $access_token = $fb->getAccessToken();
      } catch (FacebookApiException $e)
       {
         echo $e;
         $user = null;
       }
    }

    if (!$user) {
        echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";
        exit;
    }
    $count=0;$Mcount=0;
    foreach($fbuser['data'] as $friends){

 if($friends['gender']=="male")
 {
  $Mcount++;
  echo $friends['name']."<img src='https://graph.facebook.com/".$friends['id']."/picture' width='50' height='50'  /><br/>";
 }
}

echo "Male Friends Count=".$Mcount;

?>
</body>
</html>
