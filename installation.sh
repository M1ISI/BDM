distrib=`lsb_release -i | cut -f2`
version=`lsb_release -r | cut -f2`

echo "Installation des paquets."
if [ "$distrib" = "Debian" ] 
then 
	echo "deb http://packages.dotdeb.org stable all" >> /etc/apt/sources.list.d/php-fpm.list
	echo "deb-src http://packages.dotdeb.org stable all" >> /etc/apt/sources.list.d/php-fpm.list
	curl http://www.dotdeb.org/dotdeb.gpg | apt-key add -
fi
apt-get update
apt-get install nginx php5-fpm fcgiwrap php5-sqlite 

echo "Copie des fichiers du site."
sudo cp -r ./bdm/ /var/www/
chown -R www-data:www-data /var/www


echo "Configuration de nginx."
mv /etc/nginx/sites-available/default /etc/nginx/sites-available/default_backup
if [ "$distrib" = "Debian" ] 
then 
	cp ./debian /etc/nginx/sites-available/default
else 
	cp ./default /etc/nginx/sites-available/
fi



echo "Redémarrage des services."
service nginx restart
service php5-fpm restart
service fcgiwrap restart


echo "Pour verifier l'installation, aller sur la page http://localhost"


