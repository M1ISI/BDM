distrib=`lsb_release -i | cut -f2`
version=`lsb_release -r | cut -f2`

echo "Installation des paquets."
if [ "$distrib" = "Debian" ] 
then 
	echo "deb http://packages.dotdeb.org stable all" >> /etc/apt/sources.list.d/php-fpm.list
	echo "deb-src http://packages.dotdeb.org stable all" >> /etc/apt/sources.list.d/php-fpm.list
	curl http://www.dotdeb.org/dotdeb.gpg | apt-key add -
elif [ "$distrib" = "Ubuntu" ] && [ "$version" -leq 10.04 ]
then
	add-apt-repository ppa:nginx/stable
	sudo add-apt-repository ppa:l-mierzwa/lucid-php5
fi
apt-get update
apt-get install nginx php5-fpm fcgiwrap php5-sqlite 

echo "Copie des fichiers du site."
./reload.sh


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


