<?php

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

$db = new SQLite3('test.db');

echo "<p>Image : </p>";
echo "<br>";

	foreach(hex2rgb($_POST['colorpickerField1']) as $c => $val)
	{
		switch($c)
		{
			case 0:
				$r = $val;
				$rlow = max(0, $r - ($r*$_POST['error_rate']/100));
				$rhigh = min(255, $r + ($r*$_POST['error_rate']/100));
				break;
			case 1:
				$g = $val;
				$glow = max(0, $g - ($g*$_POST['error_rate']/100));
				$ghigh = min(255, $g + ($g*$_POST['error_rate']/100));
				break;
			case 2:
				$b = $val;
				$blow = max(0, $b - ($b*$_POST['error_rate']/100));
				$bhigh = min(255, $b + ($b*$_POST['error_rate']/100));
				break;
			default:
				break;
		}
	}
	
$query  = "SELECT path, id_file FROM files WHERE id_file IN ";
$query .= "(SELECT file FROM images WHERE id_image IN ";
$query .= "(SELECT image FROM have_color WHERE color IN ";
$query .= "(SELECT id_color FROM colors WHERE (r>=".$rlow." AND g>=".$glow." AND b>=".$blow.") AND  (r<=".$rhigh." AND g<=".$ghigh." AND b<=".$bhigh."))))";
	
$res = $db->query($query);

while ($row = $res->fetchArray(SQLITE3_NUM))
{
	echo "<img src='testBDD/". $row[0] ."' onclick=\"$(this).dialog({ resizable: false, modal: true, width: 'auto' });\" width=60 height=60 />";
}

?>
