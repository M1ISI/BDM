<?

include '../sapin/image/couleurs/color.php';

ini_set('display_errors', 1); 
error_reporting(E_ALL);


ini_set('max_execution_time', 0); 


$conn = new SQLite3('test.db');


$res = $conn->query('SELECT path,type FROM files AS f JOIN images AS i ON f.id_file = i.id_image ');


while($row = $res->fetchArray(SQLITE3_NUM)){


	$string = base64_decode($row[0]);

	$source = imagecreatefromstring($string);


	$histo = getColors($source,FALSE);

	//printTab($histo);

	foreach($histo as $ind => $color){

		insert into	


	}

}




?>


