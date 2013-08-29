<?php

/* -----------------------------------
function to halt/reboot an host machine
------------------------------------*/
function host_reboot($nb_server, $action)
{

	$command = escapeshellcmd("/usr/bin/ssh apache@storalca"."$nb_server '/usr/bin/sudo /usr/local/bin/alca_host_reboot action=$action'");
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
}


/* -----------------------------------
Is there any data sent on the form reboot
------------------------------------*/

if (isset($_POST['form_post_action']))
{
	$action_infos = $_POST['action_server'];
	$action_infos_array = explode("§", $action_infos);

	echo '
		<table width=90% align=center cellpadding=10>
		<form action="host_server_config.php" method="post">
		';
	if ($action_infos_array[0] == "halt")
	{
		echo "<tr><td align=center><h3>Voulez vous vraiment <span class=\"imp\">arrêter le serveur $action_infos_array[1]</span> ?</h3>";
	}
	elseif ($action_infos_array[0] == "reboot")
	{
		echo "<tr><td align=center><h3>Voulez vous vraiment <span class=\"imp\">redémarrer le serveur $action_infos_array[1]</span> ?</h3>";
	}
	else
	{
		echo "Erreur dans la commande</h3>";
		include ("include/footer.php");
		die;
	}

	echo "
		<br>
		<input type=\"hidden\" name=\"action_confirm\" value=\"$action_infos_array[0]\">
		<input type=\"hidden\" name=\"nb_server_confirm\" value=\"$action_infos_array[1]\">
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
	$action_confirm = $_POST['action_confirm'];
	$nb_server_confirm = $_POST['nb_server_confirm'];

	host_reboot($nb_server_confirm, $action_confirm);

	sleep(10);
}

/* -----------------------------------
Is there any data sent on the form passwd
------------------------------------*/

if (isset($_POST['form_post_passwd']))
{

	// Get the passwd
	$new_passwd = $_POST['new_passwd'];

	// Test the passwd
        if (strlen($new_passwd) < 8)
        {
                echo "<h3>Erreur: Le mot de passe doit faire 8 caractères, seulement des lettres et des chiffres</h3>";
                include ("include/footer.php");
                die;
        }

        // Send the command
        for ($nb = 1; $nb < 3; $nb++)
        {
                $command = "/usr/bin/ssh apache@storalca"."$nb \"/usr/bin/sudo /usr/bin/htpasswd -b /etc/httpd/conf/passwd-alca admin '$new_passwd'\"";
                unset($values);
                exec($command, $values, $return_code);
                if ($return_code != 0)
                {
                        echo "<h3>Erreur : Le mot de passe n'a pas pu être changé sur le serveur $nb</h3>";
                        foreach ($values as &$err_msg)
                        {
                                echo "$err_msg<br>";
                        }
                        include ("include/footer.php");
                        die;
                }
		else
		{
			echo "<h3>Le mot de passe a bien été changé sur le serveur $nb</h3>";
		}
        }

}

?>
