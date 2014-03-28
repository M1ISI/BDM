<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<body>
<h1>Recherche du nombre d'occurence du lemme de mots (hors mots-outils) dans un texte : </h1>
<form action="index.php" method="post">
	<p>Entrez le(s) mot(s) à chercher :</p>
	<input type="text" name="words" /><br/>
	<p>Entrez le nom du fichier :</p>
	<input type="text" name="file" /><br/>
	<p>Choisissez la langue du fichier :</p>
	<p>
		<input type="radio" name="lang" value="en" id="en" checked="checked" /> <label for="en">English</label>
		<input type="radio" name="lang" value="fr" id="fr" /> <label for="fr">Français</label>
	</p>
	<input type="submit" value="OK">
</form>

<?php 

	
	
	if(isset($_POST['words']) && isset($_POST['file']) && isset($_POST['lang']))
	{

		$file = $_POST['file'];
		$lang = $_POST['lang'];
		$file_tmp = 'tmp.txt';
		
		// met le resultat de la lemmitisation dans le fichier $tmp_file
		if($lang=='fr')
			exec('./cmd/tree-tagger-french '.$file.' > '.$file_tmp);
		else
			exec('./cmd/tree-tagger-english '.$file.' > '.$file_tmp);
		
		// met le retour dans un tableau à une dimension
		$tmp = preg_split("/[\s,]+/", file_get_contents($file_tmp));
		// récupère le vecteur de mots
		$vector = getVector($tmp, $lang);
		
		// on lemmatise aussi la recherche
		if($lang=='fr')
			exec('( echo '.$_POST['words'].' | ./cmd/tree-tagger-french ) > '.$file_tmp);
		else
			exec('( echo '.$_POST['words'].' | ./cmd/tree-tagger-english ) > '.$file_tmp);

			
			
		$words_list = preg_split("/[\s,]+/", file_get_contents($file_tmp));
		$words_vector = getVector($words_list, $lang);
		$nb_tot = 0;
		for($i=0; $i<sizeof($words_vector); $i++)
		{
			$nb = countWord($words_vector[$i][0], $vector);
			$nb_tot = $nb_tot + $nb;
			echo "le mot ".$words_vector[$i][0]."\t apparait ".$nb." fois.<br/>";
		}
		echo "<p>les mots apparaissent ".$nb_tot." fois au total.</p><br/>";

	}
?>

</body>
</html>
