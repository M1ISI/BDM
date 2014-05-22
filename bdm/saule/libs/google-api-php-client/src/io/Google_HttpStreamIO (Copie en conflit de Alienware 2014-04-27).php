<?php
/*
 * Copyright 2013 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * Http Streams based implementation of Google_IO.
 *
 * @author Stuart Langley <slangley@google.com>
 */

require_once 'Google_CacheParser.php';

class Google_HttpStreamIO extends Google_IO {

  private static $ENTITY_HTTP_METHODS = array("POST" => null, "PUT" => null);

  private static $DEFAULT_HTTP_CONTEXT = array(
    "follow_location" => 0,
    "ignore_errors" => 1,
  );

  private static $DEFAULT_SSL_CONTEXT = array(
    "verify_peer" => true,
  );

  /**
   * Perform an authenticated / signed apiHttpRequest.
   * This function takes the apiHttpRequest, calls apiAuth->sign on it
   * (which can modify the request in what ever way fits the auth mechanism)
   * and then calls Google_HttpStreamIO::makeRequest on the signed request
   *
   * @param Google_HttpRequest $request
   * @return Google_HttpRequest The resulting HTTP response including the
   * responseHttpCode, responseHeaders and responseBody.
   */
  public function authenticatedRequest(Google_HttpRequest $request) {
    $request = Google_Client::$auth->sign($request);
    return $this->makeRequest($request);
  }

  /**
   * Execute a apiHttpRequest
   *
   * @param Google_HttpRequest $request the http request to be executed
   * @return Google_HttpRequest http request with the response http code,
   * response headers and response body filled in
   * @throws Google_IOException on curl or IO error
   */
  public function makeRequest(Google_HttpRequest $request) {
    // First, check to see if we have a valid cached version.
    $cached = $this->getCachedRequest($request);
    if ($cached !== false) {
      if (!$this->checkMustRevaliadateCachedRequest($cached, $request)) {
        return $cached;
      }
    }

    $default_options = stream_context_get_options(stream_context_get_default());

    $requestHttpContext = array_key_exists('http', $default_options) ?
        $default_options['http'] : array();
    if (array_key_exists($request->getRequestMethod(),
          self::$ENTITY_HTTP_METHODS)) {
      $request = $this->processEntityRequest($request);
    }

    if ($request->getPostBody()) {
      $requestHttpContext["content"] = $request->getPostBody();
    }

    $requestHeaders = $request->getRequestHeaders();
    if ($requestHeaders && is_array($requestHeaders)) {
      $headers = "";
      foreach($requestHeaders as $k => $v) {
        $headers .= "$k: $v\n";
      }
      $requestHttpContext["header"] = $headers;
    }

    $requestHttpContext["method"] = $request->getRequestMethod();
    $requestHttpContext["user_agent"] = $request->getUserAgent();

    $requestSslContext = array_key_exists('ssl', $default_options) ?
        $default_options['ssl'] : array();

    if (!array_key_exists("cafile", $requestSslContext)) {
      $requestSslContext["cafile"] = dirname(__FILE__) . '/cacerts.pem';
    }

    $options = array("http" => array_merge(self::$DEFAULT_HTTP_CONTEXT,
                                                 $requestHttpContext),
                     "ssl" => array_merge(self::$DEFAULT_SSL_CONTEXT,
                                          $requestSslContext));

    $context = stream_context_create($options);

    $response_data = file_get_contents($request->getUrl(),
                                       false,
                                       $context);

    if (false === $response_data) {
      throw new Google_IOException(INDX( 	 �k�            (   �  �       �'   w               �    U h R     �    ' �k�?�a����?�a����?�a���?�a� p      �m              F 5 3 2 . t m p ~ R F D     h R     �    ' ���?�a��J�?�a�,�?�a����?�a� p      �m              F 5 5 4 . t m p ~ R F r     h R     �    ' ,�?�a�t��?�a�+I�?�a�C?�?�a� p      �m              F 5 8 4 . t m p ~ R F x    O h R     �    ' +I�?�a�k��?�a���@�a�Ap�?�a� p      �m              F 5 A 6 . t m p ~ R F z     h R     �    ' ��@�a �9@�a��	@�a���@�a� p      �m              F 5 D 7 . t m p ~ R F |     h R     �    ' �	@�a�ّ	@�a���@�a��C	@�a� p      �m              F 6 0 7 . t m p ~ R F �     h R     �    ' ��@�a��;@�a��@�a���@�a� p      �m              F 6 1 9 . t m p ~ R F �H     h R     �    ' �@�a�X	@�a�G@�a�A�@�a� p      �m              F 6 4 A . t m p ~ R F "N    � h R     �    ' G@�a���@�a�[k@�a�]:@�a� p      �m              F 6 6 B . t m p ~ R F �N    ' h R     �     [k@�a���@�a��#@�a�r�@�a� p      �m              F 6 8 C . t m p ~ R F �S    h R     �    ' �#@�a�)�#@�a�~w+@�a���#@�a� p      �m              F 6 B D . t m p ~ R F �T    ; h R     �    ' ~w+@�a���+@�a�@30@�a���+@�a� p      �m              F 6 E E . t m p ~ R F �V    h R     �    ' @30@�a�}�0@�a�r8@�a�j�0@�a� p      �m              F 7 0 F . t m p ~ R F �_     h R     �    ' r8@�a�G�8@�a���<@�a��8@�a� p      �m              F 7 5 0 . t m p ~ R F �`    5 h R    �    ' ��<@�a��T=@�a� �B@�a��-=@�a� p      �m              F 7 6 2 . t m p ~ R F �    z h R     �    '  �B@�a� �B@�a� �B@�a� �B@�a�          