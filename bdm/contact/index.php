<html>
	<head>
	<?php
		
		if(isset($_GET['lang']) && $_GET['lang']=="en")
			echo '<title>contact us</title>';
		else
			echo '<title>Nous contacter</title>';
	?>

	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	</head>

	<body>
		<a href="index.php?lang=fr"><img style='border:none' src='images/fr.png' width=20 height=20></a>
		<a href="index.php?lang=en"><img style='border:none' src='images/us.png' width=20 height=20></a>

	<?php
		// lien de retour
		if(isset($_GET['lang']) && $_GET['lang']=="en")
			echo '<a href="../index.php?lang=en">Back home</a>';
		else
			echo '<a href="../index.php">Retour à la page d\'accueil</a>';
	
		// contenu
		if(isset($_GET['lang']) && $_GET['lang']=="en")
			echo '<p> To contact the developpers you can create an issue directly on <a href="https://github.com/M1ISI/BDM/issues" target=_blank>our github page</a> </p><p>or</p><p><a href="mailto:luisjomen2a@gmail.com" target=_blank>Send us an e-mail.</a></p>';
		else
			echo '<p>Pour faire un retour aux développeurs vous pouvez créer une issue directement sur <a href="https://github.com/M1ISI/BDM/issues" target=_blank>notre page github</a> </p><p>ou</p><p><a href="mailto:luisjomen2a@gmail.com" target=_blank>envoyez nous un mail directement</a>.</p>';	
			
	?>
	</body>


</html>
