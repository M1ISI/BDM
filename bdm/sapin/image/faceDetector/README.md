Ici se trouvent les fichiers pour la reconnaissance faciale :


findFace.py : 
programme qui prend une image en paramètre, détecte les éventuels visages sur celle-ci et les exporte (s'ils existent) en image .bmp sous le nom f<i>_<nom_de_l_image>.bmp où <i> est un entier supérieur ou égal à 0 permettant de numérotter les visages. Pour plus de clarté ces images sont enregirstrées dans le dossier tmp.
note : les visages de personnages de dessins-animés (comme la famille simpsons) ne sont pas détectés.

FaceDetector.py : 
programme qui prend en paramètres deux images et indique la zone la plus concordante entre les deux images. La première image est l'image dans laquelle on cherche un visage et la deuxième est l'image du visage.

makefile :
bien que le python ne se compile pas un fichier makefile est intégré pour plus de commodités : "make geany" permet d'ouvrir les fichiers python et le makefile dans geany, "make clean" permet de vider le dossier tmp.

le dossier harrcascade contient les fichiers .xml nécessaires à la détection de visages avec opencv.

le dossier image contient les images de tests.

le dossier tmp continent les images des visages détectés par findFace.py



Bibliothèques à installer :

pour findFace.py :
sudo apt-get install python-opencv
sudo apt-get install python-numpy

pour FaceDetector.py :
sudo apt-get install python-opencv
sudo apt-get install python-numpy
apt-get install pyhthon-matplotlib



Contributeurs à cette partie :

Cyril Laffely
David Braun
Mathias Leyendecker
Vickie Marchal

