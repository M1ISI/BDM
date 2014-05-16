<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<body>
<!--
	<form action="" method="post">
		<label for="field" name="lbl_field">Recherche : </label>
		<input name="field" />
		<input type="submit" />
	</form>
	
	<p>
		<a href="add_text.php">Importer un nouveau fichier</a> &middot; 
		<a href="../">Revenir au sapin</a> &middot; 
		<a href="../../index.php">Revenir à l'accueil principal</a>
	</p>
-->
<?php
function exist($result, $val)
{
	$exist = false;
	
	foreach($result as $res)
	{
		if($res == $val)
			$exist = true;
	}
	
	return $exist;
}


if(isset($_POST['field']))
{
	$db = new SQLite3('test.db');
	$keywords = explode(' ', $_POST['field']);
	$result = array();
	
	foreach($keywords as $keyword)
	{
		$query =  "SELECT name FROM texts WHERE id_text IN ";	// On veut les noms des textes avec leurs fichiers qui...
		$query .= "(SELECT text FROM texts_keywords WHERE word IN "; // ont des mots qui...
		$query .= "(SELECT id_word FROM words WHERE word LIKE '".$keyword."%') "; // commencent par ce qui est entré dans le champ
		$query .= "ORDER BY count DESC)"; // et on ordonne la liste par pertinence
		$request = $db->query($query);
		//echo $query;
		while($row = $request->fetchArray(SQLITE3_NUM))
		{
			if(!exist($result, $row[0]))
			{
				array_push($result,$row[0]);
			}
		}
	}
	echo '<p>Texte : </p><ul>';
	foreach($result as $res)
	{
		echo "<li><a href='". $res ."'> $res </a></li>";
	}
	echo '</ul>';
}
?>
</body>
</html>
