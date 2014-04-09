sudo apt-get install git-core build-essential libfcgi-dev autoconf libtool automake
cd /tmp
sudo git clone git://github.com/gnosek/fcgiwrap.git
cd /tmp/fcgiwrap
sudo autoreconf -i
sudo ./configure
sudo make
sudo mv fcgiwrap /usr/local/bin/
cd /
sudo rm -rf /ymp/fcgiwrap
