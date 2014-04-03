#!/bin/bash
# Installation de la bibliothèque "essentia"
# Dépendances
sudo apt-get install build-essential libyaml-dev libfftw3-dev libavcodec-dev libavformat-dev python-dev libsamplerate0-dev libtag1-dev python-numpy-dev python-numpy python-pip

# Dépendances python
pip install sphinx pyparsing==1.5.7 sphinxcontrib-doxylink docutils
pip install pyyaml

# clone du dépot
git clone https://github.com/MTG/essentia.git
cd essentia/

# Configuration de la bibliothèque
./waf configure --mode=release --with-python --with-cpptests --with-examples --with-vamp

# Compilation
./waf

# Installation bibli. c++ / python
sudo ./waf install

# Génération de la doc
./waf doc
