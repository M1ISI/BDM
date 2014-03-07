echo "Installation des paquets."
sudo apt-get install nginx php5-fpm fcgiwrap php5-sqlite 

echo "Copie des fichiers du site."
sudo cp -r ./bdm /var/www/
sudo chown -R www-data:www-data /var/www/bdm


echo "Configuration de nginx."
sudo mv /etc/nginx/sites-available/default /etc/nginx/sites-available/default_backup
sudo cp ./default /etc/nginx/sites-available/


echo "Redémarrage des services."
sudo service nginx restart
sudo service php5-fpm restart
sudo service fcgiwrap restart



