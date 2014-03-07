<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title>buisson demo</title>
<style>
</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>
<body>

<input type="text" id="champ" />
<input type="submit" id="ok" />

<p>

</p>

<script>

$(document).ready(function(){
	$("#ok").click(function(){
		$.ajax({
			type: 'GET',
			url: 'https://duckduckgo.com/',
			data: {q: $("#champ").val(), format: 'json'},
			jsonpCallback: 'jsonp',
			dataType: 'jsonp',
			success: function(data){
				if(data.RelatedTopics.length > 0)
				{
					var premiereLigne = data.RelatedTopics[0].Text;
					var premierMot = premiereLigne.slice(0, premiereLigne.indexOf(" "));
					$('p').html("Resultat DuckDuckGo : " + premierMot);
				}
				else
				{
					$('p').html("Pas de resultats...");
				}
			},
			error: function(xhr, status, error){
				alert("Erreur...");
			}
		});
	});
});
</script>
</body>
</html>
