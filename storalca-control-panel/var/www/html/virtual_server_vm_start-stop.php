<?php

/* -----------------------------------
functions
------------------------------------*/

function vm_action($action, $nb_server, $vm_ctid)
{
	if ($action == "start" OR $action == "stop" OR $action == "restart")
	{
		$command = "/usr/bin/ssh apache@storalca"."$nb_server '/usr/bin/sudo /usr/sbin/vzctl $action $vm_ctid'";
		unset($values);
		exec($command, $values, $return_code);
		if ($return_code != 0)
		{
			include ("include/header.php");
			include ("include/header_virtual_server.php");
			echo '<div id="corps"><br>';
			echo "<h3>Erreur : action non réalisé</h3>";
			foreach ($values as &$err_msg)
			{
				echo "$err_msg<br>";
			}
			include ("include/footer.php");
			die;
		}
	}
	else
	{
		include ("include/header.php");
		include ("include/header_virtual_server.php");
		echo '<div id="corps"><br>';
		echo "<h3>Erreur : action non réalisé</h3>";
		include ("include/footer.php");
		die;
	}
}


/* -----------------------------------
Get the vm to stop
------------------------------------*/
$vm_name = $_GET['vm'];
$action = $_GET['action'];


/* ---------------------------------
Get the CTID of the VM
------------------------------------*/

$command = "/usr/bin/sudo /usr/local/bin/alca_server_vm_list | /bin/grep -E ' $vm_name | $vm_name$'";
unset($values);
exec($command, $values, $return_code);
if ($return_code != 0)
{
	include ("include/header.php");
	include ("include/header_virtual_server.php");
	echo '<div id="corps"><br>';
	echo "<h3>Erreur : action non réalisé</h3>";
	foreach ($values as &$err_msg)
	{
		echo "$err_msg<br>";
	}
	include ("include/footer.php");
	die;
}

$vm_list = explode(" ", $values[0]);

if ($vm_list[2] == $vm_name)
{
	$nb_server = $vm_list[0];
	$vm_ctid = $vm_list[1];
	vm_action($action, $nb_server, $vm_ctid);
}
elseif ($vm_list[5] == $vm_name)
{
	$nb_server = $vm_list[3];
	$vm_ctid = $vm_list[4];
	vm_action($action, $nb_server, $vm_ctid);
}
else
{	
	include ("include/header.php");
	include ("include/header_virtual_server.php");
	echo '<div id="corps"><br>';
	echo "<h3>Erreur : action non réalisé</h3>";
	include ("include/footer.php");
	die;
}

// Redirect to the VM configuration page
header('Location: virtual_server_config.php');

?>

