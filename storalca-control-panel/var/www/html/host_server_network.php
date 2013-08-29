<?php
include ("include/header.php");
include ("include/header_host_server.php");
?>

<div id="corps">

<?php
include ("function/form_host_server_network.php");
?>

    <h1>Paramètres actuels des serveurs physiques</h1>
	<table border width=98% align=center cellpadding=10>
	<tr>

<?php
	for ($nb_server = 1; $nb_server < 3; $nb_server++)
	{
		$command = "/usr/bin/ssh apache@storalca"."$nb_server '/usr/bin/sudo /usr/local/bin/alca_host_actual_network_config'";
		unset($values);
		exec($command, $values, $return_code);
		echo "
			<td><table width=100% align=center cellpadding=10>
			<tr><td colspan=2 align=center><h3>Serveur $nb_server</h3>
			<tr><td colspan=2 align=center>$values[0]
			<tr><td>Adresse IP<td>$values[1]
			<tr><td>Passerelle<td>$values[2]
			<tr><td>Masque de sous-réseaux<td>$values[3]
			<tr><td>DNS primaire<td>$values[4]
			<tr><td>DNS secondaire<td>$values[5]
			</table>
		";
	}
?> 

	</table>

	<br><br>
	<h1>Changer les paramètres</h1>
	<br>
	<form action="host_server_network.php" method="post">
	<table border width=95% align=center cellpadding=10>
	<tr><td align=center><h3>Attention !
		<br>Une mauvaise configuration peut entrainer l'inaccessibilité du serveur</h3>
		<br>Apres avoir changé la configuration votre navigateur peut être déconnecté, le serveur deviendra alors accéssible par la nouvelle adresse IP
		<br>
	<tr><td>
	<table width=100% align=center cellpadding=10>
	<tr>
	<td colspan=2 align=center>Serveur physique à changer
	<br>Un seul serveur ne peut être changé à la fois
	<br>
	<br><input name="which_server" type="radio" value="storalca1">Serveur 1
	<br><input name="which_server" type="radio" value="storalca2">Serveur 2
	<br>
	<br>
	<tr>
	<td>Type de configuration réseaux
	<td><input name="dhcp_or_static" type="radio" value="dhcp">DHCP
	<br><input name="dhcp_or_static" type="radio" value="static">Adresse IP fixe (conseillé)
	<tr>
	<td>Adresse IP
	<td><input name="new_server_ip" size=20>
	<tr>
	<td>Passerelle
	<td><input name="new_gateway" size=20>
	<tr>
	<td>Masque de sous-réseaux
	<td><input name="new_netmask" size=20>
	<tr>
	<td>DNS primaire
	<td><input name="new_dns1" size=20>
	<tr>
	<td>DNS secondaire
	<td><input name="new_dns2" size=20>
	<tr>
	<td colspan=2 align=center>
		<input type="hidden" name="form_post" value="ok">
		<input type="submit" value="Envoyer">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset">
	
	</table>
	</table>
	

<?php
include ("include/footer.php");
?>
