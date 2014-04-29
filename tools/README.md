#Contenu

Ce dossier regroupe les différents outils écrits pour simplifier certaines tâches répétitives.

##Installation du serveur web local

Pour faire nos tests lors du développement nous avons utilisés des serveurs web locaux.
Afin d'installer rapidement le serveur web il suffit de lancer le script **installation.sh** 
qui va télécharger les paquets nécessaires, les installer et faire une copie du site dans le dossier **/var/www/bdm**.

Lors de l'installation sont aussi utilisés les fichiers suivants:
- **default** : la configuration Nginx du site
- **fcgiwrap** : script Perl de lancement du démon fcgiwrap au démarrage
- **install_fcgiwrap.sh** : installation de l'exécutable fcgiwrap à partir des sources
- **reload.sh** : mise-à-jour des fichiers du site et relancement des services du serveur web
- **reload_files.sh** : mise-à-jour des fichiers du site uniquement
- **reload_web_server.sh** : relancement des services du serveur web uniquement
- **get_images.sh** : script de récupération des images depuis un compte deviantart pour remplir la bdd
- **urls** : contient les liens des images à télécharger

##Actualisation du serveur de développement

Si vous utilisez le serveur web installé grâce au script fournis, vous pouvez utiliser **reload_files.sh** pour mettre à jour 
les fichiers locaux à partir de votre copie du dépôt.
Pour relancer le serveur web, utilisez **reload_web_server.sh** et si vous souhaitez faire les deux, **reload.sh**.

##Actualisation du serveur de production

Le script **pullServer.sh** se charge de se connecter au serveur de production, de mettre à jour les sources à partir du dépôt et d'appliquer la nouvelle
version des pages web.
Lors de l'exécution de ce script il est nécessaire de fournir le mot de passe qui nous a été donné dans [ce document](https://docs.google.com/document/d/1-3f4tgoaKOKJUVuxDcclCLc8aZoEouL-O-YRqWo_pI4/).
Ce mot de passe n'est évidemment pas donné clairement dans ce readme par soucis de confidentialité.
