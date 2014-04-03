<?php

$conn = new SQLite3('test.db');

$res = $conn->query('select path, type from FILES where id_file ='.$_GET['id']);

$row = $res->fetchArray(SQLITE3_NUM);
header('Content-type: '.$row[1]);
print base64_decode($row[0]);

$conn->close();
?>
