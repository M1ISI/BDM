<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<body>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="file" name="text_file">
		<select name="lang">
			<option value="en" selected> English </option>
			<option value="fr"> Français </option>
		</select>
		<input type="submit">
	</form>
	
	<p>
		<a href="search.php">Revenir à la recherche</a>
	</p>
</body>
</html>


<?php
include_once('pdf2txt.php');

//~ echo var_dump($_POST['text_file']);
//~ echo var_dump($_FILES['text_file']);
if(isset($_FILES['text_file'])) {
	
	echo '<p>';
	
	if(!$_FILES['text_file']['error']) {
		require_once('./functions.php');
		
		echo 'Upload: ' . $_FILES['text_file']['name'] . '<br>';
		echo 'Type: ' . $_FILES['text_file']['type'] . '<br>';
		echo 'Size: ' . ($_FILES['text_file']['size'] / 1024) . ' kB<br>';
		echo 'Stored in: ' . $_FILES['text_file']['tmp_name'];
		
		
		//On déplace le fichier du texte dans le dossier correspondant.
		$name = $_FILES['text_file']['name'];
		$path = "./$name";
		move_uploaded_file($_FILES['text_file']['tmp_name'], $path);
		
		
		//On analyse le texte avec le programme d'analyse PERL et on récupère le vecteur de mots.
		$tmp_path = "/tmp/text_analyse_".str_replace(array(" "), array("_"), $name);
		
		switch($_FILES['text_file']['type'])
		{
			case "application/pdf": // pdf
				$pdf = new PDF2Text();
				$pdf->setFilename($path);
				$pdf->decodePDF();
				//file_put_contents('tmp.txt', $pdf->output());
				file_put_contents('tmp.txt', $pdf->output()); // on le stocke dans un txt temporaire
				$path = 'tmp.txt';                   // le nouveau path est celui du temporaire
				$text = file_get_contents($path);    // le contenu du txt est stocké ici
			break;
			case "application/vnd.oasis.opendocument.text":			//odt
				$text = extracttext($path);          // on extrait le texte du fichier 
				file_put_contents('tmp.txt', $text); // on le stocke dans un txt temporaire
				$path = 'tmp.txt';                   // le nouveau path est celui du temporaire
				$text = file_get_contents($path);    // le contenu du txt est stocké ici
				break;
			default :	// txt en general
				$text = file_get_contents($path);    // le contenu du txt est stocké ici
		}

		// On regarde si l'utilisateur à donner un fichier en français ou en anglais
		if($_POST['lang'] == "fr")
			exec("./cmd/tree-tagger-french $path > $tmp_path");
		else
			exec("./cmd/tree-tagger-english $path  > $tmp_path");
			
		echo $tmp_path;
		$table = preg_split("/[\s]+/", file_get_contents($tmp_path));
		$word_total = 0;
		/*for($i=0; $i<sizeof($table); $i++) {
			 echo $table[$i];
			 echo '<br/>';
			 $word_total += 1;
		}*/

		$vector = getVector($table, $_POST['lang']);
		//On trie les mots par nombre d'occurences décroissant.
		usort($vector, 'compareWords');
		//Et on compte le nombre d'occurences total de tous les mots clef.
		$word_count = 0;
		for($i=0; $i<sizeof($vector); $i++)
		{
			$word_count += $vector[$i][1];
		}
		
		//On crée une entrée pour le texte et ses mots clefs dans la base de données.
		$db = new SQLite3('test.db');

		//On vérifie si le type du fichier existe
		$request = $db->query("SELECT id_type FROM types WHERE type='".$_FILES['text_file']['type']."'");
		$row = $request->fetchArray(SQLITE3_NUM);
		// S'il n'existe pas on le crée et on récupère son identifiant
		if( $row['count'] == 0)
		{
			$db->exec("insert into types (type) values ('".$_FILES['text_file']['type']."')"); // on insère le type
			$request = $db->query("select last_insert_rowid()"); // on récupère le dernier id ajouté
			$row = $request->fetchArray(SQLITE3_NUM);
			$id_type = $row[0];
		}
		else
		{
			$id_type = $row[0];
		}
		
		// On insere le fichier en premier
		$request = $db->prepare('INSERT INTO files (type, path, url) VALUES(:type, :path, :url)');
		$request->bindValue(':type', $id_type);
		$name = $_FILES['text_file']['name'];
		$path = "/tmp/$name";//obtenir le chemin du fichier qui est déjà dans "uploaded"
		$request->bindValue(':path',$path);
		$request->bindValue(':url', "");
		$request->execute();

		$request = $db->query("select last_insert_rowid()"); // on récupère le dernier id ajouté (celui du fichier)
		$row = $request->fetchArray(SQLITE3_NUM);
		$id_file = $row[0];

		// On insere le texte ensuite (on lui associe le fichier et le nombre de mots)
		$request = $db->prepare('INSERT INTO texts (name, file, nb_words) VALUES(:name, :file, :nb_words)');
		$request->bindValue(':name', $name);
		$request->bindValue(':file', $id_file);
		$request->bindValue(':nb_words', sizeof($word_count));
		$request->execute();

		$request = $db->query("select last_insert_rowid()"); // on récupère le dernier id ajouté (celui du texte)
		$row = $request->fetchArray(SQLITE3_NUM);
		$id_text = $row[0];

		// On insere les mots dans la base de données et on les associe au texte
		for($i=0; $i<sizeof($vector); $i++)
		{
			//On teste si le mot existe déjà dans la base de données
			$request = $db->query("SELECT id_word FROM words WHERE word='".$vector[$i][0]."'");
			$row = $request->fetchArray(SQLITE3_NUM);
			// S'il n'existe pas on le crée et on récupère son identifiant
			if( $row['count'] == 0)
			{
				$request = $db->prepare('INSERT INTO words (word) VALUES(:word)');
				$request->bindValue(':word', $vector[$i][0]);
				$request->execute();

				$request = $db->query("select last_insert_rowid()"); // on récupère le dernier id ajouté (celui du mot)
				$row = $request->fetchArray(SQLITE3_NUM);
				$id_word = $row[0];
			}
			// Sinon on récupère juste son identifiant
			else
			{
				$id_word = $row[0];
			}
			$request = $db->prepare('INSERT INTO texts_keywords (text, word, count) VALUES (:text, :word, :count)');
			$request->bindValue(':text', $id_text);
			$request->bindValue(':word', $id_word);
			$request->bindValue(':count', $vector[$i][1]);
			$request->execute();
		}
		/*$request = $db->prepare('INSERT INTO texts (default, link, file, word_count) VALUES(link:link, file:file, word_count:word_count)');
		$request->bindValue(':link', 'NULL');
		$request->bindValue(':file', $path);
		$request->bindValue(':word_count', $word_count);
		$request->execute();*/
		
		
		//~ $db->exec("INSERT INTO texts (default,link,file,word_count)" VALUES(link,file,word_count));
		//~ $db->exec("INSERT INTO words (default,word)" VALUES(word));
		//~ $db->exec("INSERT INTO tags (default,id_text,id_word,mark)" VALUES(default,id_text,id_word,mark));
		//~ $db->exec("Select * FROM texts");
		//~ $db->exec("Select * FROM words");
		//~ $db->exec("Select * FROM tags");
		
		//~ 
		//~ $request->bind();
		//~ $result = $request->execute();
		
		//echo var_dump($vector);
		$max_key_words_nb = 10;
		//~ $request = $db->prepare('INSERT ...');
		echo '<br/>';
		for($i=0; $i<$max_key_words_nb && $i<sizeof($vector); $i++) {
			//echo htmlspecialchars($vector[$i][0]) . '(' . $vector[$i][1] . ')<br/>';
			//~ $request->bind();
			//~ $result = $request->execute();
		}
		
		//On peut afficher les mots clefs à l'utilisateur et l'identifiant du texte dans la BDD.
		
		$db->close();
	} else {
		echo 'Erreur lors du chargement du texte.';
	}
	
	echo '</p>';
}

?>
