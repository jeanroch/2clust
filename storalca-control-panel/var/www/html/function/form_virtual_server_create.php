<?php
/* -----------------------------------
Is there any data sent on the form
------------------------------------*/

if (isset($_POST['form_post']))
{
	$server_name_brut = $_POST['server_name'];
	$server_ip_1 = $_POST['server_ip_1'];
	$server_ip_2 = $_POST['server_ip_2'];
	//$server_ip_lvs = $_POST['server_ip_lvs'];
	$server_template = $_POST['server_template'];
	//$server_service = $_POST['server_service'];
	$server_lv = $_POST['server_lv'];
	$rootpasswd = $_POST['rootpasswd'];

	/* -----------------------------------
	Test the parameters
	------------------------------------*/

	if ($server_name_brut == "" OR $server_ip_1 == "" OR $server_ip_2 == "" OR $server_template == "" OR $server_lv == "")
	{
		echo "<h3>Erreur: Il faut remplir tous les champs</h3>";
		include ("include/footer.php");
		die;
	}

	if (strlen($rootpasswd) < 8)
	{
		echo "<h3>Erreur: Le mot de passe doit faire 8 caractères, seulement des lettres et des chiffres</h3>";
		include ("include/footer.php");
		die;
	}

	// Test if the volume is free
	for ($nb = 1; $nb < 3; $nb++)
	{
		// test if the volume is free
		$command = "/usr/bin/ssh apache@storalca"."$nb '/usr/bin/sudo /usr/local/bin/alca_disk_unused_lv | /bin/grep ^$server_lv$'";
		unset($values);
		exec($command, $values, $return_code);
		if ($return_code != 0)
		{
			echo "<h3>Erreur : Le volume $server_lv est déjà utilisé par un autre serveur virtuel</h3>";
			foreach ($values as &$err_msg)
			{
				echo "$err_msg<br>";
			}
			include ("include/footer.php");
			die;
		}
	}

	$server_name = str_replace(" ", "_", $server_name_brut);

	/* -----------------------------------
	Send the command to both server
	------------------------------------*/

	for ($nb_server = 1; $nb_server < 3; $nb_server++)
	{
		if ($nb_server == 1)
		{
			$server_ip = $server_ip_1;
		}
		elseif ($nb_server == 2)
		{
			$server_ip = $server_ip_2;
		}
		else
		{
			echo "<h3>Problème avec les paramètres</h3>";
			include ("include/footer.php");
			die;
		}

		$vmname = "$server_name"."$nb_server";

		$command = escapeshellcmd("/usr/bin/ssh apache@storalca"."$nb_server '/usr/bin/sudo /usr/local/bin/alca_server_vm_create vmname=$vmname ipaddr=$server_ip ostemplate=$server_template devnodes=$server_lv rootpasswd=$rootpasswd'");
		unset($values);
		exec($command, $values, $return_code);
		if ($return_code != 0)
		{
			echo "<h3>Erreur : $server_name"."$nb_server n'a pas pu être créée sur le serveur $nb_server </h3>";
			foreach ($values as &$err_msg)
			{
				echo "$err_msg<br>";
			}
			include ("include/footer.php");
			die;
		}
		else
		{
			echo "<h3>Le serveur virtuel $server_name"."$nb_server a bien été créée sur le serveur $nb_server</h3>";
			foreach ($values as &$log_msg)
			{
				echo "$log_msg<br>";
			}
		}
	}
}
?>
