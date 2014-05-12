<html>
	<head>
		<link rel="stylesheet" href="css/colorpicker.css" type="text/css" />
		<title>Tree Fest - Recherche d'images</title>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/colorpicker.js"></script>
		<script type="text/javascript" src="js/eye.js"></script>
		<script type="text/javascript" src="js/utils.js"></script>
		<script type="text/javascript" src="js/layout.js?ver=1.0.2"></script>
	</head>
	<body>
	<h1>Recherche d'images</h1>
	<h2>Par comparaison d'images</h2>
	<form enctype="multipart/form-data" action="result_compare.php" method="post" name="compare">
		<input name="image"  type="file" />
		<input type="hidden" name="kind" value="image" />
		<button type="submit">Rechercher</button>
	</form>
	
	<br>
	<br>
	
	<h2>Par couleur</h2>
	<form action="result_color.php" method="post" name="color">
		<p><input type="text" maxlength="6" size="6" id="colorpickerField1" name="colorpickerField1" value="00ff00" /> (cliquez pour s&eacute;lectionner une couleur)</p>
		<label>Marge d'erreur (en %) : </label>
		<input type="text" id="error_rate" name="error_rate" />
		<button type="submit">Rechercher</button>
	</form>
	
	</body>
</html>
