import java.util.*;
import java.awt.Color;

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
		
		/*
		* Tentative ratee d'afficher une bande de couleurs de l'image.
		* On essayer d'afficher les couleurs dominantes de l'image en
		* fonction de leur proportion.
		*/
		
		Picture bande = new Picture(BANDE_WIDTH, BANDE_HEIGHT);
		int curseur = 0;
		
		// On mouline sur tous les elements de l'histogramme
		Enumeration<Color> enumKey = histo.keys();
		while(enumKey.hasMoreElements())
		{
			Color c = enumKey.nextElement();
			Integer count = histo.get(c);
			
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
			}
			
			curseur = i;
		}
		
		//bande.show(); // a decommenter pour afficher la bande
	}
}
