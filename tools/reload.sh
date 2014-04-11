#!/bin/sh

# Ce script remplace les fichiers du serveur web local par les fichiers du dépot et relance les services du serveur web.

tools_path=`pwd`

"$tools_path"/reload_files.sh
"$tools_path"/reload_web_server.sh
