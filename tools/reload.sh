#!/bin/sh

# Ce script remplace les fichiers du serveur web local par les fichiers du dépot et relance les services du serveur web.

#On se place à la racine du dépôt.
if [ "`git rev-parse --show-cdup`" != "" ]; then cd `git rev-parse --show-cdup`; fi
tools/reload_files.sh
tools/reload_web_server.sh
