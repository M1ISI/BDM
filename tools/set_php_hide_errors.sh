#!/bin/sh

#Ce script modifie la configuration de PHP pour ne plus afficher les erreurs.
php_conf='/etc/php5/fpm/php.ini'

sudo sed -i 's/^error_reporting = [^\n]*$/error_reporting = E_ALL \& ~E_DEPRECATED \& ~E_STRICT/' $php_conf
sudo sed -i 's/^display_errors = [^\n]*$/display_errors = Off/' $php_conf
sudo sed -i 's/^display_startup_errors = [^\n]*$/display_startup_errors = Off/' $php_conf

#On se place à la racine du dépôt pour relancer le serveur web.
if [ "`git rev-parse --show-cdup`" != "" ]; then cd `git rev-parse --show-cdup`; fi
sh tools/reload_web_server.sh
