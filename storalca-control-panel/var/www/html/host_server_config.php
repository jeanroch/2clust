<?php
include ("include/header.php");
include ("include/header_host_server.php");
?>

<div id="corps">

<?php
include ("function/form_host_server_config.php");
?>


<h1>Configuration sur les serveurs physiques</h1>
<br>
<table border width=95% align=center cellpadding=10>
<tr><td align=center>Attention !
<br>tous les serveurs virtuels seront arrêtés ou redémarrés avec la machine physique
<tr><td>
	<form action="host_server_config.php" method="post">
	<table width=100% align=center cellpadding=10>
	<tr>
	<td>Arrêter
	<td><input name="action_server" type="radio" value="halt§1"> Serveur 1
	<td><input name="action_server" type="radio" value="halt§2"> Serveur 2
	<td rowspan=2><input type="hidden" name="form_post_action" value="ok">
	<input type="submit" value="Envoyer">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset">
	<tr>
	<td>Redémarrer
	<td><input name="action_server" type="radio" value="reboot§1"> Serveur 1
	<td><input name="action_server" type="radio" value="reboot§2"> Serveur 2
	</table>
	</form>
<tr><td>
	<form action="host_server_config.php" method="post">
	<table width=100% align=center cellpadding=15>
	<tr>
	<td>Changer le mot de passe
		<br>de l'utilisateur admin
		<br>pour le Control Panel
	<td colspan=2><input type="password" name="new_passwd" size=20>
	<td><input type="hidden" name="form_post_passwd" value="ok">
	<input type="submit" value="Envoyer">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset">
	</table>
	</form>
</table>

<?php
include ("include/footer.php");
?>
