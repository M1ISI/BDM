<html>
<head>
<title>Nous contacter</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>

<?php
	/* envoi de mail */ 
	include("envoi_mail.php") 
?>

<p>Pour faire un retour aux développeurs vous pouvez créer une issue directement sur <a href="https://github.com/M1ISI/BDM/issues" target=_blank>notre page github</a> ou nous envoyer un message via le formulaire ci-dessous.</p>

<!-- formulaire de contact -->
<form action="index.php" method="post" enctype="multipart/form-data">
	<table border="0" valign="top">
		<tr valign="top">
			<td width="100">
				Votre adresse mail* : 
			</td>
			<td>
				<input type="text" name="mail" id="mail" />
			</td>
		<tr valign="top">
			<td width="100">Type* :</td>
			<td>
				<input type="radio" name="type" value="bug" id="bug" /> <label for="bug">J'ai rencontré un bug.</label>
				<br/>
				<input type="radio" name="type" value="question" id="question" /> <label for="question">J'ai une question à propos de l'application.</label><br/>
				<input type="radio" name="type" value="remarque/suggestion" id="rmq" /> <label for="bug">J'ai une remarque ou une suggestion au sujet de l'application.</label><br/>
				<input type="radio" name="type" value="autre" id="autre" /> <label for="bug">Autre.</label><br/>
			</td>
		</tr>
		<tr valign="top">
			<td width="100">Objet* :</td>
			<td>
				<input type="text" name="object" width="400"/><br/>
			</td>
		</tr>
		<tr valign="top">
			<td>Message* :</td>
			<td>
				<textarea name="message" rows="8" cols="65" /></textarea><br/>
			</td>
		</tr><tr valign="top">
			<td>Joindre une image : <br/>
				(taille maximale : 5Mo ) </td>
			<td>
				<input type="hidden" name="MAX_FILE_SIZE" value="5242880" /> <!-- taille max du fichier = 5Mo (5*2^20) -->
				<input type="file" name="image" id="img" /><br/>
			</td>
		</tr>
		<tr valign="top"><td colspan="2">
			<p>Les champs marqués d'une * sont obligatoires.</p>
			<input type="hidden" name="antiSpam" /> <!-- ce champs restera vide si c'est un humain qui envoie le massage -->
			<input type="submit" name="envoi" value="envoyer" />
		</td></tr>
	</table>
</form>
<p><a href="../index.php">Retour à la page d'accueil.</a>
</body>
</html>
