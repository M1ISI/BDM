# Recherche audio

Nous avons choisis deux approches : 
	- l'extraction de "mots" depuis un morceau
	- la comparaison entre deux musiques

## Extraction de mots depuis une musique

Cette partie permet d'indexer une musique dans la base de données. Nous fournissons une musique, les informations sont extraites afin d'être automatiquement ajoutées à la base de données.


### Premiere approche
	
Dans un premier temps, nous voulions extraire les tags [ID3](http://fr.wikipedia.org/wiki/ID3) des mp3. Ceci permet d'extraire un artiste, album, année de sortie, genre, etc.
Pour cela un algorithme a été écrit.


### Seconde approche
	
Nous avons ensuite voulu déterminer le genre musical d'une musique sans nous baser sur les tags ID3, dans le cas où ceux-ci ne sont pas renseignés.
Nos recherches dans ce domaine nous ont conduits au calcul des MFCC (Mel-frequency cepstral coefficients), qui sont utilisés dans la comparaison vocale et musicale.
Malheureusement, après un approfondissement des recherches, nous avons découvert que la détection du genre musical utilisait en effet les MFCC, mais de très nombreuses autres méthodes et algorithmes.
Nous avons pensé qu'il serait très compliqué dans le temps imparti d'implémenter une telle méthode. Il faut se pencher sur d'autres méthodes pour extraire des informations.


## Comparaison entre deux morceaux

Cette partie est consacrée à la comparaison de deux morceaux entre eux. Cela sera utile lorsque l'on voudra diffuser un morceau ou une partie d'un morceau, et de retrouver des équivalents en base de données.
Pour l'instant les éléments de comparaison n'ont pas encore été étudiés. Les premières idées sont de comparer le spectre du morceau, ou d'appliquer une transformation de Fourier et de les comparer, etc. Mais aucune recherche n'a été menée.


## Ressources
### Bibliothèque

La bibliothèque utilisée est "essentia" qui est une bibliothèque permettant énormément d'opérations sur les sons (filtres, statistiques, traitement du signal, etc.)
Elle est très complète, bien documentée et dispose déjà de beaucoup de fonctions implémentées et prêtes à l'emploi.

Un script d'installation est disponible dans le dossier "spectre/".
