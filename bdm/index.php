<?php
session_start();

require_once('saule/connect_functions.php'); 
try{
	google_connection();
}catch(Google_AuthException $e){}
facebook_connection();
twitter_connection();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta charset="utf-8"> 
	<title>ISI Search</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" />
</head>
<body>
<h1>ISI Search</h1>
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
	{
		$('#saule').show();
		$('#sauleButton').show();
	}
	else
	{
		$('#saule').hide();
		$('#sauleButton').hide();
	}
}

function click_sapin(afficher)
{
	/*if(afficher)
		$('#sapin').show();
	else
		$('#sapin').hide();*/
	window.location.href = "sapin/index.html";
}

</script>
<!-- Changement de langue et Liens vers les pages d'aides et de contacts -->
<p><a href="index.php?lang=fr"><img style='border:none' src='contact/images/fr.png' width=20 height=20></a>
	<a href="index.php?lang=en"><img style='border:none' src='contact/images/us.png' width=20 height=20></a>
<?php
	if(isset($_GET['lang']) && $_GET['lang']=="en")
	{
		echo '<a href="contact/help.php?lang=en">Help</a> ' ;
		echo '<a href="contact/index.php?lang=en">Contact</a> ' ;
		echo '<a href="contact/help.php?lang=en#mentions_legales">Legal information</a> ';
	}
	else
	{
		echo '<a href="contact/help.php">Aide</a> ' ;
		echo '<a href="contact/index.php">Nous contacter</a> ' ;
		echo '<a href="contact/help.php#mentions_legales">Mentions Légales</a> ';
	}
?>
</p>

<!--<img src="http://imageshack.com/a/img842/1300/nt7j.png" /><br /> -->
<div id="content" style="text-align:center;">
	<object type="image/svg+xml" data="logotree.svg">
		Votre navigateur ne permet pas d'afficher le SVG.
	</object>
</div>

<div id="formulaire">
<img id="retour" alt="Retour" src="arrow_left.png" title="Effacer le dernier mot" />
<input type="text" id="recherche" />
<select id="langue">
	<option value="fr">Francais</option>
	<?php 
		if(isset($_GET['lang']) && $_GET['lang']=="en")
			echo '<option value="en" selected>English</option>';
		else
			echo '<option value="en">English</option>';
	?>
	<option value="es">Espanol</option>
	<option value="de">Deutsch</option>
</select>
</div>

<div id="resultats">
	<div id="sapin">
		<div id="music"></div>
		<div id="texte"></div>
		<div id="image"></div>
	</div>
	<div id="buisson"></div>
	<div id="pommier">
		<div id="suggestions">
		</div>
		<div id="googleResult">
		</div>
	</div>
	<div id="saule"></div>
</div>

<a href="./saule/index2.php"><input type="button" id="sauleButton" name="saule" value = "Accès recherche par réseaux sociaux" /></a>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://www.google.com/jsapi"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script src="buisson/buisson.js"></script>
<script>
$(function() {
$( document ).tooltip();
});

$('document').ready(function(){

	google.load('search', '1', {'language' : 'fr'});
	

	google.setOnLoadCallback(function(){
		$(function(){
			$('#recherche').keyup(function(){

				var googleResults = $('#pommier #googleResult');

				googleResults.html('');

				var searchComplete = function(searchControl, searcher){
					for (result in searcher.results) {
						var content = searcher.results[result].content;
						var title = searcher.results[result].title;
						var url = searcher.results[result].url;
						googleResults
							.append($('<a/>').attr('href', url).html(title))
							.append($('<p/>').html(content));
					}
				};

				// Create a search control
				var searchControl = new google.search.SearchControl();

				// Add in a set of searchers
				searchControl.addSearcher(new google.search.WebSearch());

				// tell the searchControl to draw itself (without this, the searchComplete won't get called - I'm not sure why)
				searchControl.draw();

				searchControl.setLinkTarget(google.search.Search.LINK_TARGET_SELF);
				searchControl.setSearchCompleteCallback(this, searchComplete);
				searchControl.execute($(this).val());
			});
		});
	});

	$('#recherche').keyup(function(){
		var buisson = $('#buisson');
		var pommier = $('#pommier #suggestions');
		var sapin = $('#sapin');
		var saule = $('#saule');

	//	var checkFacebook = $('<input type="checkbox" id="facebook" name="facebook" value="Facebook">Facebook</input>');
	//	var checkTwitter = $('<input type="checkbox" id="twitter" name="twitter" value="Twitter">Twitter</input>');
	//	var checkGoogle = $('<input type="checkbox" id="google" name="google" value="Google+" onclick="">Google+</input>');

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
		
		/* Appel sapin */
		$.ajax({
			url: "sapin/texte/search.php",
			type: "post",
			data: {field: '' + champ},
			success: function(data){
				// data contient le html de la page "buisson.php" apres qu'elle ait reçu les données dans le post
				sapin.children('div#texte').html(data); // ajoute le HTML au paragraphe
			}
		});

		/* Appel sapin */
		$.ajax({
			url: "testBDD/searchMusic.php",
			type: "get",
			data: {recherche: '' + champ},
			success: function(data){
				// data contient le html de la page "buisson.php" apres qu'elle ait reçu les données dans le post
				sapin.children('div#music').html(data); // ajoute le HTML au paragraphe
			}
		});

		/* Appel saule */
		// Ajout des checkbox si elles n'existent pas
		
		if(!$('input[name="facebook"]').length)
		{
		/*	checkFacebook.appendTo('#saule');
			checkTwitter.appendTo('#saule');
			checkGoogle.appendTo('#saule');*/
		}
		
		// Récupération de la variable $authUrl
	/*	$.ajax({
			url: "script.php",
			type: "post",
			data: {},
			success: function(data){
				// data contient le lien vers la connexion google+
				$('#google').click(function(){
				  window.location = data;
				});
			}
		});
	*/	
	/*	$.ajax({
			url: "saule/index2.php", // TODO put this in a separate file?
			type: "get",
			data: {mainField: '' + champ},
			success: function(data){
				saule.html(data); // ajoute le HTML au paragraphe
			}
		});*/
		
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
	
	// clic sur le bouton retour
	$('body').on('click', 'img#retour', function(){
		var txt = $('#recherche').val();
		var words = txt.split(new RegExp(' +', 'g')); // are we required to use regexps ?
		
		words.pop(); // remove last item from words
		var txt2 = words.join(' ');
		
		$('#recherche').val(txt2);
		$('#recherche').trigger('keyup');
	});

});
</script>
<script>
//<![CDATA[
google.load('search', '1');

function OnLoad() {

	var searchComplete = function(searchControl, searcher){
		for (result in searcher.results) {
			var content = searcher.results[result].content;
			var title = searcher.results[result].title;
			var url = searcher.results[result].url;
			$('#pommier ul')
				.append($('<li></li>')
					.append($('<a/>').attr('href', url).text(title))
					.append($('<p/>').text(content)));
		}
	};

	// called on form submit
	newSearch = function(form) {
	  if (form.input.value) {
		// Create a search control
		var searchControl = new google.search.SearchControl();

		// Add in a set of searchers
		searchControl.addSearcher(new google.search.WebSearch());

		// tell the searchControl to draw itself (without this, the searchComplete won't get called - I'm not sure why)
		searchControl.draw();

		searchControl.setLinkTarget(google.search.Search.LINK_TARGET_SELF);
		searchControl.setSearchCompleteCallback(this, searchComplete);
		searchControl.execute(form.input.value);
	  }
	  return false;
	}

	// bind form submission to my custom code
	var container = document.getElementById("searchFormContainer");
	this.searchForm = new google.search.SearchForm(false, container);
	this.searchForm.setOnSubmitCallback(this, newSearch);
}
google.setOnLoadCallback(OnLoad);

//]]>
</script>

</body>
</html>

