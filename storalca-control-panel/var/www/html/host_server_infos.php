<?php
include ("include/header.php");
include ("include/header_host_server.php");
?>

<div id="corps">

    <h1>Informations</h1>
	<table border align=center width=96% cellpadding=10>
		<tr><td><table cellpadding=15>
		<tr><td>Control Panel version<td>1.1
<?php
		$command = "/bin/cat /etc/storalca-release";
		unset($values);
		exec($command, $values, $return_code);
		echo "
			<tr><td>StorAlca Center version<td>$values[0]
			";
			// <tr><td>Numéro de serie<td>$values[1]
?>
		</table>
	</table>
	<br>
	<table border width=96% align=center cellpadding=10>
	<tr>

<?php
	for ($nb_server = 1; $nb_server < 3; $nb_server++)
	{
		$command = "/usr/bin/ssh apache@storalca"."$nb_server '/usr/bin/sudo /usr/local/bin/alca_host_hardware_infos' | /bin/awk -F'=' '{print \$NF}'";
		unset($values);
		exec($command, $values, $return_code);
		echo "
			<td><table width=100% align=center cellpadding=10>
			<tr><td colspan=2 align=center><h3>Serveur $nb_server</h3>
			<tr><td>Kernel version<td>$values[0]
			<tr><td>Modèle CPU<td>$values[1]
			<tr><td>Mémoire vive<td>$values[2]
			<tr><td>Taille du disque<td>$values[3]
			</table>
		";
	}
?> 

	</table>

<?php
include ("include/footer.php");
?>
