#!/bin/sh

if [ "$#" -ne 1 ]; then
	echo "Usage : sh $0 <db_name>"
	exit 1
fi

id_type=0;
i=0;
echo "insert into types values ($id_type, 'jpg');" | sqlite3 ${PWD}/$1
while read line
do
	mkdir -p ${PWD}/Images
	wget -P ${PWD}/Images $line
	file_name= echo $line | cut -d '/' -f10;
	echo "insert into files (type, path, url) values ($id_type, '${PWD}/Images/$file_name','test image');" | sqlite3 ${PWD}/$1
	echo "insert into images (file) values ($i);" | sqlite3 test.db
	i=$i+1;
done < $(dirname $0)/urls
