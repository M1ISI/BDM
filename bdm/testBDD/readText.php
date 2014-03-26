<?php

$conn = new SQLite3('test.db');

$res = $conn->query('select * from TEXTE');

while($row = $res->fetchArray(SQLITE3_ASSOC))
{
	echo htmlspecialchars(base64_decode($row['TEXTE']));
	echo '<hr/>'; // print horizontal line
}
