<?php 
include 'color.php';
//Printing some buggy errors
ini_set('display_errors', 1); 
error_reporting(E_ALL);


ini_set('max_execution_time', 0); 



if(isset($_POST['submit'])){

	//Get the image from the Post files submitted
	$source_file = $_FILES['imgfile']['tmp_name'];



	$histogram = getColors($source_file,TRUE);

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
