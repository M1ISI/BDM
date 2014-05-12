#ISI Search

##Avant-propos

Ce dépôt recueille l'ensemble des fichiers sources utilisés dans le projet nommé **ISI Search**.
Ce projet est réalisé dans le cadre de la matière BDM (Banque de données multimédia) de la première année du [Master Informatique spécialité ISI](https://master-informatique.unistra.fr/#isi) (Informatique et Sciences de l'Image) de l'[Université de Strasbourg](https://www.unistra.fr/).
Précisons aussi que l'ensemble de la classe de la promo 2013/2014 participe au développement.

##Buts du projet

Le projet a tout d'abord deux buts pédagogiques:
- pratiquer le développement en équipe
- utiliser et développer des solutions d'analyse multimédia

Et sa réalisation consiste en un moteur de recherche en ligne permettant aussi bien une recherche classique par mots clefs que par analyse d'image, de son ou de vidéo.

##Organisation

###Infrastructure
De par sa nature, le projet se doit d'être disponible en ligne et est orienté développement web. Il requiert donc un serveur web mais les différentes
analyses multimédia ne s'y limitent pas. En effet, certaines sont réalisées en Python, en Perl ou en C par exemple. L'utilisation de tous les outils
demande alors des compilateurs ou interpréteurs dans les langages correspondants.

####Serveur web
Nous avons mis en place un [serveur de production](http://fritmayo.zor-en.com/BDM/bdm/) accessible depuis le web.
Pour les phases de développement nous utilisons des serveurs web déployés localement.

Ce que le serveur web nécessite:
- [PHP](http://www.php.net/)
- SQLite

###Le dépôt
A la racine se trouvent deux dossiers:
- [tools](tools): regroupe les outils (comprendre scripts) pour l'installation initiale d'un serveur web local pour le développement, la mise-à-jour du serveur local et de production.
- [bdm](bdm): contient les pages web et les programmes d'analyse multimédia

##Licence
La licence retenue pour le projet est la licence MIT.
Pour plus d'informations, se reporter à [LICENSE.md].
