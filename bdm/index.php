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
</div>

<div id="resultats">
	<div id="sapin"></div>
	<div id="buisson"></div>
	<div id="pommier">
		<div id="suggestions">
		</div>
		<div id="googleResult">
		</div>
	</div>
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

});
</script>
</html>
<script language="Javascript" type="text/javascript">
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

