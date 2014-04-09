<?php

$conn = new SQLite3('test.db');

$res = $conn->query('select path from files where id_file in (select file from texts)');

while($row = $res->fetchArray(SQLITE3_NUM))
{
	echo htmlspecialchars(base64_decode($row[0]));
	echo '<hr/>'; // print horizontal line
}
