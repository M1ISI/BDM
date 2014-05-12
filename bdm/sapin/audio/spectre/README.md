# Installation bilbiothèque "Essentia"

Le script **install_essentia.sh** permet d'installer toute les dépendances, de télécharger la bibliothèque et de l'installer.

Il suffit juste d'ajouter les droits au fichier et de l'éxecuter :

$# chmod +x install_essentia.sh
$# ./install_essentia.sh

## Compilation d'un fichier

Pour compiler un fichier, il faut mettre le fichier dans un des dossiers dans "/src" (par exemple : "Examples").
L'exécution de la commande "./waf", le compilera et le placera dans le dossier "<racine>/build/src/<dossier contenant le fichier>.

## Documentation

La documentation ou les exemples montrent comment implémenter ses propres algorithmes, filtres, etc.

Pour plus d'information sur la compilation, vous pouvez vous reporter à cette page : http://essentia.upf.edu/documentation/installing.html#compiling-essentia

Pour la documentation complète : http://essentia.upf.edu/documentation/

# Extraction des MFCC

Le script **extraction_mfcc_to_csv** permet d'extraire du fichier g?n?r? par le code **standard_mfcc** les 12 coeffs moyen et les places dans un fichier CSV.

## Entr?e

Il prend en argument tous les fichiers dans lesquels on veut extraire les informations.

Exemple : 
$# ./extraction_mfcc_to_csv fichier 1 fichier 2 ...

## Sortie

Le programme enregistre ces ?l?ments dans un fichier **extract.csv**, ligne par ligne.
