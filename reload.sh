# Ce script remplace les fichiers du serveur web local par les fichiers du depot.

sudo cp -rf ./bdm/ /var/www/
chown -R www-data:www-data /var/www
