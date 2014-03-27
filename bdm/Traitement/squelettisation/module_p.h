#ifndef _module_p_
#define _module_p_

#include "stdio.h"
#include "stdlib.h"
#include "string.h"


#define LONGENTETE 56  /* Longueur de l'entete PPM */
#define ENTETE_PPM "P6\n# CREATOR: XV Version 3.00 Rev: 3/30/93\n"
#define ENTETE_PPM2 "255\n"

char strprogppm[4];
char strcreatorppm[80];
char strligcolppm[12];
char strnbcoulppm[4];

/* ************ Prototypes de fonctions */

unsigned char lut(unsigned char r, unsigned char v, unsigned char b);
void  lire_entete_ppm(  FILE *f_in,  int *lig,  int *col);
void  ecrire_entete_ppm(FILE *f_out,  int lig,  int col);

#endif
