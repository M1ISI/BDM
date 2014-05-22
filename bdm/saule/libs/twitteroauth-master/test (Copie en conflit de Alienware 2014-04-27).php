<?php
/**
 * @file
 * 
 */

/* Load required lib files. */
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

/* If access tokens are not available redirect to connect page. */
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
    header('Location: ./clearsessions.php');
}
/* Get user access tokens out of the session. */
$access_token = $_SESSION['access_token'];

/* Create a TwitterOauth object with consumer/user tokens. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

/* If method is set change API call made. Test is called by default. */
$content = $connection->get('account/rate_limit_status');
echo "Current API hits remaining: {$content->remaining_hits}.";

/* Get logged in user to help with tests. */
$user = $connection->get('account/verify_credentials');

$active = FALSE;
if (empty($active) || empty($_GET['confirmed']) || $_GET['confirmed'] !== 'TRUE') {
  echo '<h1>Warning! This page will make many requests to Twitter.</h1>';
  echo '<h3>Performing these test might max out your rate limit.</h3>';
  echo '<h3>Statuses/DMs will be created and deleted. Accounts will be un/followed.</h3>';
  echo '<h3>Profile information/design will be changed.</h3>';
  echo '<h2>USE A DEV ACCOUNT!</h2>';
  echo '<h4>Before use you must set $active = TRUE in test.php</h4>';
  echo '<a href="./test.php?confirmed=TRUE">Continue</a> or <a href="./index.php">go back</a>.';
  exit;
}

function twitteroauth_row($method, $response, $http_code, $parameters = '') {
  echo '<tr>';
  echo "<td><b>{$method}</b></td>";
  switch ($http_code) {
    case '200':
    case '304':
      $color = 'green';
      break;
    case '400':
    case '401':
    case '403':
    case '404':
    case '406':
      $color = 'red';
      break;
    case '500':
    case '502':
    case '503':
      $color = 'orange';
      break;
    default:
      $color = 'grey';
  }
  echo "<td style='background: {$color};'>{$http_code}</td>";
  if (!is_string($response)) {
    $response = print_r($response, TRUE);
  }
  if (!is_string($parameters)) {
    $parameters = print_r($parameters, TRUE);
  }
  echo '<td>', strlen($response), '</td>';
  echo '<td>', $parameters, '</td>';
  echo '</tr><tr>';
  echo '<td colspan="4">', substr($response, 0, 400), '...</td>';
  echo '</tr>';

}

function twitteroauth_header($header) {
  echo '<tr><th colspan="4" style="background: grey;">', $header, '</th></tr>';
}

/* Start table. */
echo '<br><br>';
echo '<table border="1" cellpadding="2" cellspacing="0">';
echo '<tr>';
echo '<th>API Method</th>';
echo '<th>HTTP Code</th>';
echo '<th>Response Length</th>';
echo '<th>Parameters</th>';
echo '</tr><tr>';
echo '<th colspan="4">Response Snippet</th>';
echo '</tr>';

/**
 * Help Methods.
 */
twitteroauth_header('Help Methods');

/* help/test */
twitteroauth_row('help/test', $connection->get('help/test'), $connection->http_code);


/**
 * Timeline Methods.
 */
twitteroauth_header('Timeline Methods');

/* statuses/public_timeline */
twitteroauth_row('statuses/public_timeline', $connection->get('statuses/public_timeline'), $connection->http_code);

/* statuses/public_timeline */
twitteroauth_row('statuses/home_timeline', $connection->get('statuses/home_timeline'), $connection->http_code);

/* statuses/friends_timeline */
twitteroauth_row('statuses/friends_timeline', $connection->get('statuses/friends_timeline'), $connection->http_code);

/* statuses/user_timeline */
twitteroauth_row('statuses/user_timeline', $connection->get('statuses/user_timeline'), $connection->http_code);

/* statuses/mentions */
twitteroauth_row('statuses/mentions', $connection->get('statuses/mentions'), $connection->http_code);

/* statuses/retweeted_by_me */
twitteroauth_row('statuses/retweeted_by_me', $connection->get('statuses/retweet��� �c�   $Ki   )                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
   � H�o�'��                                                                                                                                                                                                                                                                                           Ihttps://nydus.battle.net/App/frFR/client/App/alert?targetRegion=EU �   �https://nydus.battle.net/App/frFR/client/App/maintenance?targetReN�https://nydus.battle.net/App/frFR/client/App/maintenance?targetRegion=EU �7qhttp://eu.version.blizzard.com/update/d3-video.txt�H�https://nydus.battle.net/App/frFR/client/App/alert?targetRegion=EU �I�https://nydus.battle.net/App/frFR/client/WTCG/alert?targetRegion=EU �K�https://nydus.battle.net/App/frFR/client/D3Beta/alert?targetRegion=XX �G�https://nydus.battle.net/App/frFR/client/S2/alert?targetRegion=EU G�https://nydus.battle.net/App/frFR/client/D3/alert?targetRegion=EU �H�https://nydus.battle.net/App/frFR/client/WoW/alert?targetRegion=EU ~$Kj       � � �G6��                                                           v��M	https://nydus.battle.net/App/frFR/client/App/maintenance?targetRegion=EUD41D8CD98F00B204E9800998ECF8427EE�0R���D�	q�q� �M	https://nydus.battle.net/App/frFR/client/WTCG/alert?targetRegion=EUD41D8CD98F00B204E9800998ECF8427EE�s��M	https://nydus.battle.net/App/frFR/client/D3Beta/alert?targetRegion=XXD41D8CD98F00B204E9800998ECF8427EE�v�
�M	https://nydus.battle.net/App/frFR/client/App/maintenance?targetRegion=EUD41D8CD98F00B204E9800998ECF8427EE�I0p�	�M	https://nydus.battle.net/App/frFR/client/App/alert?targetRegion=EUD41D8CD98F00B204E9800998ECF8427EE�I0o��M	https://nydus.battle.net/App/frFR/client/S2/alert?targetRegion=EUD41D8CD98F00B204E9800998ECF8427EE�p�~�M	https://nydus.battle.net/App/frFR/client/WoW/alert?targetRegion=EUD41D8CD98F00B204E9800998ECF8427EE�o��M	https://nydus.battle.net/App/frFR/client/D3/alert?targetRegion=EUD41D8CD98F00B204E9800998ECF8427EE�ݠ$Kj�   SQLite format 3   @     �   )                                                          � -�'   �    � �� � �                                                          9M' indexsqlite_autoindex_catalog_cache_1catalog_cache	�W))�itableremote_objectsremote_objectsCREATE TABLE remote_objects (url TEXT PRIMARY KEY NOT NULL, content BLOB, content_hash TEXT NOT NULL, dismissed INTEGER NOT NULL DEFAULT 0, last_seen_time DATE, type INTEGER);O) indexsqlite_autoindex_remote_objects_1remote_objects�##�Otablelogin_cachelogin_cacheCREATE TABLE login_cache (name TEXT NOT NULL, environment TEXT NOT NULL, battle_tag TEXT NOT NULL, account_id_hi INT NOT NULL, account_id_lo INT NOT NULL, UNIQUE(account_id_hi, account_id_lo, environment) ON CONFLICT REPLACE)5I# indexsqlite_autoindex_login_cache_1login_cache}##�Atableschema_infoschema_infoCREATE TABLE schema_info (table_name TEXT PRIMARY KEY NOT NULL, version INTEGER DEFAULT 1)5I# indexsqlite_autoindex_schema_info_1schema_info   
$Kj                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ��� �c�   ��-   )                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
   � H�o�'��                                                                                                                                                                                                                                                                                           Ihttps://nydus.battle.net/App/frFR/client/App/alert?targetRegion=EU �   �https://nydus.battle.net/App/frFR/client/App/maintenance?targetReN�https://nydus.battle.net/App/frFR/client/App/maintenance?targetRegion=EU �7qhttp://eu.version.blizzard.com/update/d3-video.txt�H�https://nydus.battle.net/App/frFR/client/App/alert?targetRegion=EU �I�https://nydus.battle.net/App/frFR/client/WTCG/alert?targetRegion=EU �K�https://nydus.battle.net/App/frFR/client/D3Beta/alert?targetRegion=XX �G�https://nydus.battle.net/App/frFR/client/S2/alert?targetRegion=EU G�https://nydus.battle.net/App/frFR/client/D3/alert?targetRegion=EU �H�https://nydus.battle.net/App/frFR/client/WoW/alert?targetRegion=EU ~��;       � � �G��6                                                           v��M	https://nydus.battle.net/App/frFR/client/App/maintenance?targetRegion=EUD41D8CD98F00B204E9800998ECF8427EE�0R���D�	q�q� �M	https://nydus.battle.net/App/frFR/client/WTCG/alert?targetRegion=EUD41D8CD98F00B204E9800998ECF8427EE�s��M	https://nydus.battle.net/App/frFR/client/D3Beta/alert?targetRegion=XXD41D8CD98F00B204E9800998ECF8427EE�v�
�M	https://nydus.battle.net/App/frFR/client/App/maintenance?targetRegion=EUD41D8CD98F00B204E9800998ECF8427EE�I0p��M	https://nydus.battle.net/App/frFR/client/App/alert?targetRegion=EUD41D8CD98F00B204E9800998ECF8427EE��o��M	https://nydus.battle.net/App/frFR/client/S2/alert?targetRegion=EUD41D8CD98F00B204E9800998ECF8427EE�p�~�M	https://nydus.battle.net/App/frFR/client/WoW/alert?targetRegion=EUD41D8CD98F00B204E9800998ECF8427EE�o��M	https://nydus.battle.net/App/frFR/client/D3/alert?targetRegion=EUD41D8CD98F00B204E9800998ECF8427EE�ݠ�۫   SQLite format 3   @     �   )                                                          � -�'   �    � �� � �                                                          9M' indexsqlite_autoindex_catalog_cache_1catalog_cache	�W))�itableremote_objectsremote_objectsCREATE TABLE remote_objects (url TEXT PRIMARY KEY NOT NULL, content BLOB, content_hash TEXT NOT NULL, dismissed INTEGER NOT NULL DEFAULT 0, last_seen_time DATE, type INTEGER);O) indexsqlite_autoindex_remote_objects_1remote_objects�##�Otablelogin_cachelogin_cacheCREATE TABLE login_cache (name TEXT NOT NULL, environment TEXT NOT NULL, battle_tag TEXT NOT NULL, account_id_hi INT NOT NULL, account_id_lo INT NOT NULL, UNIQUE(account_id_hi, account_id_lo, environment) ON CONFLICT REPLACE)5I# indexsqlite_autoindex_login_cache_1login_cache}##�Atableschema_infoschema_infoCREATE TABLE schema_info (table_name TEXT PRIMARY KEY NOT NULL, version INTEGER DEFAULT 1)5I# indexsqlite_autoindex_schema_info_1schema_info   
��1                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       