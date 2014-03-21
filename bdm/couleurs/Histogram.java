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
	public final int BANDE_WIDTH = 200;
	public final int BANDE_HEIGHT = 20;
	
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
		
<<<<<<< HEAD
		Picture bande = new Picture(200, 20);
=======
		/*
		* Tentative ratee d'afficher une bande de couleurs de l'image.
		* On essayer d'afficher les couleurs dominantes de l'image en
		* fonction de leur proportion.
		*/
		
		Picture bande = new Picture(BANDE_WIDTH, BANDE_HEIGHT);
		int curseur = 0;
>>>>>>> e6b3287271b398d2a960b410af33de720752dc40
		
		// On mouline sur tous les elements de l'histogramme
		Enumeration<Color> enumKey = histo.keys();

		String couleurs= "";

			int r=0,g=0,b=0,m=0,cy=0,y=0,w=0,bl=0;

		while(enumKey.hasMoreElements())
		{
			Color c = enumKey.nextElement();
			Integer count = histo.get(c);
			
<<<<<<< HEAD

			int Rouge = c.getRed(), Bleu =  c.getBlue() , Vert = c.getGreen();



			//bleu
			if( (0<= Rouge)  && (127> Rouge ) && ( 0 <= Vert) && (127 > Vert) && (255>= Bleu) && (127<Bleu)){

				b+=count;

			}			
			if( (0<= Rouge)  && (127> Rouge ) && ( 255 >= Vert) && (127 < Vert) && (0 <= Bleu) && (127 > Bleu)){

				g+=count;

			}	
			if( (255>= Rouge)  && (0< Rouge ) && ( 0 <= Vert) && (127 > Vert) && (0 <= Bleu) && (255 > Bleu)){

				r+=count;

			}	
			
			if( (255>= Rouge)  && (127< Rouge ) && ( 0 <= Vert) && (127 > Vert) && (255>= Bleu) && (127<Bleu)){

				m+=count;

			}	
			if( (0<= Rouge)  && (127> Rouge ) && ( 255 >= Vert) && (127 < Vert) && (255>= Bleu) && (127<Bleu)){

				cy+=count;

=======
			/*
			* En attendant d'avoir une bande de couleurs qui marche,
			* on affiche les valeurs brutes de l'histogramme.
			*/
			System.out.println("rgb("+c.getRed()+","+c.getGreen()+","+c.getBlue()+") -> " + count);
			
			// Ratio : (nb pixels / nb pixels total) * largeur bande
			int ratio = (count / pixelCount) * BANDE_WIDTH;
			int i;
			
			for(i = curseur; i < curseur + ratio; i++) // remplissage de la bande
			{
				for(int j = 0; j < 20; j++)
				{
					bande.set(i, j, c);
				}
>>>>>>> e6b3287271b398d2a960b410af33de720752dc40
			}


			if( (255>= Rouge)  && (127< Rouge ) && ( 255 >= Vert) && (127 < Vert) && (0<= Bleu) && (127>Bleu)){

				y+=count;

			}	
			if( (255>= Rouge)  && (127< Rouge ) && ( 255 >= Vert) && (127 < Vert) && (255 >= Bleu) && (127<Bleu)){

				w+=count;

			}	



			if( (0<= Rouge)  && (127> Rouge ) && ( 0 <= Vert) && (127 > Vert) && (0<= Bleu) && (127>Bleu)){

				bl+=count;

			}


		}
	
		
<<<<<<< HEAD
		
		if( (b/pixelCount*100) > 20){

			couleurs += " bleu comme la bite a Luis";		

		}

		if( (g/pixelCount*100) > 20){

			couleurs += " vert ";		

		}
		if( (r/pixelCount*100) > 20){

			couleurs += " rouge ";		

		}

		if( (m/pixelCount*100) > 20){

			couleurs += " magenta ";		

		}

		if( (cy/pixelCount*100) > 20){

			couleurs += " cyan ";		

		}

		if( (y/pixelCount*100) > 20){

			couleurs += " jaune ";		

		}

		if( (w/pixelCount*100) > 20){

			couleurs += " blanc ";		

		}

		if( (bl/pixelCount*100) > 20){

			couleurs += " noir(comme franck) ";		

		}

		System.out.println(couleurs);
		bande.show();
=======
		//bande.show(); // a decommenter pour afficher la bande
>>>>>>> e6b3287271b398d2a960b410af33de720752dc40
	}
}
