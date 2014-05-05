<?php

require_once("image_color.php");

function hex2rgb($hex) 
{
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}

function exist($result, $val)
{
	$exist = false;
	
	foreach($result as $res)
	{
		if($res == $val)
			$exist = true;
	}
	
	return $exist;
}

$db = new SQLite3('test.db');
$commonColor = new GetMostCommonColors();

$colors = $commonColor->Get_Color($_FILES['image']['tmp_name']);

echo "<h1>Resultats</h1>";

$i = 0;
$result = array();

foreach($colors as $color => $percent)
{	
	foreach(hex2rgb($color) as $c => $val)
	{
		switch($c)
		{
			case 0:
				$r = $val;
				break;
			case 1:
				$g = $val;
				break;
			case 2:
				$b = $val;
				break;
			default:
				break;
		}
	}
	
	$query  = "SELECT path FROM files WHERE id_file IN ";
	$query .= "(SELECT file FROM images WHERE id_image IN ";
	$query .= "(SELECT image FROM have_color WHERE percent <= ". $percent ." AND color IN ";
	$query .= "(SELECT id_color FROM colors WHERE r=".$r." AND g=".$g." AND b=".$b.")))";
	
	$res = $db->query($query);
	
	while ($row = $res->fetchArray(SQLITE3_NUM))
	{
		if(!exist($result, $row[0]))
		{
			array_push($result,$row[0]);
		}
		//echo "<img src='http://localhost/testBDD/". $row[0] ."' />";
	}
}

foreach($result as $res)
{
	echo "<img src='http://localhost/testBDD/". $res ."' />";
}

?>
