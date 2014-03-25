<?php

$conn = new SQLite3('test.db');

/*
$db = new SQLite3($database_filename);
$query = $db->prepare("UPDATE '{$sqlite_table_name}' SET ZIMAGE=? WHERE ZID=?");
$image=file_get_contents($image_filename);
$query->bindValue(1, $image, SQLITE3_BLOB);
$query->bindValue(2, $row_id, SQLITE3_TEXT);
$run=$query->execute();
*/

if(isset($_POST['kind']))
{
	if($_POST['kind'] == 'image') // cas 1 : on importe une image
	{
		// Temporary file name stored on the server
		$image = base64_encode(file_get_contents($_FILES['image']['tmp_name']));

		//$conn->exec("insert into texte values('test', 'test')");
		// TODO use prepared queries instead
		$conn->exec("insert into image (image, lien, type) values('$image','test image','".$_FILES['image']['type']."')");
		echo "fin requete\n";
	}
	else if($_POST['kind'] == 'text') // cas 2 : on importe du texte
	{
		// user text should ne include ASCII control characters, but...
		// never trust user input => use Base64
		$text = base64_encode($_POST['text']);
		
		// TODO use prepared queries instead (figure out how SQLite3 handles them)
		$conn->exec('insert into texte(texte, lien) values(\'' . $text . '\', test texte\')');
		echo 'Done';
	}
	else // ne devrait jamais arriver !
	{
		header('Location: test.php');
		exit;
	}
}

$conn->close();
