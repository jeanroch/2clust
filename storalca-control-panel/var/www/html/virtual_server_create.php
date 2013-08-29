<?php
include ("include/header.php");
include ("include/header_virtual_server.php");
include ("function/function_form.php");
?>

<div id="corps">

<?php
include ("function/form_virtual_server_create.php");
?>

	<h1>Créer un serveur virtuel</h4>
	<br>
	<form action="virtual_server_create.php" method="post">
	<table border width=100% align=center cellpadding=10>
	<tr><td>
	<table width=100% align=center cellpadding=10>
	<tr>
	<td>Nom du serveur
	<td><input name="server_name" size=40>
	<tr>
	<td>Adresse IP sur le serveur 1
	<td><input name="server_ip_1" size=17>
	<tr>
	<td>Adresse IP sur le serveur 2
	<td><input name="server_ip_2" size=17>
	<tr>
<?php
/*----------------------------------------------------------
	<td>Adresse IP principale
	<br>par lequel le service est accédé
	<td><input name="server_ip_lvs" size=17>
	<tr>
	<td>Services 
	<td>
		<table>
		<tr><td><input name="server_service" type="checkbox" value="nfs">NAS : Partage NFS pour MacOS X
		<tr><td><input name="server_service" type="checkbox" value="cifs">NAS : Partage Réseaux Windows
		<tr><td><input name="server_service" type="checkbox" value="apache">Serveur web Apache
		<tr><td><input name="server_service" type="checkbox" value="postfix">Serveur e-mail Postfix
		</table>
----------------------------------------------------------*/
?>
	<tr>
	<td>Système à utiliser
	<td><select name="server_template">
<?php
	display_htmlmenu_template();
?>
	<tr>
	<td>Disque virtuel associé
	<td><select name="server_lv">

<?php
	display_htmlmenu_lv();
?>
	<tr>
	<td>Mot de passe root
	<td><input type="password" name="rootpasswd" size=20>
	<tr>
	<td colspan=2 align=center>
		<input type="hidden" name="form_post" value="ok">
		<input type="submit" value="Envoyer">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset">
	</table>
	</table>

<?php
include ("include/footer.php");
?>
