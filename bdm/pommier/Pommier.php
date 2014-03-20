<html xmlns-"httm://www.w3.org/1999/xhtml">
<body>	
<?php

	$search = "toto";

	if(isset($_POST['search']))
	{
		$search = $_POST['search'];

		$lang = $_POST['Langage'];	


		//Remplacement des espaces par des "+"

		$search = str_replace(" ","+",$search );



		if($search!= ""){

			//On recupere les resulats
			$machin = file_get_contents("http://suggestqueries.google.com/complete/search?client=chrome&hl=".$lang."&q=".$search);			
	

			$cmpt = 0;
			$finished = TRUE;

			$data = "\0";

	
			echo "<u>Suggestions :</u>  <br/>";

			//Extraction des entrees sugerees
			for($i = 0 ; $i < strlen($machin)&&$finished == TRUE ; $i++){

			if($cmpt%2 == 1 && $cmpt !=1){

				
				if(substr($machin , $i , 1) != "\""){
				
					$data .= substr($machin , $i , 1);

				}
			}

			if(substr($machin , $i , 1)== "]"){

				$finished = FALSE;
			}

			if(substr($machin, $i , 1)== "\""){

				$cmpt++;

				if($cmpt%2 == 0 && $cmpt >2){

					echo ($cmpt/2 - 1) . ': <span class="resultat"> ' . $data . '</span><br />';
					$data = "";

				}	
			}
		}
	}
	else{
		echo "recherche vide";
	}
}
else
	echo "recherche vide";
?>

<script>
 //<!
google.load('search', '1',{"language" : '<?=$_POST['Langage']?>'});

function OnLoad() {
// Create a search control
	var searchControl = new google.search.SearchControl();

	 // Add in a full set of searchers
	var localSearch = new google.search.LocalSearch();
	searchControl.addSearcher(localSearch);
	searchControl.addSearcher(new google.search.WebSearch());
	// Set the Local Search center point
	localSearch.setCenterPoint("New York, NY");                                                                                             
	// tell the searcher to draw itself and tell it where to attach
	searchControl.draw(document.getElementById("searchcontrol"));
	// execute an inital search
	searchControl.execute('<?=$_POST['search']?>');
}
google.setOnLoadCallback(OnLoad);
</script>

<div id="searchcontrol"></div>
<script src="https://www.google.com/jsapi"type="text/javascript"></script>
</body>
</html>
