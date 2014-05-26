#include <stdio.h>
#include <stdlib.h>
#include <string.h>

#include <dirent.h>

//En cas de bug à la compilation : sudo apt-get install libsqlite3-0 libsqlite3-dev
#include <sqlite3.h>

#ifndef WIN32
    #include <sys/types.h>
#endif

#include "mp3tag_addDb.h"

/*typedef struct{
   char tag[3];
   char title[30];
   char artist[30];
   char album[30];
   char year[4];
   char comment[30];
   unsigned char genre;
} mp3Tag;*/

int isDir(struct dirent* ent)
{
    if ((strchr(ent->d_name, '.')) == NULL) // Si le nom du fichier n'a pas d'extension
        return 1;
    else
        return 0;
}

// Supprime les espace inutiles avant et après une string
char* strtrim (char *str)
{
    char *c;

    /* Remove leading blanks */
    c = str; 
    while (c != '\0' && *c == ' ')
        c++;
    str = c;

    /* Remove trailing blanks */
    c = str + strlen (str) - 1;
    while (c >= str)
    {
        if (*c == ' ' || *c == '\t' || *c == '\n')
            *c = '\0';
        else
            break;
        c--;
    }

    return str;
}

// Connexion à la base de données
sqlite3* connectToDb()
{
    sqlite3 *db;
    int rc;

    rc = sqlite3_open("../../../testBDD/test.db", &db);

    if (rc != SQLITE_OK)
    {
        fprintf(stderr, "Can't open database: %s\n", sqlite3_errmsg(db));
        sqlite3_close(db);
        return NULL;
    }

    fprintf(stdout, "Connexion successful\n");
    return db;
}

// Ajoute les tags dans la base de données
int addDataToDb(sqlite3 *db, mp3Tag myTag)
{
    char buf[2000] = {""};
    char *zErrMsg = NULL;
    int rc;

    //Il faut une string par champ a insérer via la requête SQL pour ne pas écraser la structure des tags (ce qui est un peu étrange d'ailleurs)
    char buf_title[TAG_FIELD_SIZE] = {""};
    strncpy(buf_title, myTag.title, TAG_FIELD_SIZE);

    char buf_artist[TAG_FIELD_SIZE] = {""};
    strncpy(buf_artist, myTag.artist, TAG_FIELD_SIZE);

    //Création et exécution de la requête => il faut vraiment trouver un moyen de mapper les numéros de genre et le nom complet
    sprintf(buf, "INSERT INTO MUSICS (FILE, TITLE, AUTHOR, YEAR, STYLE) VALUES (0, \"%s\", \"%s\", %d, %d)", strtrim(buf_title), strtrim(buf_artist), atoi(myTag.year), myTag.genre);
    rc = sqlite3_exec(db, buf, NULL, 0, &zErrMsg);

    if (rc != SQLITE_OK)
    {
        fprintf(stderr, "SQL error: %s\n", zErrMsg);
        sqlite3_free(zErrMsg);

        return 0;
    }
    return 1;
}

void dirExplorer(char* upFile, sqlite3* db)
{
	DIR* directory = NULL;
 	struct dirent* file = NULL; // Déclaration d'un pointeur vers la structure dirent
   	//directory = opendir(dir); // Ouverture d'un dossier (mettre le répertoire contenant les musiques)

	/*if (directory == NULL) // Si le dossier n'a pas pu être ouvert
	{
        	perror("Couldn't open repository");
		exit(-1); // Mauvais chemin par exemple
	}*/

	printf("File reached successfully \n");

	/*while ((file = readdir(directory)) != NULL)
	{*/
		/*if (isDir(file)) // Si l'on a 
		{
			printf("%s est un repertoire\n", file->d_name);
			char * subdir =(char *)malloc(1024*sizeof(char));
			strcpy(subdir, strcat(dir, "/"));
			dirExplorer(strcat(subdir, file->d_name), db);
			free(subdir);
		}*/

		//if (strcmp(strndup(file->d_name + strlen(file->d_name) - 4, 4), ".mp3") == 0 && strcmp(file->d_name, ".") != 0 				&& strcmp(file->d_name, "..") != 0) // On ne gere que les fichiers .mp3 
		//{
			FILE *fp = fopen(upFile, "rb");

			if (!fp)
			{
				perror("File open failed");
				return;
			}
            /*else if(!(strcmp(strndup(file->d_name + strlen(file->d_name) - 4, 4), ".mp3") == 0 && strcmp(file->d_name, ".") != 0 && strcmp(file->d_name, "..") != 0)) // On ne gere que les fichiers .mp3 
            {
                fprintf(stderr, "Le fichier n'est pas un MP3");
                fclose(fp);
                return;
            }*/

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
                if (!addDataToDb(db, tag))
                {
                    fprintf(stderr, "Embedding tags to database has failed\n");
                    return;
                }
                else
                    fprintf(stdout, "Embedding tags is successful\n");
			}
			//Sinon
			else
			{
				fprintf(stderr, "Failed to find TAG\n");
				exit(-1);
			}
		
			//free(str);
            fclose(fp);

	        printf("Closed with success \n");
}


int main(int argc, char ** argv)
{
	if (argc != 2 )
	{	
		fprintf(stderr, "./main Name of directory \n");
		return EXIT_FAILURE;
	}
    sqlite3* db = connectToDb();
    if (db == NULL)
    {
        fprintf(stderr, "Aborting\n");
        return EXIT_FAILURE;
    }

	dirExplorer(argv[1], db);

    sqlite3_close(db);
	return EXIT_SUCCESS;
}

