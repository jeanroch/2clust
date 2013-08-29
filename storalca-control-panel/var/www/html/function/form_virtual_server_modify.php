<?php

/* -----------------------------------
functions
------------------------------------*/

function vm_modify($nb_server, $vm_oldname, $command_params, $server_ip)
{

	// add the oldname of the VM
	$command_params = "$command_params"." oldname=$vm_oldname";

	// add the IP address
	if ($server_ip != "")
	{
		$command_params = "$command_params"." ipaddr=$server_ip";
	}

	$command = escapeshellcmd("/usr/bin/ssh apache@storalca"."$nb_server '/usr/bin/sudo /usr/local/bin/alca_server_vm_modify $command_params'");
	unset($values);
	exec($command, $values, $return_code);
	if ($return_code != 0)
	{
		echo "<h3>Erreur : $vm_oldname n'a pas pu être modifié </h3>";
		foreach ($values as &$err_msg)
		{
			echo "$err_msg<br>";
		}
		include ("include/footer.php");
		die;
	}
	else
	{
		echo "<h3>Le serveur virtuel $vm_oldname a bien été modifié</h3>";
		foreach ($values as &$log_msg)
		{
			echo "$log_msg<br>";
		}
	}
}

function give_newname($nb_server, $server_newname_brut)
{
	$server_newname = str_replace(" ", "_", $server_newname_brut);
	$newname = "$server_newname"."$nb_server";
	return $newname;
}


/* -----------------------------------
Is there any data sent on the form
------------------------------------*/

if (isset($_POST['form_post']))
{
	$server_oldname = $_POST['server_oldname'];
	$server_newname_brut = $_POST['server_newname'];
	$server_ip_1 = $_POST['server_ip_1'];
	$server_ip_2 = $_POST['server_ip_2'];
	$server_lv = $_POST['server_lv'];

	/* -----------------------------------
	Test the parameters
	------------------------------------*/

	if ( ($server_ip_1 != "" AND $server_ip_2 == "") OR ($server_ip_1 == "" AND $server_ip_2 != "") )
	{
		echo "<h3>Erreur: Il faut remplir les deux adresses IP</h3>";
		include ("include/footer.php");
		die;
	}

	if ($server_oldname == "")
	{
		echo "<h3>Erreur: Il faut donner the nom du serveur</h3>";
		include ("include/footer.php");
		die;
	}


	/* -----------------------------------
	build the command options
	------------------------------------*/

	// init the parameters
	$all_parameters = "";

	// add the volume disk
	if ($server_lv != "")
	{
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
			elseif ($nb == 2)
			{
				$all_parameters = "$all_parameters"." devnodes=$server_lv";
			}
		}
	}


	/* -----------------------------------
	Send the command to both server
	------------------------------------*/

	$server_name_param = explode("§", $server_oldname);
	if ($server_name_param[2] != "")
	{
		if ($server_newname_brut != "")
		{
			// for server 1
			$server_newname1 = give_newname($server_name_param[0], $server_newname_brut);
			$all_parameters1 = "$all_parameters"." newname=$server_newname1";

			// for server 2
			$server_newname2 = give_newname($server_name_param[2], $server_newname_brut);
			$all_parameters2 = "$all_parameters"." newname=$server_newname2";
		}
		else
		{
			$all_parameters1 = $all_parameters;
			$all_parameters2 = $all_parameters;
		}

		vm_modify($server_name_param[0], $server_name_param[1], $all_parameters1, $server_ip_1);
		vm_modify($server_name_param[2], $server_name_param[3], $all_parameters2, $server_ip_2);
		
	}
	else
	{
		if ($server_newname_brut != "")
		{
			$server_newname = give_newname($server_name_param[0], $server_newname_brut);
			$all_parameters = "$all_parameters"." newname=$server_newname";
		}

		if ($server_name_param[0] == "1")
		{
			vm_modify($server_name_param[0], $server_name_param[1], $all_parameters, $server_ip_1);
		}
		elseif ($server_name_param[0] == "2")
		{
			vm_modify($server_name_param[0], $server_name_param[1], $all_parameters, $server_ip_2);
		}

	}
}
?>
