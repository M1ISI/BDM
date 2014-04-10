#! /usr/bin/env python
#-*- coding:Utf-8 -*-

import sys, os
import cv2, imghdr, Image

"""
Version de python : 2.7.3

Packages à installer
apt-get install python-opencv
apt-get install python-numpy
"""

# Classe qui manipule les images à analyser
class ImgHandler :

    # constructeur
    def __init__(self, _img) :
        self.image = None
        self.imagePath = _img
        self.imageType = imghdr.what(self.imagePath)    #/!\ peut renvoyer None
        self.containFace = False
        self.nbFaces = 0
        self.faces = ['']
        self.mode = 0

    # test de type
    def testImage(self) :
        if self.imageType not in ["jpeg", "png", "bmp"] :
            return 200
        return 0

    # détection de visages avec openCV
    def detect_faces(self) :
        # on charge l'image en mémoire
        self.image = cv2.imread(self.imagePath)

        # on travaille sur une image en niveau de gris pour améliorer le résultat
        imageModifier = cv2.cvtColor(self.image, cv2.COLOR_BGR2GRAY)

        # on charge les modèles de détection des visages
        face_model_alt = cv2.CascadeClassifier("haarcascades/haarcascade_frontalface_alt.xml")
        face_model_alt2 = cv2.CascadeClassifier("haarcascades/haarcascade_frontalface_alt2.xml")
        face_model_default = cv2.CascadeClassifier("haarcascades/haarcascade_frontalface_default.xml")
        face_model_profileface = cv2.CascadeClassifier("haarcascades/haarcascade_profileface.xml")

        # détection avec trois fichiers différents pour augmenter l'efficacité
        face_alt = face_model_alt.detectMultiScale(imageModifier)
        face_alt2 = face_model_alt2.detectMultiScale(imageModifier)
        face_default = face_model_default.detectMultiScale(imageModifier)
        face_profile = face_model_profileface.detectMultiScale(imageModifier)

        # test des résultats
        stat_count = 0
        if len(face_alt) != 0 : 
            stat_count += 1 
        if len(face_alt2) != 0 : 
            stat_count += 1 
        if len(face_default) != 0 : 
            stat_count += 1
        if len(face_profile) != 0 : 
            stat_count += 1 
        #print stat_count

        # si deux des trois analyses (minimum) détectent un ou plusieurs visage(s), on considère qu'il y a au moins un visage dans l'image
        if stat_count >= 2 :
            self.containFace = True

            # si le premier test renvoie une valeur non nulle, on se base sur celle-ci, sinon récupère les données de la seconde détection. Profileface n'est pas pris en compte pour le moment
            if len(face_alt) != 0 :
                self.faces = face_alt
            else :
				self.faces = face_alt2

            self.nbFaces = len(self.faces)

        return len(self.faces)

    # affichage des caractéristiques de l'objet
    def printObj(self) :
        print "image :", self.imagePath
        print "type de l'image :", self.imageType

        if self.containFace == 0 :
            print "Aucun visage dans l'image\n"
        else :
            print "Il y a", self.nbFaces, "visages dans l'image\n"

    # dessine un rectangle englobant les visages
    def drawTagetRectangle(self) :
        if not self.containFace :
            return
        for face in self.faces :
			# 0 : x
			# 1 : y
			# 2 : width
			# 3 : height
		    cv2.rectangle(self.image, (face[0],face[1]), (face[0] + face[2],face[1] + face[3]), (255, 0, 0), 3)

        # on sauvegarde le résultat final
        cv2.imwrite("s_" + self.imagePath, self.image)
	
	# exporte chaque visage dans un fichier à part
	# à combiner avec les scripts dans le dossier comparaison
    def exportTargetsToBmp(self):
		if not self.containFace :
			return
		i = 0
		for face in self.faces:
			# http://stackoverflow.com/questions/15589517/how-to-crop-an-image-in-opencv-using-python
			#img[y: y + h, x: x + w]
			img_crop = self.image[face[1]:face[1]+face[3], face[0]:face[0]+face[2]]
			
			# important : doit être sauvé en BMP pour pouvoir cannyfier
			cv2.imwrite("f"+str(i)+"_"+os.path.splitext(self.imagePath)[0]+".bmp", img_crop)
			i = i + 1

    # affiche l'image originale et l'image avec le cadre si des visages sont détectés : /!\ il ne faut pas que self.imgType = None
    def showImg(self) :
        os.system("eog " + self.imagePath + " 2> /dev/null")
        if self.containFace :
            os.system("eog " + "s_" + os.path.splitext(self.imagePath)[0] + "." + ('jpg' if self.imageType in 'jpeg' else self.imageType) + " 2> /dev/null")

# haarcascade xml
# test des arguments
def testArg() :
    # s'il n'y a pas d'arguments
    if len(sys.argv) <= 1 :
        return 100
    return 0

# main
if __name__ == "__main__" :
    t_arg = testArg()
    if t_arg != 0 :
        exit(t_arg)

    for _file in sys.argv[1:] :
        imgObj = ImgHandler(_file)

        if imgObj.testImage() != 0 :
            #continue   #<-- a mettre pour la release
            pass

        imgObj.detect_faces()
        imgObj.printObj()
        #imgObj.drawTagetRectangle()
        imgObj.exportTargetsToBmp()
        #imgObj.showImg()


