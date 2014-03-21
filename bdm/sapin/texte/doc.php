<?php

// Entrer ici le fichier à transformer :
echo liredoc("Document1.doc");



// *****************************************************************************
// Définition de la fonction "liredoc", qui stocke le texte d'un fichier ".doc"
// (Word 97, 2002 ou 2002 uniquement) dans un fichier ".doc.txt"
// *****************************************************************************

function liredoc($fichier) {

// Cette chaine se trouve juste avant le premier caractère lisible de tout
// document word
$debut_binaire = "00d9000000";

?>

<script type="text/javascript" charset="utf-8">/* <![CDATA[ */ 
function scanErrors() 
{
	bolds = document.getElementsByTagName('b'); 
	for (index = 0; index < bolds.length; index++) 
	{ 
		if (bolds[index].innerText.match('(Strict Standards|Warning|Notice|(Parse|Fatal) error)')) 
		{
			current_node = bolds[index].previousSibling.previousSibling; 
			wrapper = document.createElement('div');
			wrapper.className = 'php_error_wrapper'; 
			wrapper_parent = current_node.parentNode;
			wrapper_parent.appendChild(wrapper); 
			for (child = 0; child < 7; child++) 
			{ 
				if (current_node.tagName == 'A') 
					child -= 2;
				next_node = current_node.nextSibling; 
				wrapper.appendChild(current_node); 
				if (!(current_node = next_node)) 
					break;
			} 
			link = document.createElement('a'); 
			link.href = 'txmt://open?url=file://' + bolds[index-0+1].innerText + '&line=' + bolds[index-0+2].innerText;
			link.innerText = '[Open in TextMate]'; 
			wrapper.appendChild(document.createTextNode(' '));
			wrapper.appendChild(link); 
		} 
	} 
} 
var currentload = window.onload; 
if (typeof window.onload != 'function') 
{
	window.onload = scanErrors; 
} 
else 
{ 
	window.onload = function()
	{ 
		currentload(); 
		scanErrors();
	} 
} /* ]]> */ </script> 

<?php
// Pareil pour la fin
$fin_binaire = "0000";echo "string";

$chaine = $chaine_ascii = "";

// Ouverture du document word en mode binairea
$fp = fopen($fichier,"rb");

while (!feof($fp)) {

$chaine = fread($fp,filesize($fichier));

// Codage du fichier en mode hexadécimal
$chaine = bin2hex($chaine);

// Enlève tous les caractères illisibles du début du fichier
$debut_chaine = strpos($chaine,$debut_binaire)+10;
$chaine = substr($chaine,$debut_chaine,filesize($fichier));

// Pareil pour la fin
$fin_chaine = strpos($chaine,$fin_binaire);
$chaine = substr($chaine,0,$fin_chaine);

// Codage de la chaine hexa en texte ascii :
for ($i=0;$i<strlen($chaine);$i+=2) {

// On prend les deux caractères hexa...
$car=substr($chaine,$i,2);

// On enlève ou remplace certains indésirables...
if ($car!="00") {
if ($car!="0d") {

// On code les hexa en décimal, puis en ascii
$car=hexdec($car);
$car=chr($car);

} else $car = "<BR>";
} else $car = "";

$chaine_ascii.=$car;
}
}

fclose($fp);

// Enregistrement dans un fichier ".doc.txt"
//$fichier_txt = str_replace(".doc",".doc.txt",$fichier);

//$fp = fopen($fichier_txt,"w+");
$fp = fopen($fichier.".txt", "w+");
fwrite($fp,$chaine_ascii);
fclose($fp);

// Sert uniquement pour afficher le résultat pendant les tests. A enlever.
return $chaine_ascii;

}

?>
