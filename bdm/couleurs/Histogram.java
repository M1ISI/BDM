import java.util.*;
import java.awt.Color;

public class Histogram
{
	public static Hashtable<Color,Integer> getHistogram(Picture img)
	{
		Hashtable<Color,Integer> histo = new Hashtable<Color,Integer>();
		
		int height = img.height();
		int width = img.width();
		
		//System.err.println("-+- height=" + height + " width=" + width);
		//System.err.println("-+- total pixels : " + height*width);
		
		for(int i = 0; i < width; i++)
		{
			for(int j = 0; j < height; j++)
			{
				Color c = img.get(i, j); // on récupère la couleur
				
				Integer count = histo.get(c); // sa valeur dans l'histogramme
				
				if(count == null) // Si aucune valeur définie...
				{
					histo.put(c, new Integer(1));
				}
				else // On a déjà cette couleur dans l'histogramme, on incrémente
				{
					histo.put(c, new Integer(count.intValue() + 1));
				}
			}
		}
		
		return histo;
	}
	
	public static void main(String[] args)
	{
		if(args.length < 1)
		{
			System.err.println("Nom de fichier manquant !");
			System.exit(0);
		}
		
		Picture img = new Picture(args[0]);
		int pixelCount = img.height() * img.width();
		System.err.println("-+- total pixels : " + pixelCount);
		
		Hashtable<Color,Integer> histo = getHistogram(img);
		//System.out.println(histo);
		
		Picture bande = new Picture(200, 20);
		int curseur = 0;
		
		Enumeration<Color> enumKey = histo.keys();
		while(enumKey.hasMoreElements())
		{
			Color c = enumKey.nextElement();
			Integer count = histo.get(c);
			
			//System.out.println("rgb("+c.getRed()+","+c.getGreen()+","+c.getBlue()+") -> " + count);
			
			int ratio = (count / pixelCount) * 200;
			int i;
			
			for(i = curseur; i < curseur + ratio; i++)
			{
				for(int j = 0; j < 20; j++)
				{
					bande.set(i, j, c);
				}
			}
			
			curseur = i;
		}
		
		bande.show();
	}
}
