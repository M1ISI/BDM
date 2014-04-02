distrib=`lsb_release -i | cut -f2`
version=`lsb_release -r | cut -f2`
architecture=`uname -a | cut -d' ' -f12`

echo 'Installation des paquets.'
if [ "$distrib" = 'Debian' ] 
then 
	echo "deb http://packages.dotdeb.org stable all" >> /etc/apt/sources.list.d/php-fpm.list
	echo "deb-src http://packages.dotdeb.org stable all" >> /etc/apt/sources.list.d/php-fpm.list
	sudo apt-get update
	sudo apt-get install curl
	sudo curl http://www.dotdeb.org/dotdeb.gpg | sudo apt-key add -
elif [ "$distrib" = 'Ubuntu' ] && [ `echo "$version <= 10.04" | bc` -eq 1 ]
then
	sudo add-apt-repository ppa:nginx/stable
	sudo add-apt-repository ppa:l-mierzwa/lucid-php5
fi
sudo apt-get update
sudo apt-get install nginx php5-fpm fcgiwrap php5-sqlite php5-curl 

echo "Copie des fichiers du site."
./reload.sh


echo "Configuration de nginx."
sudo mv /etc/nginx/sites-available/default /etc/nginx/sites-available/default_backup
if [ "$distrib" = "Debian" ] 
then 
	sudo cp ./debian /etc/nginx/sites-available/default
else 
	sudo cp ./default /etc/nginx/sites-available/
fi



echo "Redémarrage des services."
sudo service nginx restart
sudo service php5-fpm restart
sudo service fcgiwrap restart


echo "Pour verifier l'installation, aller sur la page http://localhost"


