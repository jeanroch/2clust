<?php
/* -----------------------------------
Is there any data sent on the form
------------------------------------*/

if (isset($_POST['form_post']))
{
	$lv_name_brut = $_POST['lv_name'];
	$lv_size = $_POST['lv_size'];
	$lv_unit = $_POST['lv_unit'];

	/* -----------------------------------
	Test the parameters
	------------------------------------*/

	if ($lv_name_brut == "")
	{
		echo "<h3>Erreur : Il faut préciser le nom du volume</h3>";
		include ("include/footer.php");
		die;
	}
	elseif ($lv_size == "")
	{
		echo "<h3>Erreur : Il faut préciser la taille du volume</h3>";
		include ("include/footer.php");
		die;
	}

	$lv_name = str_replace(" ", "_", $lv_name_brut);

	$command = escapeshellcmd("/usr/bin/sudo /usr/local/bin/alca_disk_create_lv lvname=$lv_name lvsize=$lv_size"."$lv_unit");
	unset($values);
	exec($command, $values, $return_code);
	if ($return_code != 0)
	{
		echo "<h3>Erreur : le volume $lv_name n'a pas été créée</h3>";
		foreach ($values as &$err_msg)
		{
			echo "$err_msg<br>";
		}
		include ("include/footer.php");
		die;
	}
	else
	{
		$command = "/usr/bin/sudo /usr/local/bin/alca_disk_activate_lv";
		exec($command, $values, $return_code);
		echo "<h3>Le volume $lv_name a bien été créée</h3><br>";
	}
}
?>
