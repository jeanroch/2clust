<?php

/* -----------------------------------
function to display the status of the VM
------------------------------------*/
function show_vm_status()
{
	echo '
		<table border width=96% align=center cellpadding=10>
		<tr><td>
		<table width=100% align=center cellpadding=10>
		<tr>
		<td>Nom
		<td>Hôte
		<td>Adresse IP
		<td>Status
		<td>Volume disk
		<td>Process
		';

	for ($nb_server = 1; $nb_server < 3; $nb_server++)
	{
		$command = "/usr/bin/ssh apache@storalca"."$nb_server '/usr/bin/sudo /usr/local/bin/alca_server_vm_status'";
		unset($values);
		exec($command, $values, $return_code);
		for ($i = 0; $i < count($values); $i++)
		{
			$result = explode(" ", $values[$i]);
			echo "
			<tr>
			";

			if ($result[2] == "running")
			{
				echo "<td><a href=\"https://$result[3]:10000\" target=\"_blank\">$result[4]</a>";
			}
			else
			{
				echo "<td>$result[4]";
			}

			echo "
			<td>serveur $nb_server
			<td>$result[3]
			<td>$result[2]
			<td>$result[5]
			<td>$result[1]
			";
		}
	}

	echo '
		</table>
		</table>
		<br>
		';
}

/* -----------------------------------
function to change the VM status
------------------------------------*/
function modify_vm_status()
{
	echo '
		<table border width=96% align=center cellpadding=10>
		<tr><td>
		<table width=90% align=center cellpadding=10>
		<tr>
		<td>
		<td>
		<td>
		<td>
		<td>
		';

	for ($nb_server = 1; $nb_server < 3; $nb_server++)
	{
		$command = "/usr/bin/ssh apache@storalca"."$nb_server '/usr/bin/sudo /usr/local/bin/alca_server_vm_status'";
		unset($values);
		exec($command, $values, $return_code);
		for ($i = 0; $i < count($values); $i++)
		{
			$result = explode(" ", $values[$i]);
			echo "
			<tr>
			<td>$result[4]
			";

			if ($result[2] == "running")
			{
				echo "
					<td><a href=\"https://$result[3]:10000\" target=\"_blank\">configurer</a>
					<td><a href=\"../virtual_server_vm_start-stop.php?action=stop&vm=$result[4]\">Arrêter</a>
					<td>
					<td>$result[2]
					";
			}
			else
			{
				echo "
					<td>
					<td>
					<td><a href=\"../virtual_server_vm_start-stop.php?action=start&vm=$result[4]\">Démarrer</a>
					<td>$result[2]
					";
			}
		}
	}

	echo '
		</table>
		</table>
		<br>
		';
}
