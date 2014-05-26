var pronoms = ['le', 'la', 'les', 'the', 'et', 'ou', 'and'];

/**
* Test si une chaine est présente dans un tableau
* @params : tableau dans lequel on cherche
* @params : chaine à rechercher
* @return : un booléen à vrai si l'élément est présent, faux sinon
*/
function isInArray(tableau, element)
{
	if(tableau.length > 0)
	{
		var exist = false;
		$.each(tableau, function(i, v){
			if(v.toLowerCase() == element.toLowerCase())
			{
				exist = true;
				return false;
			}
		});
		return exist;
	}
	else
	{
		return false;
	}
}

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

		var retour = new Array();
		var id = 0;
		/* Suppression de la ponctuation */
		var ponctuation = /['%!:;,?.]/;
		$.each(resultats, function(i, v){
			var mots = v.split(ponctuation);
			$.each(mots, function(j, w){
				retour[id] = w;
				id++;
			});
		});

		return retour;
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
						while(ind_scnd_mot < val.length && isInArray(pronoms, spl[ind_scnd_mot]) == true)
							ind_scnd_mot++;
						if(spl[ind_scnd_mot] != null)
						{
							resultat[id] = spl[ind_scnd_mot];
							id++;
						}
					}
					else if(index_mot == spl.length - 1)
					{
						ind_scnd_mot = spl.length - 2;
						while(ind_scnd_mot >= 0 && isInArray(pronoms, spl[ind_scnd_mot]) == true)
							ind_scnd_mot--;
						if(spl[ind_scnd_mot] != null)
						{
							resultat[id] = spl[ind_scnd_mot];
							id++;
						}
					}
					else
					{
						ind_scnd_mot = 0;
						ind_g = index_mot - 1;
						ind_d = index_mot + 1;
						while(ind_g >= 0 && isInArray(pronoms, spl[ind_scnd_mot]) == true)
							ind_g--;
						while(ind_d < spl.length && isInArray(pronoms, spl[ind_scnd_mot]) == true)
							ind_d++;
						
						if(index_mot - ind_g > ind_d - index_mot)
							ind_scnd_mot = ind_d;
						else
							ind_scnd_mot = ind_g;

						if(spl[ind_scnd_mot] != null)
						{
							resultat[id] = spl[ind_scnd_mot];
							id++;
						}
					}
				}
			}
		});
		
		/* On supprime juste les mots avec parenthèses */
		var tab = new Array();
		var i = 0;
		var r = /\(.*\)/;
		$.each(resultat, function(id, v){
			if(r.test(v) == false)
			{
				tab[i] = v;
				i++;
			}
		});

		return tab;
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

function getResults(chaine)
{
	var affichage = $('#affichage_buisson');
	$.ajax({
		type: 'GET',
		url: 'https://duckduckgo.com/',
		data: {q: chaine, format: 'json'},
		/*jsonpCallback: 'jsonpResults',*/
		dataType: 'jsonp',
		success: function(data){	
			if(data.RelatedTopics.length > 0)
			{
				var res = getLinkWords(data);
				var parentheses = parseParenthese(res);
				
				var leftRight = new Array();
				var mots = chaine.split(' ');
				$.each(mots, function(i, m){
					$.merge(leftRight, leftOrRight(res, m));
				});
				
				$.merge(parentheses, leftRight);
					
				$.each(parentheses, function(i, v){
					if(i >= 10)
						return false;
					affichage.append('<span class="res_buisson">' + v + '</span><br />');
				});
			}
			else
			{
				if(data.Definition.length > 0)
				{
					/* Suppression de la ponctuation */
					var ponctuation = /['%!:;,?. ]/;
					var tab = data.Definition.split(ponctuation);
					var ret = sort_occurences(tab);
					var id_max;
					var max = 0;
					$.each(tab, function(i, v){
						if(v != champ && (ret[v])[0] > max)
						{
							max = (ret[v])[0];
							id_max = v;
						}
					});
					affichage.append(ret[id_max][1]);
				}
			}
		},
		error: function(xhr, status, error){
			// decommenter si vous avez des problemes lors de la requete
			//alert("xhr="+xhr+" status="+status+" error="+error);
		}
	});
}

/*function jsonpResults(arg1)
{
	// none
}*/
