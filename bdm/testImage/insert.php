<?php
$error = "ERREUR !!";
//$conn = sqlite_open("test.db");

$conn = new SQLite3('test.db');

/*
$db = new SQLite3($database_filename);
$query = $db->prepare("UPDATE '{$sqlite_table_name}' SET ZIMAGE=? WHERE ZID=?");
$image=file_get_contents($image_filename);
$query->bindValue(1, $image, SQLITE3_BLOB);
$query->bindValue(2, $row_id, SQLITE3_TEXT);
$run=$query->execute();
*/

// Temporary file name stored on the server
$image = base64_encode(file_get_contents($_FILES['image']['tmp_name']));

//$conn->exec("insert into texte values('test', 'test')");
$conn->exec("insert into image (image, lien, type) values('$image','test image','".$_FILES['image']['type']."')");
echo "fin requete\n";

$conn->close();
?>
