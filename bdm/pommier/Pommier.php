<html xmlns-"httm://www.w3.org/1999/xhtml">
<head>
</head>
<body>
<?php

	$search = "toto";

	if(isset($_POST['search']))
	{
		$search = $_POST['search'];

		$lang = $_POST['Langage'];	


		//Remplacement des espaces par des "+"

		$search = str_replace(" ","+",$search );

		if($search!= "")
		{
			//On recupere les resulats
			$machin = file_get_contents("http://suggestqueries.google.com/complete/search?client=chrome&hl=".$lang."&q=".$search);			
	
			$cmpt = 0;
			$compteur = 0;
			$data = "\0";

			//Extraction des entrees sugerees
			for($i = 0 ; $i < strlen($machin); $i++)
			{
				if($compteur >= 10)
					break;

				if($cmpt%2 == 1 && $cmpt !=1)
				{
					if(substr($machin , $i , 1) != "\"")
					{
						$data .= substr($machin , $i , 1);
					}
				}

				if(substr($machin , $i , 1)== "]")
					break;

				if(substr($machin, $i , 1)== "\"")
				{
					$cmpt++;
					if($cmpt%2 == 0 && $cmpt >2)
					{
						$compteur++;
						echo '<span class="resultat"> ' . $data . '</span><br />';
						$data = "";
					}	
				}
			}
		}
		else
		{
			echo "recherche vide";
		}
	}
	else
	{
		echo "recherche vide";
	}
?>
<div id="test"></div>
</body>
</html>
