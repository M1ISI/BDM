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

	public static ArrayList<Map.Entry<Color,Integer>> sortValue(Hashtable<Color, Integer> t){

		//Transfer as List and sort it
		ArrayList<Map.Entry<Color, Integer>> l = new ArrayList<Map.Entry<Color,Integer>>(t.entrySet());
		Collections.sort(l, new Comparator<Map.Entry<Color, Integer>>(){

			 public int compare(Map.Entry<Color, Integer> o1, Map.Entry<Color, Integer> o2) {
			 	return o2.getValue().compareTo(o1.getValue());
			
			 }
		});
			  
		return l;
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
		
		// Recuperation de l'histogramme
		Hashtable<Color,Integer> histo = getHistogram(img);
		
		//Picture band = new Picture(BAND_WIDTH, BAND_HEIGHT);
		int cursor = 0;
		
		//trie de la hashtable		
		ArrayList<Map.Entry<Color,Integer>> l = sortValue(histo), last = new ArrayList<Map.Entry<Color,Integer>>();
		

		for (Map.Entry<Color,Integer> iter : l) {
	
			double val = iter.getValue();

			val = val/pixelCount*100.0;
	

			if(val < 1){

					

			}

			else{
				
				last.add(iter);
			}
		}

		for (Map.Entry<Color,Integer> iter : last) {

			double val = iter.getValue();
		
			val = val/pixelCount*100.0;
		
			System.out.println("(r : "+iter.getKey().getRed()+
								   " , g : "+iter.getKey().getGreen()+
								   " , b : "+iter.getKey().getBlue()+
								   " ) -> "+val+"%");
	
		}
	

		// On mouline sur tous les elements de l'histogramme
		Enumeration<Color> enumKey = histo.keys();

/*
		while(enumKey.hasMoreElements())
		{
			Color c = enumKey.nextElement();
			double count = histo.get(c);

			int red = c.getRed(), blue =  c.getBlue(), green = c.getGreen();



		}
		
*/
	}

}









