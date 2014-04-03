/*
* Permet de convertir un fichier BMP en liste de points.
* Le format de fichier généré, utilisé par hausdorff_distance,
* est une succession de coordonnées x et y séparées par des espaces
* ou des retours à la ligne.
*/

#include "qdbmp.h"
#include <stdio.h>
#include <stdlib.h> /* abort */
#include <errno.h> /* errno */

int main( int argc, char* argv[] )
{
	UCHAR	r, g, b;
	UINT	width, height;
	UINT	x, y;
	BMP*	bmp;

	/* Check arguments */
	if ( argc != 3 )
	{
		fprintf( stderr, "Usage: %s <input file> <output file>\n", argv[ 0 ] );
		return 0;
	}

	/* Read an image file */
	bmp = BMP_ReadFile( argv[ 1 ] );
	BMP_CHECK_ERROR( stdout, -1 );
	
	/* ouverture du fichier de sortie */
	FILE* ptlist = fopen(argv[2], "w");
	if(ptlist == NULL)
	{
		perror("Unable to open output file");
		abort();
	}

	/* Get image's dimensions */
	width = BMP_GetWidth( bmp );
	height = BMP_GetHeight( bmp );

	/* Iterate through all the image's pixels */
	for ( x = 0 ; x < width ; ++x )
	{
		for ( y = 0 ; y < height ; ++y )
		{
			/* Get pixel's RGB values */
			BMP_GetPixelRGB( bmp, x, y, &r, &g, &b );

			/* Invert RGB values */
			/*BMP_SetPixelRGB( bmp, x, y, 255 - r, 255 - g, 255 - b );*/
			
			/* exportation de tous les pixels blancs */
			if(r == 255 && g == 255 && b == 255)
			{
				fprintf(ptlist, "%lu %lu\n", x, y); /* I believe this is the right format */
			}
			else if(r == 0 && g == 0 && b == 0)
			{
				/* black pixel: do nothing */
			}
			else /* invalid color */
			{
				fprintf(stderr, "*** FATAL: source image is not a binary image\n");
				fprintf(stderr, "x=%lu y=%lu r=%d g=%d b=%d", x, y, r, g, b);
				exit(EXIT_FAILURE);
			}
		}
	}

	/* Save result */
	/*BMP_WriteFile( bmp, argv[ 2 ] );
	BMP_CHECK_ERROR( stdout, -2 );*/


	/* Free all memory allocated for the image */
	BMP_Free( bmp );

	return 0;
}

