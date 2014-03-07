echo 'Installation des paquets.'
sudo apt-get install nginx php5-fpm fcgiwrap php5-sqlite 

echo "Copie des fichiers du site et configuration de nginx".
sudo cp -r ./bdm /var/www/
sudo mv /etc/nginx/sites-available/default /etc/nginx/sites-available/default_backup
sudo cp ./default /etc/nginx/sites-available/


