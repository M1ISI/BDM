<?php
include_once('pdf2txt.php');
$conn = new SQLite3('test.db');
$id_type = 0;
/*
$db = new SQLite3($database_filename);
$query = $db->prepare("UPDATE '{$sqlite_table_name}' SET ZIMAGE=? WHERE ZID=?");
$image=file_get_contents($image_filename);
$query->bindValue(1, $image, SQLITE3_BLOB);
$query->bindValue(2, $row_id, SQLITE3_TEXT);
$run=$query->execute();
*/

//On insère le type s'il n'existe pas
$exist = false;

// On check le type de fichier qu'on nous envoie (image ou texte)
if($_POST['kind'] == 'image')
  $mode = $_FILES['image']['type'];
else if ($_POST['kind'] == 'text')
  $mode = $_FILES['text']['type'];
  echo $mode;
  
  
$res = $conn->query("select type from types");
while($row = $res->fetchArray(SQLITE3_NUM) && !$exist)
{
	if($row[0] == $mode)
		$exist = true;
}
if(!$exist)
{
	$conn->exec("insert into types (type) values ('".$mode."')"); // on insère le type
	$res = $conn->query("select last_insert_rowid()"); // on récupère le dernier id ajouté
	$row = $res->fetchArray(SQLITE3_NUM);
	$id_type = $row[0];
}
else
{
	$res = $conn->query("select id from types where type = '".$mode."'");
	$row = $res->fetchArray(SQLITE3_NUM);
	$id_type = $row[0];
}

if(isset($_POST['kind']))
{
	if($_POST['kind'] == 'image') // cas 1 : on importe une image
	{
		// Temporary file name stored on the server
		$image = base64_encode(file_get_contents($_FILES['image']['tmp_name']));

		// TODO use prepared queries instead
		// On insère le fichier dans la table files
		$conn->exec("insert into files (type, path, url) values($id_type, '$image','test image')");
		// On récupère l'id
		$res = $conn->query("select last_insert_rowid()"); // on récupère le dernier id ajouté
		$row = $res->fetchArray(SQLITE3_NUM);
		$id_file = $row[0];
		// On l'insère dans la lable images
		$conn->exec("insert into images (file) values ($id_file)");
		
		echo "fin requete\n";
	}
	else if($_POST['kind'] == 'text') // cas 2 : on importe du texte
	{
		// user text should ne include ASCII control characters, but...
		// never trust user input => use Base64
		switch($_FILES['text']['type'])
		{
			case 'application/pdf':
				$pdf = new PDF2Text();
				$pdf->setFilename($_FILES['text']['tmp_name']);
				$pdf->decodePDF();
				$text = base64_encode($pdf->output()); 
			break;
			case 'application/vnd.oasis.opendocument.text':			//odt
				$text = file_get_contents($_FILES['text']['tmp_name']);
				break;
			default :
				$text = base64_encode($_POST['text']);
		}
		// TODO use prepared queries instead (figure out how SQLite3 handles them)
		// On insère le fichier dans la table files
		$conn->exec("insert into files (type, path, url) values($id_type, '$text','test text')");
		// On récupère l'id
		$res = $conn->query("select last_insert_rowid()"); // on récupère le dernier id ajouté
		$row = $res->fetchArray(SQLITE3_NUM);
		$id_file = $row[0];
		// On l'insère dans la lable texts
		$conn->exec("insert into texts (file, nb_words) values ($id_file, 5)");// !!! NB WORD EN DUR !!!
		echo 'Done';
	}
	else // ne devrait jamais arriver !
	{
		header('Location: test.php');
		exit;
	}
}

$conn->close();
