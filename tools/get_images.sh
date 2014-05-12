#!/bin/sh
#!/usr/bin/php

if [ "$#" -ne 2 ]; then
	echo "Usage : sh $0 <directory> <db_name>"
	exit 1
fi

id_type=0;
i=0;
echo "delete from images;" | sqlite3 $1/$2
echo "delete from files;" | sqlite3 $1/$2
echo "delete from types;" | sqlite3 $1/$2
echo "delete from colors;" | sqlite3 $1/$2
echo "delete from have_color;" | sqlite3 $1/$2

echo "insert into types values ($id_type, 'jpg');" | sqlite3 $1/$2
while read line
do
	mkdir -p $1/Images
	wget -P $1/Images $line
	echo $line
	file_name=$(echo $line | cut -d '/' -f10)
	echo $file_name
	#echo "insert into files (id_file, type, path, url) values ($i, $id_type, 'Images/${file_name}','$line');"
	#echo "insert into images (file) values ($i);"
	echo "insert into files (id_file, type, path, url) values ($i, $id_type, 'Images/${file_name}','$line');" | sqlite3 $1/$2
	echo "insert into images (file) values ($i);" | sqlite3 $1/$2
	i=$i+1;
done < $(dirname $0)/urls

echo "Telechargement termine"
echo "Debut de l'analyse des couleurs..."

php $(dirname $0)/example_color.php

echo "fin"
