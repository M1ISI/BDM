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

function sort_occurences(words) {
	/*var in_str = "";
	for(var i in words) {
		in_str += words[i] + " ";
	}
	alert(in_str);*/
	
	var occurences = new Array();
	for(var i in words) {
		if(occurences.indexOf(words[i]) == -1) {
			occurences[words[i]] = new Array(0, words[i]);
		}
		occurences[words[i]][0]++;
	}
	occurences.sort(function(a,b){return b[0]-a[0]});
	
	/*var str = "";
	for(var i in occurences) {
		str += "(" + occurences[i][1] + ":" + occurences[i][0] + ")";
	}
	alert(str);*/
	return occurences;
}

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
					$('p').html("Résultat DuckDuckGo : " + premierMot);
				}
				else
				{
					$('p').html("Aucun résultat...");
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
