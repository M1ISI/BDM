#include "module_s.h"

/* module_s.c */
/********************************************************************/
/*                    S Q U E L E T T E . C                         */
/*                    jean.fruitet@univ-mlv                         */
/*    Squelettisation  d'une image binaire                          */
/*  ALGORITHME avec  RECOPIE dans un buffer entre deux passes       */
/********************************************************************/

/*
   Modifications : 22/02/2005 Remplacement de printf(...) par printf(...) 
   Modifications : 26/O6/97    Bug masque 123 remplace par 113
   Modifications : 24/10/95 Memoire dynamique pour les tampons 
*/

/*
-----------------------------
ALGORITHME de Squelettisation
-----------------------------
Par passage de masques en verifiant de garder les lignes 
horizontales ou verticales de deux pixels entre deux balayage...
pour conserver la connexite 
*/


/* ************ Prototypes de fonctions *************** */

/* Header */

int voisinage[3][3] = {{2,4,8},{256,1,16},{128,64,32}};

/* ************* Sources ********** */
/* --------------------------------------------------------*/
int barre(int c, int l, int nlig, int ncol )
/* verifie que la ligne ne soit pas reduite
a deux pixels ;  retourne 1 si pixel supprime 0 sinon
Configurations pour lesquelles + ne doit pas etre mis a ZERO :
o    +    ox+  +xo
x    x
+    o
*/
{
/* barres verticales superieures et inferieure */
    if ((c<2 || c>nlig-3) || (l<2 || l>ncol-3))
	return(1);
/* barres verticales   haut et bas      */
    if (*(buf_squelette+(c-1)*ncol+l) + 2*( *(buf_squelette+(c-2)*ncol+l)) ==1)
	    return (0);
    if (*(buf_squelette+(c+1)*ncol+l) + 2*(*(buf_squelette+(c+2)*ncol+l)) ==1)
	    return (0);
/* barres horizontales gauche et droite */
    if (*(buf_squelette+(c)*ncol+(l-1)) + 2*(*(buf_squelette+(c)*ncol+(l-2))) ==1)
	    return (0);
    if (*(buf_squelette+(c)*ncol+(l+1)) + 2*(*(buf_squelette+(c)*ncol+(l+2))) ==1)
	    return (0);
    return (1);
} 

/* --------------------------------------------------------*/
int masque_squelette(int c,  int l, int nlig, int ncol)
/* renvoie 1 si pixel supprime, sinon 0 */
{
static int x,  y,  masque;
     	masque=0;	
	for (y=-1; y<2; y++)	/* lignes */
	for (x=-1; x<2; x++)	/* colonnes */
	    masque+=(*(buf_squelette+(c+y)*ncol+(l+x)))*voisinage[1+y][1+x];

        /* modifier le buffer de sortie si le pixel peut etre enleve  */
	switch (masque) {
	      /* masques initiaux : tous les symetriques de */
	      case 497 :  /*  xxx xxx xxx */
	      case 455 :  /*  oxx xxo xxx */
	      case 125 :  /*  oox ooo ooo */
              case 287 :
	      case 249 :
	      case 399 :
	      case 483 : 
	      case  63 :
	      case 241 :
	      case 271 :
	      case  61 :
	      case 451 :
	      case 481 :
	      case  31 :
	      case 391 :
	      case 121 :
	     /* Masques complementaires : les symetriques de  */
	      case  15 :  /* xxx xxo oxo */ 
	      case 387 :  /* oxo xxo xxo */
	      case  57 :  /* ooo ooo ooo */
	      case 225 :

	      case 113 :
	      case 449 :
	      case 263 :
	      case  29 :

	      case  21 :
	      case  81 :
	      case 321 :
	      case 261 :
		 if (barre(c, l, nlig, ncol))
		    return(1);
		else 
		    return(0);
		break;
	    default :
		return(0);
		break;
	}
       
}

/* --------------------------------------------------------*/
int nettoie_squelette(int c,  int l, int nlig, int ncol)
/* renvoie 1 si pixel supprime, sinon 0 */
{
static int x,  y,  masque;
     	masque=0;	
	for (y=-1; y<2; y++)	/* lignes */
	for (x=-1; x<2; x++)	/* colonnes */
	    masque+=(*(buf_squelette+(c+y)*ncol+(l+x)))*voisinage[1+y][1+x];

        /* modifier le buffer de sortie si le pixel peut etre enleve  */
	switch (masque) {
	      /* masques initiaux : tous les symetriques de */
	      case 497 :  /*  xxx xxx xxx */
	      case 455 :  /*  oxx xxo xxx */
	      case 125 :  /*  oox ooo ooo */
	      case 287 :
	      case 249 :
	      case 399 :
	      case 483 : 
	      case  63 :
	      case 241 :
	      case 271 :
	      case  61 :
	      case 451 :
	      case 481 :
	      case  31 :
	      case 391 :
	      case 121 :
	     /* Masques complementaires : les symetriques de  */
	      case  15 :  /* xxx xxo oxo */ 
	      case 387 :  /* oxo xxo xxo */
	      case  57 :  /* ooo ooo ooo */
	      case 225 :

	      case 113 :
	      case 449 :
	      case 263 :
	      case  29 :

	      case  21 :
	      case  81 :
	      case 321 :
	      case 261 :
	     /* */ 
		    return(1);
		break;
	    default :
		return(0);
		break;
	}
       
}

/* --------------------------------------------------------*/
int lisse_squelette(int c,  int l, int nlig, int ncol)
/* renvoie 1 si pixel supprime, sinon 0 */
{
static int x,  y,  masque;
     	masque=0;	
	for (y=-1; y<2; y++)	/* lignes */
	for (x=-1; x<2; x++)	/* colonnes */
	    masque+=(*(buf_squelette+(c+y)*ncol+(l+x)))*voisinage[1+y][1+x];

        /* modifier le buffer de sortie si le pixel peut etre enleve  */
	switch (masque) {
	      case   3 :
	      case   5 :
	      case   9 :
	      case  17 :
	      case  33 :
	      case  65 :
	      case 129 :
	      case 257 :
		    return(1);
		break;
	    default :
		return(0);
		break;
	}
}       

/* --------------------------------------------------------*/
int squelettise(int nbiterations, int nlig, int ncol)
{
/* Appliquer l'algorithme de squelettisation */
/* Les donnees sont modifiees dans un buffer */
int k,  i,  l;
int modif;
k=0;
do
{
   printf("Iteration %d ",++k);
   modif=0;
/* recopie dans le buffer */
  for (l=0; l<nlig    ; l++)
     *(buf_image+0*ncol+l)=*(buf_squelette+0*ncol+l);

  for(i=1; i<nlig-1; i++)
  {
    *(buf_image+i*ncol+l)=*(buf_squelette+i*ncol+l); 
    for (l=1; l<ncol-1; l++)
    {	/* calculer le masque */
     	*(buf_image+i*ncol+l)=*(buf_squelette+i*ncol+l);
      	if ( *(buf_image+i*ncol+l))
      	{
		if (masque_squelette(i,l, nlig, ncol))
		{  
     			*(buf_image+i*ncol+l)=0;
	    		modif++;
		}
    	 }	
    }
    *(buf_image+i*ncol+ncol-1)=*(buf_squelette+i*ncol+ncol-1);
  }
  for (l=0; l<ncol; l++)
     *(buf_image+(nlig-1)*ncol+l)=*(buf_squelette+(nlig-1)*ncol+l);
  
  /* Debug */
  printf(" Pixels modifies : %d\n",modif);
  /* recopier le tampon dans le nouveau squelette */
    for(i=0; i<nlig; i++)
    for (l=0; l<ncol; l++)
     *(buf_squelette+i*ncol+l)=*(buf_image+i*ncol+l);
} while ((modif) && (k<nbiterations));
return(k);
}

/* --------------------------------------------------------*/
int nettoyage(int nbiterations, int nlig, int ncol)
{
/* Les donnees sont modifiees en place */
int k,  i,  l;
int modif;
k=0;
do
{
   printf("Iteration %d ",++k);
   modif=0;
  for(i=1; i<nlig-1; i++)
  {
    for (l=1; l<ncol-1; l++)
    {	
      if ( *(buf_squelette+i*ncol+l))
      {
	 if (nettoie_squelette(i,l,nlig,ncol))
	 {   
            *(buf_squelette+i*ncol+l)=0;
	    modif++;
	 }
      }	
    }
  }
  /* Debug */
  printf(" Pixels modifies : %d\n",modif);
} while ((modif) && (k<nbiterations));
return(k);
}

/* --------------------------------------------------------*/
int lissage(int nbiterations, int nlig, int ncol)
{
/* Appliquer l'algorithme de lissage */
/* Les donnees sont modifiees dans un buffer */
int k,  i,  l;
int modif;
k=0;
do
{
   printf("Iteration %d ",++k);
   modif=0;
/* recopie dans le buffer */
  for (l=0; l<ncol; l++)
     *(buf_image+0*ncol+l)=*(buf_squelette+0*ncol+l);

  for(i=1; i<nlig-1; i++)
  {
    *(buf_image+i*ncol+0)=*(buf_squelette+i*ncol+0);
   
    for (l=1; l<ncol-1; l++)
    {	/* calculer le masque */
     *(buf_image+i*ncol+l)=*(buf_squelette+i*ncol+l);
      if (*buf_squelette+i*ncol+l)
      {
	 if (lisse_squelette(i,l,nlig,ncol))
	 {  
	    *(buf_image+i*ncol+l)=0;
	    modif++;
	 }
      }	
    }
    *(buf_image+i*ncol+ncol-1)=*(buf_squelette+i*ncol+ncol-1);
  }
  for (l=0; l<ncol; l++)
     *(buf_image+(nlig-1)*ncol+l)=*(buf_squelette+(nlig-1)*ncol+l);
  
  /* Debug */
  printf(" Pixels modifies : %d\n",modif);
  /* recopier le tampon dans le nouveau squelette */
    for(i=0; i<nlig; i++)
    for (l=0; l<ncol; l++)
     *(buf_squelette+i*ncol+l)=*(buf_image+i*ncol+l);
} while ((modif) && (k<nbiterations));
return(k);
}

