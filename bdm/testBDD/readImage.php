<?php

$conn = new SQLite3('test.db');

$res = $conn->query('select id_file from files where id_file in (select file from images)');

while($row = $res->fetchArray(SQLITE3_NUM))
{
	//header('Content-Type: image/jpeg');
	//print base64_decode($row[1]);
	echo '<img src="image.php?id='. $row[0] .'" />';
}

?>
