#include <stdio.h>
#include <stdlib.h>
#include <string.h>

#include <dirent.h> 

#ifndef WIN32
    #include <sys/types.h>
#endif

typedef struct{
   char tag[3];
   char title[30];
   char artist[30];
   char album[30];
   char year[4];
   char comment[30];
   unsigned char genre;
} mp3Tag;

int isDir(struct dirent* ent)
{
    if ((strchr(ent->d_name, '.')) == NULL) // Si le nom du fichier n'a pas d'extension
        return 1;
    else
        return 0;
}

void dirExplorer(char* dir)
{
	DIR* directory = NULL;
 	struct dirent* file = NULL; // Déclaration d'un pointeur vers la structure dirent
   	directory = opendir(dir); // Ouverture d'un dossier (mettre le répertoire contenant les musiques)

	if (directory == NULL) // Si le dossier n'a pas pu être ouvert
	{
        	perror("Couldn't open repository");
		exit(-1); // Mauvais chemin par exemple
	}
        
	printf("Opened with success \n");

	while ((file = readdir(directory)) != NULL)
	{
		if (isDir(file)) // Si l'on a 
		{
			printf("%s est un repertoire\n", file->d_name);
			char * subdir =(char *)malloc(1024*sizeof(char));
			strcpy(subdir, strcat(dir, "/"));
			dirExplorer(strcat(subdir, file->d_name));
			free(subdir);
		}

		if (strcmp(strndup(file->d_name + strlen(file->d_name) - 4, 4), ".mp3") == 0 && strcmp(file->d_name, ".") != 0 				&& strcmp(file->d_name, "..") != 0) // On ne gere que les fichiers .mp3 
		{
			printf("\nName of the file: '%s'\n", file->d_name);
			char * str =(char *)malloc(1024*sizeof(char));
			strcpy(str, strcat(dir, "/"));
			FILE *fp = fopen(strcat(str, file->d_name), "rb");
			if (!fp)
			{
				perror("File open failed");
				exit(-1);
			}

			mp3Tag tag;

			// Les tags mp3 sont contenus dans les 128 derniers bytes du fichier
			if (fseek(fp, -1 * sizeof(mp3Tag), SEEK_END) == -1)
			{
				perror("fseek failed");
				exit(-1);
			}

			// On lit les tags
			if (fread(&tag, sizeof(mp3Tag), 1, fp) != 1)
			{
				fprintf(stderr, "Failed reading tag\n");
				exit(-1);
			}

			// On vérifie que l'entête est bien "TAG"
			if (memcmp(tag.tag, "TAG", 3) == 0)
			{
				// A partir d'ici, on récupère les différents tags
				printf("Title: %.30s\n", tag.title); // titre
				printf("Artist: %.30s\n", tag.artist); // artiste
				printf("Album: %.30s\n", tag.album); // album
				printf("Year: %.4s\n", tag.year); // année
		
				if (tag.comment[28] == '\0')
				{
					printf("Comment: %.28s\n", tag.comment); // commentaires (sont-ils vraiment utiles ?)
					printf("Track: %d\n", tag.comment[29]); // numéro de la chanson sur l'album
				}
				else
				{
					printf("Comment: %.30s\n", tag.comment);
				}
				printf("Genre: %d\n", tag.genre); // genre musical (valeur entière, voir comment récupérer le nom complet)
			}
			//Sinon
			else
			{
				fprintf(stderr, "Failed to find TAG\n");
				exit(-1);
			}
		
			free(str);
		}
	}

    	if (closedir(directory) == -1) // S'il y a eu un souci avec la fermeture/
	{
        	perror("Couldn't close repository");
		exit(-1); // Mauvais chemin par exemple
	}

    	printf("Closed with success \n");
}

int main(int argc,char ** argv)
{
	char * dir =(char *)malloc(1024*sizeof(char));

	if (argc != 2)
	{	
		printf("./main Name of directory \n");
		return EXIT_FAILURE;
	}
	else
	{
		strcpy(dir, argv[1]);
	}

	dirExplorer(dir);
	free(dir);
	return EXIT_SUCCESS;
}
