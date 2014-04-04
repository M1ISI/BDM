# Ce script remplace les fichiers du serveur web local par les fichiers du depot et relance les services du serveur web.

sudo mkdir /var/www
sudo cp -rf ../bdm/ /var/www/
sudo chown -R www-data:www-data /var/www

sudo service nginx restart
sudo service php5-fpm restart
sudo service fcgiwrap restart
