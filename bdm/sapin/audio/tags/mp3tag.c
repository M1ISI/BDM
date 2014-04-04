#include <stdio.h>
#include <stdlib.h>
#include <string.h>

typedef struct{
   char tag[3];
   char title[30];
   char artist[30];
   char album[30];
   char year[4];
   char comment[30];
   unsigned char genre;
} mp3Tag;

int main(int argc, char **argv)
{
	if(argc != 2)
		perror("Argument should be one and ONLY one mp3 song");

	FILE *fp = fopen(argv[1], "rb");
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
			printf("Track: %d\n", tag.comment[29]);
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
	return EXIT_SUCCESS;
}
