#!/bin/bash

if [ $# -gt 1 ] ; then
    echo "USAGE : $0 [address|domain_name]"
    exit 1
fi

if [ $# -eq 0 ] ; then
    addr='fritmayo.zor-en.com'
else
    addr=$1
fi

ssh M1ISI@$addr '
serverPath="/opt/lampp/htdocs/BDM/"
echo 'Connexion established to $addr'

echo "moving to $serverPath"
cd $serverPath

echo "Getting data from https://github.com/M1ISI/BDM.git"
git pull https://github.com/M1ISI/BDM.git

if [ $? -eq 0 ] ; then
    echo "...done"
else
    echo "...error"
    exit $?
fi'

exit 0
