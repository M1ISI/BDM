# Extraction des tags ID3

## Présentation

Le programme "mp3tag" permet d'extraire les tags ID3 d'un morceau de musique. Les tags ID3 sont les éléments fournis dans le fichier mp3 (artiste, album, année, genre, etc.).


### Entrée

Le programme prend en entrée un chemin de répertoire.
Il va parcourir toute l'arborescence récursivement, et retourner sur la sortie les informations sur les morceaux trouvés.


### Sortie

Pour le moment le programme affiche sur la sortie standard les informations des morceaux. Il sera aisément possible de modifier le programme afin d'écrire un fichier structuré pour une importation simple dans la base de données.


## Compilation
Utiliser le Makefile fourni :
	$# make

Pour nettoyer le répertoire : 
	$# make clean

## Execution
$# ./mp3tag <répertoire>
