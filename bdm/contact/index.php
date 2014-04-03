<?php
	/* envoi de mail */ 
	include("envoi_mail.php") 
?>

<!-- formulaire de contact -->
<form action="index.php" method="post">
	<table border="0" valign="top">
		<tr valign="top">
			<td width="100">Type :</td>
			<td>
				<input type="radio" name="type" value="bug" id="bug" /> <label for="bug">J'ai rencontré un bug.</label>
				<br/>
				<input type="radio" name="type" value="problème" id="pb" /> <label for="pb">J'ai un problème d'utilisation ou je ne comprend pas comment utiliser l'application.</label><br/>
				<input type="radio" name="type" value="remarque/suggestion" id="rmq" /> <label for="bug">J'ai une remarque ou une suggestion au sujet de l'application.</label><br/>
				<input type="radio" name="type" value="autre" id="autre" /> <label for="bug">Autre.</label><br/>
			</td>
		</tr>
		<tr valign="top">
			<td width="100">Objet :</td>
			<td>
				<input type="text" name="object" width="400"/><br/>
			</td>
		</tr>
		<tr valign="top">
			<td>Message :</td>
			<td>
				<textarea name="message" rows="8" cols="65" /></textarea><br/>
			</td>
		</tr>
		<tr valign="top"><td colspan="2">
			<input type="hidden" name="antiSpam" /> <!-- ce champs restera vide si c'est un humain qui envoie le massage -->
			<input type="submit" name="envoi" value="envoyer" />
		</td></tr>
	</table>
</form>
