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
		$.getJSON("https://duckduckgo.com/?q=chat&format=json",function(result){
			
			$('p').html(result);

			/*$.each(result, function(i, field){
				alert("plop");
				//$("p").html(field + " ");
			});*/
		});
	});
});
</script>
</body>
</html>
