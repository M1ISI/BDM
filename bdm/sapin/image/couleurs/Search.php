<?php 
include 'color.php';
//Printing some buggy errors
ini_set('display_errors', 1); 
error_reporting(E_ALL);


ini_set('max_execution_time', 0); 

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


if(isset($_POST['submit'])){

	//Get the image from the Post files submitted
	$source_file = $_FILES['imgfile']['tmp_name'];

	// extract the actual image to a treatable format
	$im = ImageCreateFromAny($source_file); 


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

	printTab($histogram);

	

}
else{
?>

<form action="Search.php" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="imgfile" id="imgfile"><br>
<input type="submit" name="submit" value="Submit">
</form>
<?
}
?>
