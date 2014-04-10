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

int main()
{
	DIR* directory = NULL;
 	struct dirent* file = NULL; // Déclaration d'un pointeur vers la structure dirent
   	directory = opendir("Shogun"); // Ouverture d'un dossier (mettre le répertoire contenant les musiques)

    	if (directory == NULL) // Si le dossier n'a pas pu être ouvert
	{
        	perror("Couldn't open repository");
		return EXIT_FAILURE; // Mauvais chemin par exemple
	}
        
	printf("Opened with success");

	while ((file = readdir(rep)) != NULL)
	{
		if (strcmp(strndup(file->d_name + strlen(file->d_name) - 4, 4), ".mp3") == 0 && strcmp(file->d_name, ".") != 0 				&& strcmp(file->d_name, "..") != 0) // On ne gere que les fichiers .mp3 
		{
			printf("Name of the file: '%s'\n", file->d_name);
			char str[128];
			strcpy(str, "Shogun/");
			FILE *fp = fopen(strcat(str, file->d_name), "rb");
			if (!fp)
			{
				perror("File open failed");
				return EXIT_FAILURE;
			}

			mp3Tag tag;

			// Les tags mp3 sont contenus dans les 128 derniers bytes du fichier
			if (fseek(fp, -1 * sizeof(mp3Tag), SEEK_END) == -1)
			{
				perror("fseek failed");
				return EXIT_FAILURE;
			}

			// On lit les tags
			if (fread(&tag, sizeof(mp3Tag), 1, fp) != 1)
			{
				fprintf(stderr, "Failed reading tag\n");
				return EXIT_FAILURE;
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
				return EXIT_FAILURE;
			}
		}
	}

    	if (closedir(rep) == -1) // S'il y a eu un souci avec la fermeture/
	{
        	perror("Couldn't close repository");
		return EXIT_FAILURE; // Mauvais chemin par exemple
	}

    	puts("Closed with success");

	return EXIT_SUCCESS;
}
