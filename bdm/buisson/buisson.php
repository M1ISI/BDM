<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title>buisson demo</title>
<style>
</style>
</head>
<body>
<!-- On réceptionne l'appel Ajax en POST -->
<?php
	if(isset($_POST['recherche']) && !empty($_POST['recherche']))
	{
		$mots = $_POST['recherche'];
		?>
		<script>
			$(function(){
				getResults(<?php echo '"' . $mots . '"'; ?>);
			});
		</script>
		<?php
	}
	else
	{
		echo '<em>Erreur lors de l\'envoi de la requête...</em>';
	}
?>
<div id="affichage_buisson"></div>
</body>
</html>
