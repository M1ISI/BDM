<?php

	if(isset($_POST['envoi']) && isset($_POST['type']) && isset($_POST['object']) && isset($_POST['message']) && empty($_POST['antiSpam']))
	{
		$type = htmlspecialchars($_POST['type']);
		$object = htmlspecialchars($_POST['object']);
		$message = htmlspecialchars($_POST['message']);
		
		$mail = 'vickie.marchal@gmail.com'; // Déclaration de l'adresse de destination.
		
		if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui présentent des bogues.
		{
			$passage_ligne = "\r\n";
		}
		else
		{
			$passage_ligne = "\n";
		}
		
		//=====Déclaration du message au format texte.
		$message_txt = "Ceci est un message envoyé par un bêta-testeur.\n
						\n
						Catégorie : ".$type."\n
						Objet : ".$object."\n
						\n
						Message : \n
						".$message."\n";
		//==========
		 
		/* TODO : pouvoir joindre une image?
		//=====Lecture et mise en forme de la pièce jointe.
		$img = "image.jpg";
		$fichier   = fopen($img, "r");
		$attachement = fread($fichier, filesize($img));
		$attachement = chunk_split(base64_encode($attachement));
		fclose($fichier);
		//==========
		*
		*/
		 
		//=====Création de la boundary.
		$boundary = "-----=".md5(rand());
		$boundary_alt = "-----=".md5(rand());
		//==========
		 
		//=====Définition du sujet.
		$sujet = "[".$type."] ".$object;
		//=========
		 
		//=====Création du header de l'e-mail.
		$header = "From: \"Bêta-testeur\"<".$mail.">".$passage_ligne; // pour le moment on envoie avec l'adresse de destination
		$header.= "MIME-Version: 1.0".$passage_ligne;
		$header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
		//==========
		 
		//=====Création du message.
		$message_mail = $passage_ligne."--".$boundary.$passage_ligne;
		$message_mail.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
		$message_mail.= $passage_ligne."--".$boundary_alt.$passage_ligne;
		//=====Ajout du message au format texte.
		$message_mail.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
		$message_mail.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
		$message_mail.= $passage_ligne.$message_txt.$passage_ligne;
		//==========
		 
		//=====On ferme la boundary alternative.
		$message_mail.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
		//==========
		 
		 
		/* 
		$message_mail.= $passage_ligne."--".$boundary.$passage_ligne;
		 
		//=====Ajout de la pièce jointe.
		$message_mail.= "Content-Type: image/jpeg; name=\"image.jpg\"".$passage_ligne;
		$message_mail.= "Content-Transfer-Encoding: base64".$passage_ligne;
		$message_mail.= "Content-Disposition: attachment; filename=\"image.jpg\"".$passage_ligne;
		$message_mail.= $passage_ligne.$attachement.$passage_ligne.$passage_ligne;
		$message_mail.= $passage_ligne."--".$boundary."--".$passage_ligne; 
		//========== 
		 
		*/ 
		
		//=====Envoi de l'e-mail.
		mail($mail,$sujet,$message_mail,$header);
		echo "Message envoyé";
		 
		//==========
	}
?>
