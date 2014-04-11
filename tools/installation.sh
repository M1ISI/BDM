#!/bin/sh

#Ce script installe les paquets nécessaires au déploiement d'un serveur web Nginx + SQLite3 + PHP.

distrib=`lsb_release -i | cut -f2`
version=`lsb_release -r | cut -f2`
architecture=`uname -a | cut -d' ' -f12`
tools_path=`pwd`

echo 'Installation des paquets.'
if [ "$distrib" = 'Debian' ] 
then 
	echo 'deb http://packages.dotdeb.org stable all' >> /etc/apt/sources.list.d/php-fpm.list
	echo 'deb-src http://packages.dotdeb.org stable all' >> /etc/apt/sources.list.d/php-fpm.list
	sudo apt-get update
	sudo apt-get install curl
	sudo curl http://www.dotdeb.org/dotdeb.gpg | sudo apt-key add -
elif [ "$distrib" = 'Ubuntu' ] && [ `echo "$version <= 10.04" | bc` -eq 1 ]
then
	sudo add-apt-repository ppa:nginx/stable
	sudo add-apt-repository ppa:l-mierzwa/lucid-php5
fi
sudo apt-get update
sudo apt-get install nginx php5-fpm php5-sqlite php5-curl

if [ "$distrib" = 'Ubuntu' ] && [ `echo "$version <= 10.04" | bc` -eq 1 ]
then
	echo 'Recuperation des sources et installation de fcgiwrap.'
	sh "$tools_path"/install_fcgiwrap.sh
	sudo cp "$tools_path"/fcgiwrap /etc/init.d/fcgiwrap
	sudo chmod a+x /etc/init.d/fcgiwrap
else
	echo 'Installation de fcgiwrap.'
	sudo apt-get install fcgiwrap
fi

echo 'Configuration de nginx.'
sudo mv /etc/nginx/sites-available/default /etc/nginx/sites-available/default_backup
sudo cp "$tools_path"/default /etc/nginx/sites-available/

echo 'Force la redirection fpm par socket.'
sudo sed -i 's/^listen = [^\n]*$/listen = \/var\/run\/php5-fpm.sock/' /etc/php5/fpm/pool.d/www.conf


echo 'Copie des fichiers du site et redémarrage des services.'
sh "$tools_path"/reload.sh

echo 'Pour verifier l''installation, aller sur la page http://localhost'


