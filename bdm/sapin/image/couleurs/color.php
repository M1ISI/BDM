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



?>
