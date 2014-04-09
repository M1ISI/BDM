/* squelette.c */
/********************************************************************/
/*                    S Q U E L E T T E . C                         */
/*                    jean.fruitet@univ-mlv                         */
/*------------------------------------------------------------------*/
/*    Squelettisation  d'une image binaire                          */
/********************************************************************/

/*
   Modifications : 22/02/2005 Remplacement de fprintf(stderr,...) par printf(...) 
   Modifications : 13/06/97 Correction bug sur seuillage       
   Modifications : 20/10/95 Memoire dynamique pour les tampons 
*/

#include "stdio.h"
#include "stdlib.h"
#include "math.h"
#include "module_p.h"
#include "module_s.h"

/*

ALGORITHME de Squelettisation
-----------------------------
Par passage de masques en verifiant de conserver les lignes 
horizontales ou verticales de deux pixels entre deux balayage...
pour conserver la connexite
*/

#define MAX_LIGNE       1000
#define MAX_COLON       1000
#define MAXINT          32765
#define LONGBUF (3*MAX_COLON)   /* 3 octets par pixel sur chaque ligne */
#define MAXSEUILLAGE    0
#define MAXITERATION    100
#define MAXLISSAGE      10

int seuillage=0;
int nbiterations=MAXITERATION;
int nbnettoie   =MAXITERATION;
int nbiteration1, nbiteration2, nbiteration3;
int nblissage   =1;
char nf1[20], nf4[20], entete[80];
FILE *fin1, *fent;
FILE *fout;
unsigned char buf_in[LONGBUF];


/****************** PROGRAMME PRINCIPAL *********/
int main(int argc, char **argv)
/* creation d'un fichier d'image squelettisee
   binarisee a partir d'un fichier PPM Format RAW */
{
int i,k,l;
//int modif;
long minz, maxz;
//char dr;
//char *ch = "Squelettisation-jf-umlv ";
/*
fprintf(stderr,"---- SQUELETTE - JF 1995 (Jean.Fruite@univ-mlv.fr)  ----------\n");
fprintf(stderr,"Creation d'un fichier de SQUELETTE a partir d'une image PPM (RAW)\n");
fprintf(stderr,"En entree, les pixels de valeur elevee (superieures au seuil) seront condideres comme le trait\n");
fprintf(stderr,"les pixels de valeur faible (<= seuil) seront consideres comme le fond \n");
fprintf(stderr,"En sortie les donnees du fond d'image sont ramenees a 0, le trait a 255 \n" ); 
fprintf(stderr,"Algorithme avec recopie dans tampon intermediaire \n");
fprintf(stderr,"L'image initiale est seuillee \n");
fprintf(stderr,"Le fond est mis a 0 et la forme a 1 apres seuillage\n");
fprintf(stderr,"\nSyntaxe : %s [file_in.PPM] [file_out.PPM] [seuil] [iterations] [nettoyage] [lissage]\n",argv[0]);
fprintf(stderr,"Seuil ([0]..255) : les pixels < Seuil sont ramenes a 0\n");
fprintf(stderr,"Iterations (-1,0..n) [100] : le filtrage s'applique au plus n fois \n");
fprintf(stderr,"Nettoyage  (-1,0..n) [100] : le nettoyage s'applique au plus n fois \n");
fprintf(stderr,"Lissage (-1,0..n) [10] : le lissage s'applique au plus n fois \n");
*/
printf("---- SQUELETTE - JF 1995 (Jean.Fruite@univ-mlv.fr)  ----------\n");
printf("Creation d'un fichier de SQUELETTE a partir d'une image PPM (RAW)\n");
printf("En entree, les pixels de valeur elevee (superieures au seuil) seront condideres comme le trait\n");
printf("les pixels de valeur faible (<= seuil) seront consideres comme le fond \n");
printf("En sortie les donnees du fond d'image sont ramenees a 0, le trait a 255 \n" ); 
printf("Algorithme avec recopie dans tampon intermediaire \n");
printf("L'image initiale est seuillee \n");
printf("Le fond est mis a 0 et la forme a 1 apres seuillage\n");
printf("\nSyntaxe : %s [file_in.PPM] [file_out.PPM] [seuil] [iterations] [nettoyage] [lissage]\n",argv[0]);
printf("Seuil ([0]..255) : les pixels < Seuil sont ramenes a 0\n");
printf("Iterations (-1,0..n) [100] : le filtrage s'applique au plus n fois \n");
printf("Nettoyage  (-1,0..n) [100] : le nettoyage s'applique au plus n fois \n");
printf("Lissage (-1,0..n) [10] : le lissage s'applique au plus n fois \n");

if (argc>1)
{
  strcpy(nf1,argv[1]);
}
else
{
printf("Nom du fichier PPM au format RAW (binaire) "); 
printf("Les donnees du fond d'image seront ramenees a 0 0 0, le trait a 255 255 255\n" ); 
	scanf("%s",nf1);
}
if (argc>2)
     strcpy(nf4,argv[2]);
else
{
	printf("Nom du fichier Squelette (PPM) en sortie  "); 
	scanf("%s",nf4);
}
if (argc>3)
     seuillage=atoi(argv[3]); 
if (argc>4)
     nbiterations=atoi(argv[4]);
else
     nbiterations=MAXITERATION;
if (argc>5)
     nbnettoie   =atoi(argv[5]);
else
     nbnettoie   =MAXITERATION;
if (argc>6)
     nblissage   =atoi(argv[6]);
else
     nblissage   =MAXLISSAGE;

if (nbiterations==-1)
     nbiterations=MAXINT;
if (nbnettoie   ==-1)
     nbiterations=MAXINT;
if (nblissage==-1)
     nblissage=MAXINT;
	

printf("Creation du fichier de SQUELETTE %s a partir de %s\n",nf4,nf1);
if ((fin1 = fopen(nf1,"r"))==NULL)
{
     printf("\n ERREUR %s\n",nf1);
      exit(0);
}

/*lire l'entete PPM   */
lire_entete_ppm(fin1, &MAXLIGNE, &MAXCOLON);
printf(" Entete : Ligne:%d Colonne: %d\n",MAXLIGNE, MAXCOLON);

/* reserver de l'espace memoire pour stoker l'image */
if ((buf_image = (unsigned char*)calloc(MAXLIGNE*MAXCOLON, sizeof(char)))==NULL)
{
	perror("Espace memoire insuffisant ");
	exit(1);
}
if ((buf_squelette = (unsigned char*)calloc(MAXLIGNE*MAXCOLON, sizeof(char)))==NULL)
{
	perror("Espace memoire insuffisant ");
	exit(1);
}

/* Lire 1 ligne du fichier pour chercher les RVB de chaque pixel */
/* convertir chaque triplet RVB en un seul octet */ 
for(i=0; i<MAXLIGNE; i++)
{
     if (!feof(fin1))
     {
	if (fread(&buf_in,sizeof(char),MAXCOLON*3,fin1))
	{
	   for (l=0; l<MAXCOLON; l++)
	   {
		*(buf_image+i*MAXCOLON+l) = lut(buf_in[l*3],buf_in[l*3+1],buf_in[l*3+2]); 
	   } 
	}
  }
}
fclose(fin1);
  
printf("\n Creation de l'image initiale terminee \n");
 
/* rechercher le minimum et le maxIMum */
maxz=0;
minz=MAXINT;

for(i=0; i<MAXLIGNE; i++)
  for (l=0; l<MAXCOLON; l++)
  {
    if (minz>(unsigned char)*(buf_image+i*MAXCOLON+l)) 
       minz=(unsigned char) *(buf_image+i*MAXCOLON+l);
    if (maxz<(unsigned char)*(buf_image+i*MAXCOLON+l))
       maxz=(unsigned char)*(buf_image+i*MAXCOLON+l);
  }
printf("Valeur MIN:%d, MAX:%d\tSeuillage a %d\n",minz,maxz, seuillage);
if (seuillage<minz)
{
	printf("Selectionnez une valeur de seuil entre %d et %d \n",minz, maxz);
	scanf("%d",&seuillage);
}

/* initialiser le buffer de squelettisation */
  for(i=0; i<MAXLIGNE; i++)
    for (l=0; l<MAXCOLON; l++)
	if ((unsigned char)*(buf_image+i*MAXCOLON+l)>seuillage)
		*(buf_squelette+i*MAXCOLON+l)=1;              
	else    
		*(buf_squelette+i*MAXCOLON+l)=0;              

/* squelettisation */
nbiteration1=squelettise(nbiterations,MAXLIGNE, MAXCOLON);
printf("La squelettisation avec TAMPON\nest achevee apres %d iterations avec SEUILLAGE=%d \n",nbiteration1,seuillage);

/* nettoyage */
nbiteration2=nettoyage(nbnettoie,MAXLIGNE,MAXCOLON);
printf("Le nettoyage sans TAMPON\nest acheve apres %d iterations\n",nbiteration2);

/* lissage */ 
nbiteration3=lissage(nblissage,MAXLIGNE,MAXCOLON); 
printf("Le lissage est acheve pour %d iterations \n",nbiteration3);
nbiterations=nbiteration1+nbiteration2+nbiteration3;
 
/* sauvegarder le squelette        */
if ((fout = fopen(nf4,"w"))==NULL)
{
	printf("\nERREUR creation %s\n",nf4);
      exit(0);
}

ecrire_entete_ppm(fout,MAXCOLON, MAXLIGNE);
for(i=0; i<MAXLIGNE; i++)
{
  for (l=0; l<MAXCOLON; l++)
     for (k=0; k<3; k++)
	buf_in[l*3+k]=(*(buf_squelette+i*MAXCOLON+l))*255;
  fwrite(&buf_in,sizeof(char),MAXCOLON*3,fout);
}
fclose(fout);

printf("Squelettisation achevee apres  %d iterations \n",nbiterations);
return 0;
}

