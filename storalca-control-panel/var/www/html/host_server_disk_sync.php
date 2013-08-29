<?php
include ("include/header.php");
include ("include/header_host_server.php");
?>

<div id="corps">

<?php
include ("function/form_host_server_disk_sync.php");
?>


<h1>Réplication des disques entre les serveurs physiques</h1>
<br>
<table border width=95% align=center cellpadding=10>
<tr><td align=center>Attention !
<br>il est possible de forcer la synchronisation de toutes les données (en dehors des serveurs virtuels) d'un disque dur à l'autre
<br>cette action éffacera les données présentes sur le disque cible
<tr><td>
	<form action="host_server_disk_sync.php" method="post">
	<table width=100% align=center cellpadding=10 border>
	<tr>
	<td width=50%>Les données du serveur 2 seront écrasés par le serveur 1
	<td width=40%><input name="target_server" type="radio" value="2"> Serveur 1 => Serveur 2
	<td rowspan=2 width=10%><input type="submit" value="Envoyer">
	<br><br>
	<input type="reset">
	<tr>
	<td>Les données du serveur 1 seront écrasés par le serveur 2
	<td><input name="target_server" type="radio" value="1"> Serveur 2 => Serveur 1
	</table>
	</form>
</table>

<?php
include ("include/footer.php");
?>
