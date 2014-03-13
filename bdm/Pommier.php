<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

	<head>

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

	</head> 

	<form action="Pommier.php" method="post">
 	<p>
 		tapez votre recherche : <input name="search" type="text" id="ChampRecherche" />
 		<input type="submit" value="Rechercher"  />
 	</p>
 	</form>

		
	<?php

	$search = "toto";

	if(isset($_POST['search']))
	{
		$search = $_POST['search'];	
	

		//Remplacement des espaces par des "+"

		$search = str_replace(" ","+",$search );





		//On recupere les resulats
		$machin = file_get_contents("http://suggestqueries.google.com/complete/search?client=chrome&hl=fr&q=".$search);			
		
		
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

		echo $search.'</br>';

		//echo file_get_contents("http://suggestqueries.google.com/complete/search?client=chrome&hl=fr&q=".$search);	
		//echo "suggested entry : ". $data;

	//	echo "data is".$data."data ends";



	

 

	}
	else
		echo "recherche vide";


		

		?>

	<script>


	$('document').ready(function(){

		    $('span.resultat').click(function(){

				        var texte = $(this).text();

        $('#ChampRecherche').val(texte);

    });

});	

	</script>	
	
				
</html>
