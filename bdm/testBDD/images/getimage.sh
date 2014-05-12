#! /bin/bash
#This script get a random image from deviant art website and save it to hard disk!
#
# by wlourf http://u-scripts.blogspot.com/
# v1.0 - 31 Jan. 2010
#
#argument 1 (optional) is the path+filename where to save the image
#if argument 1 is not present, image will be saved in $folder
#
#other paramaters are set here
file1=/tmp/get_random.txt
file2=/tmp/get_image.txt
folder=~/deviant

############################# end ###########################

#get a random url
GET http://www.deviantart.com/random/deviation > $file1

#extract the link to the deviation page
match="<input type="\" name="\" value="\" begin="http" end="\">"

a=$(($(expr "$url_line" : ".*$begin")-${#begin}))
b=$(($(expr "$url_line" : ".*$end")-$a-${#end}))

url_page=${url_line:$a:$b}

#echo "deviation--> "$url_page

#get the deviation page
GET $url_page > $file2

#extract the link to the fullview image
match="fullview"
url_line=""

while read line
do
  if [[ "$line" =~ "${match}" ]]; then
    url_line=$line
    break
  fi
done < $file2

begin="src\":\""
end="\"},\"smallview"

b=$(($(expr "$url_line" : ".*$end")-${#end}))
url2=${url_line:0:$b}

a=$(($(expr "$url2" : ".*$begin")))
url_img=${url2:$a}

#save image to hard disk if url ok
if [[ $url_img != "" ]]; then
  cd $folder
  if [[ $1 != "" ]]; then
    wget $url_img -O $1
  else
    wget $url_img
  fi
fi 
