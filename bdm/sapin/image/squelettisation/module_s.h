#ifndef _module_s_
#define _module_s_

#include "stdlib.h"
#include "stdio.h"

int MAXLIGNE;  /* dimension de l'image initiale */
int MAXCOLON;
unsigned char *buf_image;
unsigned char *buf_squelette;

int barre(int i, int l, int nlig, int ncol );
int masque_squelette(int i,  int l, int nlig, int ncol);
int nettoie_squelette(int i,  int l, int nlig, int ncol);
int lisse_squelette(int i,  int l, int nlig, int ncol);
int squelettise(int nbiterations, int nlig, int ncol);
int nettoyage(int nbiterations, int nlig, int ncol);
int lissage(int nbiterations, int nlig, int ncol);

#endif
