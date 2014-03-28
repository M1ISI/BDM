<?php

$conn = new SQLite3('test.db');

$res = $conn->query('select * from TEXTS');

while($row = $res->fetchArray(SQLITE3_ASSOC))
{
	echo htmlspecialchars(base64_decode($row['FILE']));
	echo '<hr/>'; // print horizontal line
}
