<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<body>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="file" name="text_file">
		<input type="submit">
	</form>
</body>
</html>


<?php
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
		$path = "./texts_files/$name";
		move_uploaded_file($_FILES['text_file']['tmp_name'], $path);
		
		
		//On analyse le texte avec le programme d'analyse PERL et on récupère le vecteur de mots.
		$tmp_path = "/tmp/text_analyse_$name";
		exec("./cmd/tree-tagger-french $path  > $tmp_path");
		$table = preg_split("/[\s]+/", file_get_contents($tmp_path));
		//~ for($i=0; $i<sizeof($table); $i++) {
			//~ echo $table[$i];
			//~ echo '<br/>';
		//~ }
		$vector = getVector($table, 'en');
		//On trie les mots par nombre d'occurences décroissant.
		usort($vector, 'compareWords');
		//Et on compte le nombre d'occurences total de tous les mots clef.
		$word_count = 0;
		for($i=0; $i<sizeof($vector); $i++)
			$word_count += $vector[$i][1];
			
		
		
		
		//On crée une entrée pour le texte et ses mots clefs dans la base de données.
		$db = new SQLite3('texts');
		
		$request = $db->prepare('INSERT INTO texts (default, link, file, word_count) VALUES(link:link, file:file, word_count:word_count)');
		$request->bindValue(':link', 'NULL');
		$request->bindValue(':file', $path);
		$request->bindValue(':word_count', $word_count);
		$request->execute();
		
		
		//~ $db->exec("INSERT INTO texts (default,link,file,word_count)" VALUES(link,file,word_count));
		//~ $db->exec("INSERT INTO words (default,word)" VALUES(word));
		//~ $db->exec("INSERT INTO tags (default,id_text,id_word,mark)" VALUES(default,id_text,id_word,mark));
		//~ $db->exec("Select * FROM texts");
		//~ $db->exec("Select * FROM words");
		//~ $db->exec("Select * FROM tags");
		
		//~ 
		//~ $request->bind();
		//~ $result = $request->execute();
		
		//~ echo var_dump($vector);
		$max_key_words_nb = 10;
		//~ $request = $db->prepare('INSERT ...');
		echo '<br/>';
		for($i=0; $i<$max_key_words_nb && $i<sizeof($vector); $i++) {
			echo htmlspecialchars($vector[$i][0]) . '(' . $vector[$i][1] . ')<br/>';
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
