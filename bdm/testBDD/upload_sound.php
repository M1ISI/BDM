<?php
if($_FILES)
{
    echo '<pre>';
    print_r($_FILES['avatar']);
    echo '</pre>';
	$dossier = '../music_folder';
	$fichier = basename($_FILES['avatar']['name']);
	//echo 'Upload du fichier : '.$fichier;
	$taille_maxi = 100000000;
	$taille = $_FILES['avatar']['size'];
	$extensions = array('.mp3', '.MP3');
	$extension = strrchr($_FILES['avatar']['name'], '.'); 
	//D�but des v�rifications de s�curit�...
	if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
	{
		 $erreur = 'Vous devez uploader un fichier de type mp3.';
	}
	if($taille>$taille_maxi)
	{
		 $erreur = 'Le fichier est trop gros (>100 Mo).';
	}
	if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
	{
		 //On formate le nom du fichier ici...
		 $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
		 if(move_uploaded_file($_FILES['avatar']['tmp_name'], "../sapin/audio/music_folder/" . $fichier)) //Si la fonction renvoie TRUE, c'est que ca a fonctionné...
		 {
			  echo 'Upload reussi !';
		 }
		 else //Sinon (la fonction renvoie FALSE).
		 {
			  echo 'Echec de l\'upload !';
		 }
        //exécution du programme C ==> attention aux droits
        echo "../sapin/audio/tags/mp3tag_addFileToDb.c ../sapin/audio/music_folder/" . $fichier;
        //echo exec("cd /opt/lampp/htdocs/BDM/bdm/sapin/audio/tags/ && pwd");
        echo exec("cd /opt/lampp/htdocs/BDM/bdm/sapin/audio/tags/ && ./mp3tag ../music_folder/" . $fichier);
	}
	else
	{
		 echo $erreur;
	}
}
?>
<div><br/> Upload de morceaux mp3. </div>
<form method="POST" action="upload_sound.php" enctype="multipart/form-data">
     <input type="hidden" name="MAX_FILE_SIZE" value="100000000">
     Fichier : <input type="file" name="avatar">
     <input type="submit" name="envoyer" value="Envoyer le fichier">
</form>
<input type='button' value='Fermer' onClick='self.close()' name="button"> 
