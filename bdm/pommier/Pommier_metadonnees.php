<!-- recherche d'un nouveau mot-clef en regardant les meta keywords des resultats de google -->

	<form action="Pommier_metadonnees.php" method="post">
 	<p>
 		tapez votre recherche : <input name="search" type="text" id="ChampRecherche" />
 		<input type="submit" value="Rechercher"  />
 	</p>
 	</form>
 <?php 
 
	if(isset($_POST['search']))
	{
		// entree : $query
		// sortie : $new_keyword
		
		// variable contenant la recherche
		$query = $_POST['search'];
		
		// remplace les espaces par des +
		$query = str_replace(" ", "+", $query);
		
		// url pour appel a google search
		$url_googleResult = "http://ajax.googleapis.com/ajax/services/search/web?v=1.0&gl=fr&rsz=large&q=".$query;

		// recuperation de la recherche
		$body = file_get_contents($url_googleResult);
		$json = json_decode($body);

		$new_keyword_found = false;
		$new_keyword = $query;
		
		$x=0;
		//echo $json->responseData->results[$x]->visibleUrl;

		while($x<count($json->responseData->results) && $new_keyword_found==false)
		{ // tant qu'on n'a pas de nouveau mot-clef et qu'on n'a pas parcouru tous les resultats

			// lien de la prochaine reponse
			$url = 'http://'.$json->responseData->results[$x]->visibleUrl.'/';
			// on recupere dans un string le html de la page $url
			$homepage = file_get_contents($url);
			
			// on garde seulement la partie meta keyword
			$meta_keywords = '<meta name="keywords" content="';
			$begin = strpos($homepage, $meta_keywords);
			if($begin!=0)
			{
				$begin = $begin+strlen($meta_keywords);
				$end = strpos($homepage, '"', $begin);
				// liste des mots-clefs
				$keywords = substr($homepage, $begin, $end-$begin);
				// tableau de mots-clefs (avec potentiellement des espaces)
				$keywords_array = preg_split("/[\s,]+/", $keywords);
				$i=0;
				while($i<sizeof($keywords_array) && strcasecmp($new_keyword, $query) == 0)
				{
					if(strcasecmp($keywords_array[$i], "")!=0)
					{	// au cas où un mot-clef est vide
						$new_keyword = $keywords_array[$i];
					}
					$i = $i+1;
				}
				
				//on verifie si on a trouve un nouveau mot-clef
				if(strcasecmp($new_keyword, $query) != 0)
					$new_keyword_found=true;
			}
			
			$x = $x+1;
		}
		
		// affichage du resultat
		if(strcasecmp($new_keyword, $query) != 0)
			echo "Nouveau mot-clef : ".$new_keyword;
		else
			echo "Aucun nouveau mot-clef trouve.";
	}
?>


