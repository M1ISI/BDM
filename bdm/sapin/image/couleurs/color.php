<?

class Color{
	
		public $red = 0;
		public $blue = 0;
		public $green = 0;

		public $val =0;


		
		function __toString(){


				return " <div style=\"width:30px;height:30px;border:1px solid #000;background-color:".fromRGB($this->red,$this->green,$this->blue).";\"></div> ".$this->val."%" ;


		}
}

function fromRGB($R, $G, $B){
		 
		 $R=dechex($R);
		  If (strlen($R)<2)
				   $R='0'.$R;
		  
		   $G=dechex($G);
		  If (strlen($G)<2)
				   $G='0'.$G;
		  
		  $B=dechex($B);
		  If (strlen($B)<2)
				   $B='0'.$B;
	 	   
		   return '#' . $R . $G . $B;
		   

}

function printTab(array $tab){

		foreach($tab as $ind => $col){

				echo $col."<br>";


		}


}


function convertPercent(array $tab,$nbPixels){


		
		foreach($tab as $ind => $col){

				$col->val = (($col->val)*100)/$nbPixels;

				if ($col->val < $tab[0]->val/2.0 && $col->val<10){

					unset($tab[$ind]);

				}
		}


		return $tab;

}
 
function  getMax(array $tab,$i){

		$max=$i;

		if($i == sizeof($tab)-1){

			return $i;

		}
		
		foreach($tab as $ind => $col){

				if($ind>=$i && $col->val>=$tab[$max]->val){

						$max = $ind;

				}

				
		}

		return $max;

}

function colorCopy(Color $c1, Color $c2){


		$c1->red = $c2->red;
		$c1->green = $c2->green;
		$c1->blue = $c2->blue;
		$c1->val = $c2->val;

		return $c1;

}

function sortTab(array $tab){

		$temp;

		foreach($tab as $ind => $col){


			$temp = new Color();

			$max = getMax($tab,$ind);

			$temp = colorCopy($temp , $col);	

			$col = colorCopy($col , $tab[$max]);

			$tab[$max] = colorCopy($tab[$max] , $temp);
		}


		return $tab;
 
}


function getColors($source_file,$coded){


	if($coded == TRUE){

		
		// extract the actual image to a treatable format
		$im = ImageCreateFromAny($source_file); 

	}
	else{

		$im = $source_file;

	}



	//image size
	$imgw = imagesx($im);

	$imgh = imagesy($im);
	
	// n = total number or pixels
	
	$n = $imgw*$imgh;


	//temporary hastable it is going to have a type of int => int where the first one is the color value and the second one the count for that specific color 
	$histo = array();


	//for each pixel
	for ($i=0; $i<$imgw; $i++)
	{
	        for ($j=0; $j<$imgh; $j++)
	        {

				//you get the color
                $rgb = ImageColorAt($im, $i, $j); 

				//and increment the count of that color
				//the '@' removes does nasty warning prints
				@$histo[$rgb] += 1;

     	   }
	}

	//Now this is the REAL histogram composed of color objects
	$histogram = array();

	
	foreach($histo as $colVal => $value){

		//Magic formula, extracts the 3 color components for each color 	
		$r = ($colVal >> 16) & 0xFF;
        $g = ($colVal >> 8) & 0xFF;
        $b = $colVal & 0xFF;

		$color = new Color();

		//And we affect that to our color object
		$color->red = $r;
		$color->green = $g;
		$color->blue = $b;
		$color->val = $value;

		//And fill our histogram with it.
		$histogram[] = $color;


	}

	$histogram = sortTab($histogram);

	$histogram = convertPercent($histogram , $n);

	return $histogram;

	

}


//Allow to extract an image from any format
function imageCreateFromAny($filepath) { 
		$type = exif_imagetype($filepath); // [] if you don't have exif you could use getImageSize() 
		$allowedTypes = array( 
			1,  // [] gif 
			2,  // [] jpg 
			3,  // [] png 
			6   // [] bmp 
	); 

		if (!in_array($type, $allowedTypes)) { 
			return false; 
		}
	    switch ($type) { 
			case 1 : 
				$im = @imageCreateFromGif($filepath);
				break; 
			case 2 : 
				$im = @imageCreateFromJpeg($filepath);
				break; 
			case 3 : 
				$im = @imageCreateFromPng($filepath); 
				break; 
			case 6 : 
				$im = @imageCreateFromBmp($filepath); 
				break; 
		}    
		return $im; 

}





?>
