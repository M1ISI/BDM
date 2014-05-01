#!/bin/sh

#Ce script modifie la configuration de PHP pour afficher les erreurs.

sudo sed -i 's/^error_reporting = [^\n]*$/error_reporting = E_ALL/' /etc/php5/fpm/php.ini
sudo sed -i 's/^display_errors = [^\n]*$/error_reporting = On/' /etc/php5/fpm/php.ini

