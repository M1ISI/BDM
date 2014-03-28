#include "module_p.h"

/* module_p.c */
/* 24/10/95 */
/********************************************************************/
/*                     L E C T U R E - P P M . C                    */
/*                    jean.fruitet@univ-mlv                         */
/*------------------------------------------------------------------*/

/* -------------------------------------------------------------------*/
/* Un fichier PPM RAW binaire est constitute d'une entete :

P6\n# CREATOR: XV Version 3.00  Rev: 3/30/93\n320 280\n255

et des donnees :
R V B R V B ... avec R, V, B valeurs de 0..255 de chaque pixel

Pour passer du format PPM au format 1 octet par pixel pour squelettiser
l'image 
l'algorithme consiste a convertir chaque triplet en une valeur de 0..255
en recuperant 3 bits Rouge, 3 bits Vert et 2 bits bleu
Dans un deuxieme temps l'image ainsi obtenue est seuillee et 
binarisee...
*/

/* ************ Prototypes de fonctions */

/* Header */

/* ********************* Sources ************************* */
/* --------------------------------------------------------*/
unsigned char lut(unsigned char r, unsigned char v, unsigned char b)
/* Calcule une couleur 255 a partir de 3 composantes RVB
   en gardant 3 bits pour R et V et 2 bits pour B */
{
	return (unsigned char)((r/32)*32+(v/32)*4+b/64);
}

/* --------------------------------------------------------*/
void  lire_entete_ppm(  FILE *f_in,  int *lig,  int *col)
/* retourne les chaines strppm initialisees et le nombre de lignes
 et colonnes d'image*/
{
char strppm[80];
int ok=0;
int encore=0;
fgets ( strprogppm,4, f_in);
fgets ( strcreatorppm, 80, f_in);
do {
  fgets ( strppm, 80, f_in);
  ok=sscanf(strppm, "%d %d", col, lig); 
  encore++;
} while ((ok!=2) && (encore<=4));

if ( ok==2)
{
   fgets ( strnbcoulppm, 4,  f_in);
   printf("\nProg: %s Creat: %s\tLig:%d Col:%d\tCoul: %s\n", strprogppm, strcreatorppm, *lig,  *col, strnbcoulppm);
}
else
   {
	printf("Erreur de fichier entete \n");	
	exit(0);	
   }
}

/* --------------------------------------------------------*/
void  ecrire_entete_ppm(FILE *f_out,  int lig,  int col)
/* ecrit une entete de fichier ppm ligxcol ncoul */
{
char strppm[80];
sprintf (strppm,"%s%s%d %d\n%s\n",strprogppm, strcreatorppm, lig, col, strnbcoulppm);
fwrite(strppm,sizeof(char),strlen(strppm), f_out);
}
