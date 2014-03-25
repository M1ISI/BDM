<html>
<head>
<link rel="stylesheet" href="style.css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
</head>
<body>
<script>

function click_pommier(afficher)
{
	if(afficher)
		$('#pommier').show();
	else
		$('#pommier').hide();
}

function click_buisson(afficher)
{
	if(afficher)
		$('#buisson').show();
	else
		$('#buisson').hide();
}

function click_saule(afficher)
{
	if(afficher)
		$('#saule').show();
	else
		$('#saule').hide();
}

function click_sapin(afficher)
{
	if(afficher)
		$('#sapin').show();
	else
		$('#sapin').hide();
}

</script>
<!--<img src="http://imageshack.com/a/img842/1300/nt7j.png" /><br /> -->
<div id="content" style="text-align:center;">
<embed src="logotree.svg">
</object>
</div>

<div id="formulaire">
<input type="text" id="recherche" />
<select id="langue">
	<option value="fr">Francais</option>
	<option value="en">English</option>
	<option value="es">Espanol</option>
	<option value="de">Deutsch</option>
</select>
<input type="submit" id="go" value="go" />
</div>

<div id="resultats">
	<div id="sapin"></div>
	<div id="buisson"></div>
	<div id="pommier"><ul></ul></div>
	<div id="saule"></div>
</div>

</body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://www.google.com/jsapi"type="text/javascript"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script src="buisson/buisson.js"></script>
<script>
$(function() {
$( document ).tooltip();
});

$('document').ready(function(){
	$('#recherche').keyup(function(){
		var buisson = $('#buisson');
		var pommier = $('#pommier');
		var sapin = $('#sapin');
		var saule = $('#saule');
		
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
	});
	
	// click sur les resultats de pommier
	$('body').on('click', 'span.resultat', function(){
		var txt = $(this).text();
		$('#recherche').val(txt.trim());
		$('#recherche').trigger('keyup');
	});
	
	// click sur les resultats de buisson
	$('body').on('click', 'span.res_buisson', function(){
		var txt = $(this).text();
		$('#recherche').val($('#recherche').val().trim() + ' ' + txt.trim());
		$('#recherche').trigger('keyup');
	});
	
	$('#go').click(function(){

		test();
		return false;
	});
	
});
</script>
</html>
