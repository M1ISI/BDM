/*
* Permet de convertir un fichier PPM seuillé à l'aide de la 
* squelettisation en liste de points.
* Le format de fichier généré, utilisé par hausdorff_distance,
* est une succession de coordonnées x et y séparées par des espaces
* ou des retours à la ligne.
*/

#include <stdio.h>
#include <stdlib.h>
#include <errno.h>
#include <cstring>
#include <iostream>
#include <fstream>
#include <opencv/cv.h>
#include <opencv/highgui.h>

int main (int argc, char* argv[])
{
  IplImage* img = NULL; 
  const char* src_path = NULL;

  /* Mauvais entrées de commande */
  if (argc < 2)
  {
    fprintf (stderr, "usage: input_name.ppm output_name.txt\n");
    return EXIT_FAILURE;
  }
  
  src_path = argv[0];

  /* Ouverture de l'image */
  if (!(img = cvLoadImage (src_path, CV_LOAD_IMAGE_GRAYSCALE)))
  {
      fprintf (stderr, "couldn't open image file: %s\n", argv[0]);
      return EXIT_FAILURE;
  }

  /* Ouverture du fichier de sortie */
  FILE* ptlist = fopen(argv[1], "w");
  if(ptlist == NULL)
  {
      perror("Unable to open output file");
      return EXIT_FAILURE;
  }

  /* Analyse du fichier PPM */
  int x,y;
  uchar *p;
  assert (img->depth == IPL_DEPTH_8U && img->nChannels == 1);

  for (y = 0; y < img->height; ++y)
  {
    for (x = 0; x < img->width; ++x)
    {
      // récupération d'un pointeur sur le pixel de coordonnées (x,y)
      p = cvPtr2D (img, y, x, NULL);
      
      if(*p == 255)
	fprintf(ptlist, "%d %d\n", x, y);		
    }
  }
  
  cvReleaseImage(&img);
  fclose(ptlist);
  return EXIT_SUCCESS;
}