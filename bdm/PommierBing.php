<html>
<head>
<title>PHP Bing</title>
</head>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            Type in a search:
 
<input type="text" id="searchText" name="searchText"
                value="<?php
                        if (isset($_POST['searchText']))
                        {
                            echo($_POST['searchText']);
                        }
                        else
                        {
                            echo('');
                        }
                       ?>"
            />
 
<input type="submit" value="Search!" name="submit" id="searchButton" />
<?php           
                if (isset($_POST['submit']))
                {
                    // Replace this value with your account key
                    $accountKey = '6Tw+S+Ua6XuSLAJ8dU2Q4zrmqgjQK6ksvc4c/EKx8+A';
 
                    $ServiceRootURL =  'https://api.datamarket.azure.com/Bing/Search/';
 
                    $WebSearchURL = $ServiceRootURL . 'Web?$format=json&Query=';
 
                    $context = stream_context_create(array(
                        'http' => array(
                            'request_fulluri' => true,
                            'header'  => "Authorization: Basic " . base64_encode($accountKey . ":" . $accountKey)
                        )
                    ));
 
                    $request = $WebSearchURL . urlencode( '\'' . $_POST["searchText"] . '\'');
 
                    echo($request);
 
                    $response = file_get_contents($request, 0, $context);
 
                    $jsonobj = json_decode($response);
 
                    echo('<ul ID="resultList">');
 
                    foreach($jsonobj->d->results as $value)
                    {       
                        //print_r($value);
                        echo('<li class="resultlistitem"><a href="' . $value->Url . '">'. $value->DisplayUrl);
                       // echo('<li class="resultlistitem"><a href="' . $value->MediaURL . '">');
 
                        //echo('<img src="' . $value->Thumbnail->MediaUrl. '"></li>');
                    }
 
                    echo("</ul>");
                }
            ?>
</form>
</body>
</html
