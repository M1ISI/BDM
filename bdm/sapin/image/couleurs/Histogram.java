import java.util.*;
import java.awt.Color;
import java.lang.String;

/*
* Classe Histogram
* Permet de dresser l'histogramme de couleurs d'une image.
* TODO : classer par groupe de couleur plutot que par valeur RGB
* TODO : renvoyer la/les couleurs dominantes en mot-cle
*/

public class Histogram
{
	// Dimensions de la bande de couleurs (inutilise pour le moment)
	public final int BAND_WIDTH = 200;
	public final int BAND_HEIGHT = 20;
	
	public static Hashtable<Color,Integer> getHistogram(Picture img)
	{
		/*
		* On utilise le type Hashtable qui permet de gerer une collection
		* d'objets avec des indices de type Color.
		*/
		Hashtable<Color,Integer> histo = new Hashtable<Color,Integer>();
		
		int height = img.height();
		int width = img.width();
		
		// On itere sur tous les pixels de l'image...
		for(int i = 0; i < width; i++)
		{
			for(int j = 0; j < height; j++)
			{
				Color c = img.get(i, j); // on recupere la couleur du pixel courant
				Integer count = histo.get(c); // le nombre d'occurences de cette couleur dans l'histogramme
				
				if(count == null) // On n'a pas encore cette couleur dans l'histogramme, on initialise a 1
				{
					histo.put(c, new Integer(1));
				}
				else // On a deja cette couleur dans l'histogramme, on incremente
				{
					histo.put(c, new Integer(count.intValue() + 1));
				}
			}
		}
		
		return histo;
	}

	
	public static void main(String[] args)
	{
		if(args.length < 1) // doit avoir au moins 1 parametre
		{
			System.err.println("Usage: java Histogram <nom de fichier>");
			System.exit(0);
		}
		
		// Creation de l'objet image a partir du nom de fichier passe en argument
		Picture img = new Picture(args[0]);
		// Recuperation de la taille de l'image
		int pixelCount = img.height() * img.width();
		System.err.println("-+- total pixels : " + pixelCount);
		
		// Recuperation de l'histogramme
		Hashtable<Color,Integer> histo = getHistogram(img);
		//System.out.println(histo);
		
		Picture band = new Picture(200, 20);
		/*
		* Tentative ratee d'afficher une bande de couleurs de l'image.
		* On essayer d'afficher les couleurs dominantes de l'image en
		* fonction de leur proportion.
		*/
		
		//Picture band = new Picture(BAND_WIDTH, BAND_HEIGHT);
		int cursor = 0;
		
		// On mouline sur tous les elements de l'histogramme
		Enumeration<Color> enumKey = histo.keys();

		String colors = "";

		double r=0,g=0,b=0,m=0,cy=0,y=0,w=0,bl=0,gr=0;

		while(enumKey.hasMoreElements())
		{
			Color c = enumKey.nextElement();
			double count = histo.get(c);

			int red = c.getRed(), blue =  c.getBlue(), green = c.getGreen();

			//bleu
			if((0 <= red)  && (40 > red) && (0 <= green) && (40 > green) && (255 >= blue) && (215 < blue)){

				b+=count;
				System.out.println(b);

			}
			
			//vert
			if((0 <= red)  && (40 > red) && (255 >= green) && (215 < green) && (0 <= blue) && (40 > blue)){

				g+=count;

			}
			
			//rouge
			if((255 >= red)  && (215 < red) && (0 <= green) && (40 > green) && (0 <= blue) && (40 > blue)){

				r+=count;

			}	
			
			//magenta
			if((255 >= red)  && (215 < red) && (0 <= green) && (40 > green) && (255 >= blue) && (215 < blue)){

				m+=count;

			}	
			
			//cyan
			if((0 <= red)  && (40 > red) && (255 >= green) && (215 < green) && (255 >= blue) && (215 < blue)){

				cy+=count;
			}
			
			//jaune
			if((255 >= red)  && (215 < red) && (255 >= green) && (215 < green) && (0 <= blue) && (40 > blue)){

				y+=count;

			}
			
			//blanc
			if((255 >= red)  && (215 < red) && (255 >= green) && (215 < green) && (255 >= blue) && (215 < blue)){

				w+=count;

			}
			
			//noir
			if((0 <= red)  && (40 > red) && (0 <= green) && (40 > green) && (0 <= blue) && (40 > blue)){

				bl+=count;
				System.out.println(bl);

			}
			
			if((40 <= red) && (215 > red) && (40 <= green) && (215 > green) && (40 <= blue) && (215 > blue)){
				
				gr+=count;
			
			}
			
			/*
			* En attendant d'avoir une bande de couleurs qui marche,
			* on affiche les valeurs brutes de l'histogramme.
			*/
			/*System.out.println("rgb("+c.getRed()+","+c.getGreen()+","+c.getBlue()+") -> " + count);
			
			// Ratio : (nb pixels / nb pixels total) * largeur bande
			int ratio = (count / pixelCount) * BANDE_WIDTH;
			int i;
			
			for(i = cursor; i < cursor + ratio; i++) // remplissage de la bande
			{
				for(int j = 0; j < 20; j++)
				{
					band.set(i, j, c);
				}
			}*/
		}

		System.out.println((bl/pixelCount));
	
		if((b/pixelCount*100) > 10){

			colors += " bleu";

		}

		if((g/pixelCount*100) > 10){

			colors += " vert ";		

		}

		if((r/pixelCount*100) > 10){

			colors += " rouge ";

		}

		if((m/pixelCount*100) > 10){

			colors += " magenta ";

		}

		if((cy/pixelCount*100) > 10){

			colors += " cyan ";		

		}

		if((y/pixelCount*100) > 10){

			colors += " jaune ";

		}

		if((w/pixelCount*100) > 10){

			colors += " blanc ";	

		}

		if((bl/pixelCount*100) > 10){

			colors += " noir ";	

		}
		
		if((gr/pixelCount*100) > 10) {
			
			colors += " gris ";
			
		}

		System.out.println(colors);
		band.show();
	}
}
