echo "Installation des paquets."
apt-get install nginx php5-fpm fcgiwrap php5-sqlite 

echo "Copie des fichiers du site."
sudo cp -r ./bdm/ /var/www/
chown -R www-data:www-data /var/www


echo "Configuration de nginx."
mv /etc/nginx/sites-available/default /etc/nginx/sites-available/default_backup
cp ./default /etc/nginx/sites-available/


echo "Redémarrage des services."
service nginx restart
service php5-fpm restart
service fcgiwrap restart


echo "Pour verifier l'installation, aller sur la page http://localhost"


