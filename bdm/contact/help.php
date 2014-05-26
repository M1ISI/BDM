<html>
	<a href="help.php?lang=fr"><img style='border:none' src='images/fr.png' width=20 height=20></a>
	<a href="help.php?lang=en"><img style='border:none' src='images/us.png' width=20 height=20></a>
<?php
	
	if(isset($_GET['lang']) && $_GET['lang']=="en")
		include("help_en.htm");
	else
		include("help_fr.htm");
		
?>
</html>
