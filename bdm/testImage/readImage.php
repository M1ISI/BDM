<?php

$conn = new SQLite3('test.db');

$res = $conn->query('select * from IMAGE');

while($row = $res->fetchArray(SQLITE3_NUM))
{
	header('Content-Type: image/jpeg');
	print base64_decode($row[0]);
}

?>
