<?php
if($_FILES)
{
	$dossier = 'sons';
	$fichier = basename($_FILES['avatar']['name']);
	echo 'name : '.$fichier;
	$taille_maxi = 10000000;
	$taille = filesize($_FILES['avatar']['tmp_name']);
	$extensions = array('.mp3', '.MP3');
	$extension = strrchr($_FILES['avatar']['name'], '.'); 
	//Début des vérifications de sécurité...
	if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
	{
		 $erreur = 'Vous devez uploader un fichier de type mp3.';
	}
	if($taille>$taille_maxi)
	{
		 $erreur = 'Le fichier est trop gros (>10 Mo).';
	}
	if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
	{
		 //On formate le nom du fichier ici...
		 $fichier = strtr($fichier, 
			  'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
			  'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
		 $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
		 if(move_uploaded_file($_FILES['avatar']['tmp_name'], "$dossier/$fichier")) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
		 {
			  echo 'Upload effectué avec succès !';
		 }
		 else //Sinon (la fonction renvoie FALSE).
		 {
			  echo 'Echec de l\'upload !';
		 }
		 // !!!!!!!!!!!!!!!!!! ICI CYRIL !!!!!!!!!!!!!!!!!!!!
		 //echo exec('algo son'); 
	}
	else
	{
		 echo $erreur;
	}
}
?>
<div> Upload de morceaux mp3. </div>
<form method="POST" action="upload_sound.php" enctype="multipart/form-data">
     <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
     Fichier : <input type="file" name="avatar">
     <input type="submit" name="envoyer" value="Envoyer le fichier">
</form>