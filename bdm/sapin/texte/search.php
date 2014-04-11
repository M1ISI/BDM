<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<body>
	<form action="" method="post">
		<label for="field" name="lbl_field">Recherche : </label>
		<input name="field" />
		<input type="submit" />
	</form>
</body>
</html>

<?php
	if(isset($_POST['field']))
	{
		$db = new SQLite3('test.db');
		
		//On insère le type s'il n'existe pas
		$query =  "SELECT name, file FROM texts WHERE id_text IN ";	// On veut les noms des textes avec leurs fichiers qui...
		$query .= "(SELECT text FROM texts_keywords WHERE word IN "; // ont des mots qui...
		$query .= "(SELECT id_word FROM words WHERE word LIKE '".$_POST['field']."%') "; // commencent par ce qui est entré dans le champ
		$query .= "ORDER BY count DESC)"; // et on ordonne la liste par pertinence
		$request = $db->query($query);
		//echo $query;
		while($row = $request->fetchArray(SQLITE3_NUM))
		{
			echo $row[0];
			//echo "<a href=''>". $row[O] ."</a> <br/>";
		}
	}
?>
