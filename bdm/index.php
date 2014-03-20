<html>
<head>
<link rel="stylesheet" href="css.css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
</head>
<body>

<!--<img src="http://imageshack.com/a/img842/1300/nt7j.png" /><br /> -->
<div id="content" style="text-align:center;">
<img style="text-align:top;" src="images/welcome.jpeg" />
<object type="image/svg+xml" data="logotree.svg">
</object>
</div>

<input type="text" id="recherche" />
<select id="langue">
	<option value="fr">Francais</option>
	<option value="en">English</option>
	<option value="es">Espanol</option>
	<option value="de">Deutsch</option>
</select>

<div id="buisson"></div>
<div id="pommier"></div>

</body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script src="buisson/buisson.js"></script>
<script src="pommier/Pommier.js"></script>
<script>
$(function() {
$( document ).tooltip();
});

$('document').ready(function(){
	$('#recherche').keyup(function(){
		var buisson = $('#buisson');
		var pommier = $('#pommier');
		
		var champ = $('#recherche').val(); // récupere la valeur du champ
		if(champ == '')
		{
			buisson.html('');
			pommier.html('');
			return false;
		}
		
		var lang = $('#langue').val();
		
		/* Appel buisson */
		$.ajax({
			url: "buisson/buisson.php",
			type: "post",
			data: {recherche: '' + champ},
			success: function(data){
				// data contient le html de la page "buisson.php" apres qu'elle ait reçu les données dans le post
				buisson.html(data); // ajoute le HTML au paragraphe
			}
		});
		
		/* Appel pommier */
		$.ajax({
			url: "pommier/Pommier.php",
			type: "post",
			data: {search: '' + champ, Langage: '' + lang},
			success: function(data){
				// data contient le html de la page "buisson.php" apres qu'elle ait reçu les données dans le post
				pommier.html(data); // ajoute le HTML au paragraphe
			}
		});
		
		/* Appel saule */
		$.ajax({
			url: "pommier/Pommier.php",
			type: "post",
			data: {search: '' + champ, Langage: '' + lang},
			success: function(data){
				// data contient le html de la page "buisson.php" apres qu'elle ait reçu les données dans le post
				pommier.html(data); // ajoute le HTML au paragraphe
			}
		});
		
	});
});

</script>
</html>
