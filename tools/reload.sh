# Ce script remplace les fichiers du serveur web local par les fichiers du depot.

sudo mkdir /var/www
sudo cp -rf ../bdm/ /var/www/
sudo chown -R www-data:www-data /var/www