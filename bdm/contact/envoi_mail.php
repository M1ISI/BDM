<?php

	if(isset($_POST['envoi']) && isset($_POST['type']) && isset($_POST['object']) && isset($_POST['message']) && empty($_POST['antiSpam']) && isset($_POST['mail']))
	{
		$type = $_POST['type'];
		$object = $_POST['object'];
		$message = $_POST['message'];
		$mail_exp = $_POST['mail'];
		
		$mail_dest = 'bdmisi@aius.u-strasbg.fr'; // Déclaration de l'adresse de destination.
		
		if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail_dest)) // On filtre les serveurs qui présentent des bugs.
			$passage_ligne = "\r\n";
		else
			$passage_ligne = "\n";
		
		//=====Déclaration du message au format texte.
		$message_txt = "Ceci est un message envoyé par un bêta-testeur.".$passage_ligne.
						$passage_ligne.
						"Catégorie : ".$type.$passage_ligne.
						"Objet : ".$object.$passage_ligne.
						$passage_ligne.
						"Message : ".$passage_ligne.
						$message.$passage_ligne;
		//==========
		
		 
		//=====Création de la boundary.
		$boundary = "-----=".md5(rand());
		$boundary_alt = "-----=".md5(rand());
		//==========
		 
		//=====Définition du sujet.
		$sujet = "[Beta][".$type."] ".$object;
		//=========
		 
		//=====Création du header de l'e-mail.
		$header = "From: \"Bêta-testeur\"<".$mail_exp.">".$passage_ligne; // pour le moment on envoie avec l'adresse de destination
		$header.= "Reply-to: ".$mail_dest.$passage_ligne;
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
		
		
		//=====Traitement d'une hypothétique pièce jointe
		if(isset($_FILES['image']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE)
		{
			$image = $_FILES['image'];
			//=====Teste si l'image a été correctement uploadée
			if ($image['error'] > 0) 
			{
				echo("<p>Erreur lors du chargement de l'image pour la raison suivante : <br/>");
				if ($image['error'] == UPLOAD_ERR_NO_FILE) 
					echo "Le fichier n'existe pas.";
				else if ($image['error'] == UPLOAD_ERR_INI_SIZE || $image['error'] == UPLOAD_ERR_FORM_SIZE) 
					echo "La taille du fichier est trop grande (5Mo maximum).";
				else if ($image['error'] == UPLOAD_ERR_PARTIAL) 
					echo "Le fichier n'a été que partiellement transféré.";
				else
					echo "Erreur inconnue.";
				echo "</p>";
			}
			//=====Teste si l'image correspond à ce qui est attendu
			else 
			{
				//=====Teste l'extension
				$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png', 'bmp' );
				$extension_upload = strtolower(  substr(  strrchr($_FILES['image']['name'], '.')  ,1)  );
				if ( !in_array($extension_upload,$extensions_valides) ) 
					echo "<p>L'image n'a pas été jointe au message car son extension n'est pas prise en compte. Seules les extensions .jpg, .jpeg, .gif, .png et .bmp sont acceptées.</p>";
				//=====Teste la taille de l'image
				else if ($image['size'] > 5242880 ) 
					echo "<p>L'image n'a pas été jointe au message car trop lourde (5Mo maximum).</p>";
				//=====L'image est bonne et peut être envoyée
				else 
				{
					//=====Lecture et mise en forme de la pièce jointe.
					$img = $image['tmp_name'];
					$fichier   = fopen($img, "r");
					$attachement = fread($fichier, filesize($img));
					$attachement = chunk_split(base64_encode($attachement));
					fclose($fichier);
					//==========
					
					$message_mail.= $passage_ligne."--".$boundary.$passage_ligne;
					
					//=====Ajout de la pièce jointe.
					$message_mail.= "Content-Type: ".$_FILES['image']['type']."; name=\"".$_FILES['image']['name']."\"".$passage_ligne;
					$message_mail.= "Content-Transfer-Encoding: base64".$passage_ligne;
					$message_mail.= "Content-Disposition: attachment; filename=\"".$_FILES['image']['name']."\"".$passage_ligne;
					$message_mail.= $passage_ligne.$attachement.$passage_ligne.$passage_ligne;
					$message_mail.= $passage_ligne."--".$boundary."--".$passage_ligne; 
					//========== 
				}
			}
		}
		
		//=====Envoi de l'e-mail.
		mail($mail_dest,$sujet,$message_mail,$header);
		echo "<p>Message envoyé.</p>";
		 
		//==========
	}
?>
