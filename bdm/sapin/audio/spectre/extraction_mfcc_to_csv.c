#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <regex.h>

#define TAILLE_MAX 1000

int main(int argc, char ** argv)
{
	if(argc < 2)
	{
		printf("arguments : @fichier\n");
		return -1;
	}

	FILE* fichier = NULL;
	char chaine[TAILLE_MAX] = "";
	int j;
	for(j = 1 ; j <= argc ; j++)
	{

		fichier = fopen(argv[j], "r");

		if(fichier != NULL)
		{
			int i = 1;
			while(fgets(chaine, TAILLE_MAX, fichier) != NULL)
			{
				if(i == 9)
					break;
				i++;
			}

			/* Extraction de la chaine par regex */
			int err;
			regex_t preg;
			char * str_regex = "\\[(.*)\\]";
			
			err = regcomp(&preg, str_regex, REG_EXTENDED);
			if(err == 0)
			{
				int match;
				size_t nmatch = 0;
				regmatch_t * pmatch = NULL;

				nmatch = preg.re_nsub;
				pmatch = malloc(sizeof(*pmatch) * nmatch);

				if(pmatch)
				{
					match = regexec(&preg, chaine, nmatch, pmatch, 0);
					regfree(&preg);

					if(match == 0)
					{
						char * data = NULL;
						int start = pmatch[0].rm_so;
						int end = pmatch[0].rm_eo;

						size_t size = end - start;

						data = malloc (sizeof (*data) * (size + 1));
						if(data)
						{
							strncpy(data, &chaine[start+1], size-2); // On demarre à start+1 pour enlever le "[", idem pour le "]"
							data[size-1] = '\0'; // meme raison qu'au dessus

							/* On a extrait la chaine qui nous interesse, on la split */
							char * token = NULL;
							char * tmp = NULL;
							char * coeffs[12];

							tmp = data;

							token = strsep(&data, ","); // pour ignorer le premier coeff

							int i = 0;
							while((token = strsep(&data, ",")) != NULL)
							{
								coeffs[i] = token;
								i++;
							}

							/* On possede les coeffs, on les enregistre dans un fichier */
							FILE * csv = fopen("extract.csv", "a");
							char * t = NULL;

							if(csv != NULL)
							{
								fprintf(csv, "%s;", argv[j]);
								for(i = 0 ; i < 12 ; i++)
								{
									fprintf(csv, "%s;", coeffs[i]);
								}

								fprintf(csv, "\n");

								fclose(csv);
							}

							free(tmp);
						}
					}
					else if(match == REG_NOMATCH)
					{
						printf("%s n\'est pas valide...\n", chaine);
					}
				}
			}

			fclose(fichier);
		}
	}

	return 0;
}
