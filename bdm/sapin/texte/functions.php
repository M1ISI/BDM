<?php

////////////////////////////////////////////////////////
// definitions de fonctions

// renvoie $array auquel on a ajouté une occurence a l'entrée $word
function addWord($word, $array)
{
	$i=0;
	for($i; $i<sizeof($array); $i++)
	{
		if($array[$i][0]==$word)
		{	// le mot est dans le tableau
			$array[$i][1] = $array[$i][1]+1;
			break;
		}
	}
	if($i==sizeof($array))
	{	// le mot n'est pas dans le tableau
		$array[$i][0] = $word;
		$array[$i][1] = 1;
	}
	return $array;
}

// $input : tableau de sortie de Treetagger avec t[i]= le mot, t[i+1]= son type et t[i+2] = son lemme
// $lang : la langue utilisee pour l'analyse du texte
// $renvoie le vecteur de mot du texte
function getVector($input, $lang)
{
	$vector = array();
	for($i=0; $i+2<sizeof($input); $i=$i+3)
	{	 
		$type = $input[$i+1];
		if($type!='DET:ART' && $type!='DET:POS' && $type!='INT' && $type!='KON' && $type!='PRO' && $type!='PRO:DEM' 
		&& $type!='PRO:IND' && $type!='PRO:PER' && $type!='PRO:POS' && $type!='PRO:REL' && $type!='PRP' && $type!='PRP:det' 
		&& $type!='PUN' && $type!='PUN:cit' && $type!='SENT' && $type!="''" && $type!=',' && $type!=':' && $type!='``' && $type!=';'
		&& $type!='DT' && $type!='CC' && $type!='IN' && $type!='EX' && $type!='UH' && $type!='LH' && $type!='RP' && $type!='RB' 
		&& $type!='PP' && $type!='PP$' && $type!='POS' && $type!='WP' && $type!='WP$' && $type!='PDT' && $type!='TO' && $type!='WDT' 
		&& $type!='WRB' && $type!='SENT' && $type!="''" && $type!=',' && $type!=':' && $type!='``' && $type!=';')
		{// si le mot n'est pas un mot-outils
			if($type=='CD' && $input[$i+2]=='<unknown>') {
				if($input[$i] != '<unknown>') $vector=addWord($input[$i], $vector);
			} else
				if($input[$i+2] != '<unknown>') $vector=addWord($input[$i+2], $vector);
		}
	}
	
	return $vector;
} 

// renvoie le nombre d'occurences d'un nombre dans un vecteur
function countWord($word, $vector)
{
	$n=0;
	for($i=0 ; $i<sizeof($vector); $i++)
	{
		if($vector[$i][0]==$word)
		{	
			$n = $n + $vector[$i][1];
		}
	}
	
	return $n;
}
	


function compareWords($word1, $word2) {
	if($word1[1] > $word2[1]) return -1;
	else if($word1[1] === $word2[1]) return 0;
	else return 1;
}

// fin des fonctions
////////////////////////////////////////////////////////////////////

?>
