#!/bin/sh

id_type=0;
i=0;
echo "insert into types values ($id_type, 'jpg');" | sqlite3 test.db
while read line
do
	wget -P /home/fmarcel/Images/test/img $line;
	file_name= echo $line | cut -d '/' -f10;
	echo "insert into files (type, path, url) values ($id_type, '/home/fmarcel/Images/test/img/$file_name','test image');" | sqlite3 test.db
	echo "insert into images (file) values ($i);" | sqlite3 test.db
	i=$i+1;
done < urls
