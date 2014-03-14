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

var pronoms = ['le', 'la', 'les', 'the'];

/**
* Retourne la chaine situé entre les balises <a> et </a>.
* @params : le code json
* @return : un tableau contenant pour chaque entrée une chaine ou -1 si une erreur s'est produite.
*/
function getLinkWords(json)
{
	if(json.RelatedTopics.length > 0)
	{
		var resultats = new Array();
		var i = 0;				
		
		// Cherche la chaine entre les balises <a> et </a>
		var reg = /<a href=\".*\">(.*)<\/a>/;
		
		$.each(json.RelatedTopics, function(index, obj)
		{
			// Topics mis en avant
			if(obj.Result != null)
			{
				// Contient le lien + petite description
				var result = obj.Result;
				
				var tab_retour = result.match(reg);
				resultats[i] = tab_retour[1];
				i++;
			}
			else // topics relatifs "secondaires"
			{
				// On prend au maximum 2 items de ces catégories
				var nb = 1;
				var topics = obj.Topics;
				$.each(topics, function(index, topic)
				{
					if(nb == 3)
						return false;
					// Contient le lien + petite description
					var result = topic.Result;
					
					var tab_retour = result.match(reg);
					resultats[i] = tab_retour[1];
					i++;
					
					nb++;
				});
			}
		});
		return resultats;
	}
	else
	{
		return -1;
	}
}

/**
* cherche les mots entre parenthèses dans chaque ligne
* @params : tableau de chaine de caracteres
* @return : les chaines entre parentheses trouvés dans le tableau d'entrée
*/
function parseParenthese(resultats)
{
	if(resultats.length > 0)
	{
		var retour = new Array();
		var i = 0;
		
		// Recherche les mots entre parentheses
		var reg = /\((.*)\)/;
		
		$.each(resultats, function(index, val)
		{
			if(reg.test(val))
			{
				retour[i] = (val.match(reg))[1];
				i++;
			}
		});
		return retour;
	}
	else
	{
		return -1;
	}
}

/**
* Cette fonction recherche le mot à gauche ou à droite du mot en paramètre
* @params : Un tableau de mots où l'on va rechercher
* @params : le mot de référence
* @return : un tableau de mots ou -1 en cas d'erreur
*/
function leftOrRight(mots, mot)
{
	var resultat = new Array();
	var id = 0;
	
	mot = mot.toLowerCase();
	
	if(mots.length > 0)
	{
		$.each(mots, function(index, val)
		{
			// separe chaque mots
			var spl = val.split(' ');
			var index_mot = -1;
			
			$.each(spl, function(k, v){
				if(v.toLowerCase() == mot.toLowerCase())
				{
					index_mot = k;
					return false;
				}
			});
			
			if(spl.length > 1)
			{
				if(index_mot >= 0)
				{
					var ind_scnd_mot;
					if(index_mot == 0)
					{
						ind_scnd_mot = 1;
						while(ind_scnd_mot < val.length && $.inArray(spl[ind_scnd_mot], pronoms) == true)
							ind_scnd_mot++;
						resultat[id] = spl[ind_scnd_mot];
						id++;
					}
					else if(index_mot == spl.length - 1)
					{
						ind_scnd_mot = spl.length - 2;
						while(ind_scnd_mot >= 0 && $.inArray(spl[ind_scnd_mot], pronoms) == true)
							ind_scnd_mot--;
						resultat[id] = spl[ind_scnd_mot];
						id++;
					}
					else
					{
						ind_scnd_mot;
						ind_g = index_mot - 1;
						ind_d = index_mot + 1;
						while(ind_scnd_mot >= 0 && $.inArray(spl[ind_scnd_mot], pronoms) == true)
							ind_g--;
						while(ind_scnd_mot < spl.length && $.inArray(spl[ind_scnd_mot], pronoms) == true)
							ind_d++;
						
						if(index_mot - ind_g > ind_d - index_mot)
							ind_scnd_mot = ind_d;
						else
							ind_scnd_mot = ind_g;
						
						resultat[id] = spl[ind_scnd_mot];
						id++;
					}
				}
			}
		});
		
		return resultat;
	}
	else
	{
		return -1;
	}
}

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
	for(var i in occurences){
		str += "(" + occurences[i][1] + ":" + occurences[i][0] + ")";
	}
	alert(str);*/
	return occurences;
}

$(document).ready(function(){
	$("#ok").click(function(){
		var champ = $('#champ').val();
		$('p').html('');
		$.ajax({
			type: 'GET',
			url: 'https://duckduckgo.com/',
			data: {q: champ, format: 'json'},
			jsonpCallback: 'jsonp',
			dataType: 'jsonp',
			success: function(data){	
				if(data.RelatedTopics.length > 0)
				{
					var res = getLinkWords(data);
					var parentheses = parseParenthese(res);
					var leftRight = leftOrRight(res, champ);
					$.each(parentheses, function(i, v){
						$('p').append(v + '<br />');
					});
					$.each(leftRight, function(i, v){
						$('p').append(v + '<br />');
					});
				}
				else
				{
					if(data.Definition.length > 0)
					{
						var tab = data.Definition.split(' ');
						var ret = sort_occurences(tab);
						var id_max;
						var max = 0;
						$.each(tab, function(i, v){
							if((ret[v])[0] > max)
							{
								max = (ret[v])[0];
								id_max = v;
							}
						});
						$('p').append(ret[id_max][1]);
					}
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
