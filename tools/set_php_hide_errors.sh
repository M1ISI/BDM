#!/bin/sh

#Ce script modifie la configuration de PHP pour ne plus afficher les erreurs.

sudo sed -i 's/^error_reporting = [^\n]*$/error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT/' /etc/php5/fpm/php.ini
sudo sed -i 's/^display_errors = [^\n]*$/error_reporting = Off/' /etc/php5/fpm/php.ini
