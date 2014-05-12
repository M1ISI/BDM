<?php

require_once("image_color.php");

function hex2rgb($hex) {
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

$db = new SQLite3('/var/www/bdm/testBDD/test.db');

$commonColor = new GetMostCommonColors();

//print($list);
$res = $db->query("SELECT path, id_file FROM files WHERE id_file IN (SELECT file FROM images)");
$row = $res->fetchArray(SQLITE3_NUM);
while ($row = $res->fetchArray(SQLITE3_NUM))
{
	$colors = $commonColor->Get_Color("/var/www/bdm/testBDD/".$row[0]);
		
	foreach($colors as $color => $percent)
	{	
		$request = $db->prepare('INSERT INTO colors (r, g, b) VALUES (:r, :g, :b)');
		foreach(hex2rgb($color) as $c => $val)
		{
			switch($c)
			{
				case 0:
					$request->bindValue(':r', $val);
					break;
				case 1:
					$request->bindValue(':g', $val);
					break;
				case 2:
					$request->bindValue(':b', $val);
					break;
				default:
					break;
			}
		}
		$request->execute();
		
		$request = $db->query("select last_insert_rowid()"); // on récupère le dernier id ajouté
		$r = $request->fetchArray(SQLITE3_NUM);
		$id_color = $r[0];
		
		$request = $db->query("select id_image from images where file = ".$row[1]); // on récupère le dernier id ajouté
		$r = $request->fetchArray(SQLITE3_NUM);
		$id_image = $r[0]; 
		
		$request = $db->prepare('INSERT INTO have_color (image, color, percent) VALUES (:image, :color, :percent)');
		$request->bindValue(':image', $id_image);
		$request->bindValue(':color', $id_color);
		$request->bindValue(':percent', $percent);
		$request->execute();
	}
}
$db->close();

?>
