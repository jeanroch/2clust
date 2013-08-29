<?php

/* -----------------------------------
function to force SYNC disk 
------------------------------------*/
function force_sync_disk($target_server)
{

	if ($target_server == 1)
	{
		$command = escapeshellcmd("/usr/bin/ssh apache@storalca2 '/usr/bin/sudo /usr/local/bin/alca_force_sync_disk newmaster'");
		unset($values);
		exec($command, $values, $return_code);
		if ($return_code != 0)
		{
			echo "<h3>Erreur : l'action n'a pas pu être réalisé</h3>";
			foreach ($values as &$err_msg)
			{
				echo "$err_msg<br>";
			}
			return false;
		}

		$command = escapeshellcmd("/usr/bin/ssh apache@storalca1 '/usr/bin/sudo /usr/local/bin/alca_force_sync_disk deletelocal'");
		echo "<h3>La commande de synchronisation a été lancé vers le serveur 1</h3>";
	}

	elseif ($target_server == 2)
	{
		$command = escapeshellcmd("/usr/bin/ssh apache@storalca1 '/usr/bin/sudo /usr/local/bin/alca_force_sync_disk newmaster'");
		unset($values);
		exec($command, $values, $return_code);
		if ($return_code != 0)
		{
			echo "<h3>Erreur : l'action n'a pas pu être réalisé</h3>";
			foreach ($values as &$err_msg)
			{
				echo "$err_msg<br>";
			}
			return false;
		}

		$command = escapeshellcmd("/usr/bin/ssh apache@storalca2 '/usr/bin/sudo /usr/local/bin/alca_force_sync_disk deletelocal'");
		echo "<h3>La commande de synchronisation a été lancé vers le serveur 2</h3>";
	}

	else
	{
		echo "Erreur dans le programme, impossible de trouver le serveur cible</h3>";
		include ("include/footer.php");
		die;
	}
}


/* -----------------------------------
Get data sent to the form
------------------------------------*/

if (isset($_POST['target_server']))
{
	$target_server = $_POST['target_server'];

	echo '
		<table width=90% align=center cellpadding=10>
		<form action="host_server_disk_sync.php" method="post">
		';
	if ($target_server == 1)
	{
		echo "<tr><td align=center><h3>Voulez vous vraiment forcer la synchronisation <span class=\"imp\">vers le serveur 1</span> ?</h3>";
	}
	elseif ($target_server == 2)
	{
		echo "<tr><td align=center><h3>Voulez vous vraiment forcer la synchronisation <span class=\"imp\">vers le serveur 2</span> ?</h3>";
	}
	else
	{
		echo "Erreur dans le programme</h3>";
		include ("include/footer.php");
		die;
	}

	echo "
		<br>
		<input type=\"hidden\" name=\"target_server_confirm\" value=\"$target_server\">
		";
	echo '
		<tr><td align=center>
		<input type="hidden" name="form_post_action_confirm" value="ok">
		<input type="submit" value="Envoyer">
		</form>
		</table>
		';
	include ("include/footer.php");
	die;

}

if (isset($_POST['form_post_action_confirm']))
{
	if ($_POST['form_post_action_confirm'] == "ok")
	{
		$target_server_confirm = $_POST['target_server_confirm'];
		force_sync_disk($target_server_confirm);
		sleep(5);
	}
}

?>
