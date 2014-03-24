<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<p>Recherche du nombre d'occurence du lemme de mots (hors mots-outils) dans un texte : </p>
<p>
<form action="index.php" method="post">
Entrez le(s) mot(s) à chercher : <br/>
<input type="text" name="words" /><br/>
Entrez le nom du fichier :<br/>
<input type="text" name="file" /><br/>
Choisissez la langue du fichier : 
<input type="radio" name="lang" value="en" id="en" checked="checked" /> <label for="en">English</label>
<input type="radio" name="lang" value="fr" id="fr" /> <label for="fr">Français</label><br/>
<input type="submit" value="OK"></p>
</form></p>

<?php 

	////////////////////////////////////////////////////////
	// definitions de fonctions

	// renvoie $array auquel on a ajouté une occurence a l'entrée $word
	function addWord($word, $array)
	{
		$i=0;
		$j=0;
		for($j; $j<sizeof($array); $j++)
		{
			if($array[$j][0]==$word)
			{	// le mot est dans le tableau
				$array[$j][1] = $array[$j][1]+1;
				break;
			}
		}
		if($j==sizeof($array))
		{	// le mot n'est pas dans le tableau
			$array[$j][0] = $word;
			$array[$j][1] = 1;
		}
		return $array;
	}

	// $input : tableau de sortie de Treetagger avec t[i]= le mot, t[i+1]= son type et t[i+2] = son lemme
	// $lang : la langue utilisee pour l'analyse du texte
	// $renvoie le vecteur de mot du texte
	function getVector($input, $lang)
	{
		$vector = array();
		for($i=0; $i+2<sizeof($input); $i=$i+3)
		{	 
			$type = $input[$i+1];
			if($lang='fr')
			{	// si le texte est en français
				if($type!='DET:ART' && $type!='DET:POS' && $type!='INT' && $type!='KON' && $type!='PRO' && $type!='PRO:DEM' 
				&& $type!='PRO:IND' && $type!='PRO:PER' && $type!='PRO:POS' && $type!='PRO:REL' && $type!='PRP' && $type!='PRP:det' 
				&& $type!='PUN' && $type!='PUN:cit' && $type!='SENT' && $type!="''" && $type!=',' && $type!=':' && $type!='``' && $type!=';')
				{// si le mot n'est pas un mot-outils
					if($type=='CD' && $input[$i+2]=='<unknown>')
						$vector=addWord($input[$i], $vector);
					else
						$vector=addWord($input[$i+2], $vector);
				}
			}
			else
			{	// sinon anglais par défault
				if($type!='DT' && $type!='CC' && $type!='IN' && $type!='EX' && $type!='UH' && $type!='LH' && $type!='RP' && $type!='RB' 
				&& $type!='PP' && $type!='PP$' && $type!='POS' && $type!='WP' && $type!='WP$' && $type!='PDT' && $type!='TO' && $type!='WDT' 
				&& $type!='WRB' && $type!='SENT' && $type!="''" && $type!=',' && $type!=':' && $type!='``' && $type!=';')
				{ // si le mot n'est pas un mot-outils
					if($type=='CD' && $input[$i+2]=='<unknown>')
						$vector=addWord($input[$i], $vector);
					else
						$vector=addWord($input[$i+2], $vector);
				}
			}
		}
		
		return $vector;
	} 
	
	// renvoie le nombre d'occurences d'un nombre dans un vecteur
	function countWord($word, $vector)
	{
		$n=0;
		for($i=0 ; $i<sizeof($vector); $i++)
		{
			if($vector[$i][0]==$word)
			{	
				$n = $n + $vector[$i][1];
			}
		}
		
		return $n;
	}
	
	
	// fin des fonctions
	////////////////////////////////////////////////////////////////////
	
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
