<?php
/* -----------------------------------
Is there any data sent on the form
------------------------------------*/

if (isset($_POST['form_post']))
{

	$which_server = $_POST['which_server'];
	$dhcp_or_static = $_POST['dhcp_or_static'];
	$new_server_ip = $_POST['new_server_ip'];
	$new_gateway = $_POST['new_gateway'];
	$new_netmask = $_POST['new_netmask'];
	$new_dns1 = $_POST['new_dns1'];
	$new_dns2 = $_POST['new_dns2'];

	/* -----------------------------------
	Test the parameters
	------------------------------------*/

	if (!isset($which_server))
	{
		echo "<h3>Erreur : Il faut préciser le serveur physique à configurer, serveur 1 ou serveur 2</h3>";
		include ("include/footer.php");
		die;
	}

	if ($dhcp_or_static == "dhcp")
	{
		$command = "/usr/bin/ssh apache@"."$which_server '/usr/bin/sudo /usr/local/bin/alca_host_change_network_dhcp'";
		unset($values);
		exec($command, $values, $return_code);
		if ($return_code != 0)
		{
			echo "<h3>Erreur : la configuration n'a pas été modifié</h3>";
			foreach ($values as &$err_msg)
			{
				echo "$err_msg<br>";
			}
			include ("include/footer.php");
			die;
		}
		else
		{
			echo "<h3>La nouvelle configuration a bien été changé</h3><br>";
		}
	}
	elseif ($dhcp_or_static == "static")
	{
		if ($new_dns2 != "")
		{
			$command = escapeshellcmd("/usr/bin/ssh apache@"."$which_server '/usr/bin/sudo /usr/local/bin/alca_host_change_network_static_ip ipaddr=$new_server_ip gateway=$new_gateway netmask=$new_netmask dns1=$new_dns1 dns2=$new_dns2'");
		}
		else
		{
			$command = escapeshellcmd("/usr/bin/ssh apache@"."$which_server '/usr/bin/sudo /usr/local/bin/alca_host_change_network_static_ip ipaddr=$new_server_ip gateway=$new_gateway netmask=$new_netmask dns1=$new_dns1'");
		}
		unset($values);
		exec($command, $values, $return_code);
		if ($return_code != 0)
		{
			echo "<h3>Erreur : la configuration n'a pas été modifié</h3>";
			foreach ($values as &$err_msg)
			{
				echo "$err_msg<br>";
			}
			include ("include/footer.php");
			die;
		}
		else
		{
			echo "<h3>La nouvelle configuration a bien été changé</h3><br>";
		}
	}
	else
	{
		echo "<h3>Erreur : Il faut préciser DHCP ou Adresse IP fixe</h3>";
		include ("include/footer.php");
		die;
	}

}
?>
