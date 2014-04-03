/****************************************************************************************************************/
/*	Ouverture et seuillage d'une image																			*/
/*																												*/
/* code repris de :																								*/
/* http://fr.openclassrooms.com/informatique/cours/introduction-a-la-vision-par-ordinateur/parcourir-une-image	*/
/* et legerement modifie																						*/
/*																												*/
/*																												*/
/* utilise la bibliotheque opencv																				*/
/*																												*/
/* pour l'installer sur linux :																					*/
/* sudo apt-get install libcv-dev libcvaux-dev libhighgui-dev													*/
/*																												*/
/* pour compiler :																								*/
/* g++ -c threshold.cpp -Wall `pkg-config opencv --cflags`														*/
/* g++ threshold.o -o threshold `pkg-config opencv --libs`														*/
/*																												*/
/****************************************************************************************************************/


//#include <stdio.h>
//#include <stdlib.h>
//#include <assert.h>
#include <cstring>
#include <iostream>
#include <fstream>
#include <opencv/cv.h>
#include <opencv/highgui.h>

/**
 * fait un seuillage sur l'image
 */
void threshold (IplImage* img)
{
  int x,y;
  uchar *p;
  assert (img->depth == IPL_DEPTH_8U && img->nChannels == 1);

  for (y = 0; y < img->height; ++y)
  {
    for (x = 0; x < img->width; ++x)
    {
      // récupération d'un pointeur sur le pixel de coordonnées (x,y)
      p = cvPtr2D (img, y, x, NULL);
      
      if(*p<128)
		*p = 0;
	  else
		*p = 255;
    }
  }
}

void savePGM(const std::string& file, IplImage* img)
{
	std::ofstream sortie(file.c_str(),std::ios::out);
    if(!sortie)
    {
        std::cerr << "Erreur d'ouverture" << std::endl;
        exit(0);
    }
    sortie << "P6" << std::endl;
    sortie << img->width << " " << img->height << std::endl;//Ecriture largeur hauteur
    sortie << 255 << std::endl;//Calcul max de l'image
    for(int y=0;y<img->height;y++)
    {
        for(int x=0;x<img->width;x++)
        {
			
  			uchar *p;
			unsigned char value;
			p = cvPtr2D (img, y, x, NULL); // récupération d'un pointeur sur le pixel de coordonnées (x,y)
			if(*p<128)
				value = 0;
			else
				value = 255;
            sortie << value <<  value <<  value ;//Ecriture de tous les pixels
        }
      //  sortie << std::endl;
    }

    sortie.close();
	
}


/**
 * Ce programme prend deux arguments dont un optionnel:
 * IMAGE:     l'image à inverser
 * SAVE_PATH: (optionnel) l'image dans laquelle sauvegarder le résultat
 */
int main (int argc, char* argv[])
{
  IplImage* img = NULL; 
  const char* src_path = NULL;

  if (argc < 2)
  {
    fprintf (stderr, "usage: %s IMAGE [SAVE_PATH]\n", argv[0]);
    return EXIT_FAILURE;
  }

  src_path = argv[1];


  if (!(img = cvLoadImage (src_path, CV_LOAD_IMAGE_GRAYSCALE)))
  {
    fprintf (stderr, "couldn't open image file: %s\n", argv[1]);
    return EXIT_FAILURE;
  }

  threshold (img);
  savePGM("tmp.ppm", img);
  
  cvReleaseImage(&img);
  return EXIT_SUCCESS;
}


