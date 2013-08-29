<?php

/* -----------------------------------
function to delete a VM
------------------------------------*/
function vm_delete($nb_server, $vm_name_to_delete)
{

	$command = escapeshellcmd("/usr/bin/ssh apache@storalca"."$nb_server '/usr/bin/sudo /usr/local/bin/alca_server_vm_delete vmname=$vm_name_to_delete'");
	unset($values);
	exec($command, $values, $return_code);
	if ($return_code != 0)
	{
		echo "<h3>Erreur : le serveur $vm_name_to_delete sur le server $nb_server n'a pas pu être détruit</h3>";
		foreach ($values as &$err_msg)
		{
			echo "$err_msg<br>";
		}
		return false;
	}
	else
	{
		echo "<h3>le serveur $vm_name_to_delete a bien été détruit</h3><br>";
		return true;
	}
}



/* -----------------------------------
Is there any data sent on the form
------------------------------------*/

if (isset($_POST['form_post']))
{
	$vm_name = $_POST['vm_name'];
	$vm_ligne = explode("§", $vm_name);

	echo '
		<table width=90% align=center cellpadding=10>
		<form action="virtual_server_delete.php" method="post">
		';
	if ($vm_ligne[3] != "")
	{
		echo "<tr><td align=center><h3>Voulez vous détruire $vm_ligne[1] et $vm_ligne[3] ?</h3>";
	}
	else
	{
		echo "<tr><td align=center><h3>Voulez vous détruire $vm_ligne[1] ?</h3>";
	}
	echo "Seul les serveurs seront détruits, les données présentes dans le volume disk associé seront toujours présentes";

	echo "
		<br><br>
		<input type=\"hidden\" name=\"vm_name_confirm\" value=\"$vm_name\">
		";
	echo '
		<tr><td align=center>
		<input type="hidden" name="form_post_confirm" value="ok">
		<input type="submit" value="Envoyer">
		</form>
		</table>
		';
	include ("include/footer.php");
	die;

}

if (isset($_POST['form_post_confirm']))
{
	$vm_name_confirm = $_POST['vm_name_confirm'];
	$vm_ligne = explode("§", $vm_name_confirm);

	if ($vm_ligne[3] != "")
	{
		vm_delete($vm_ligne[0], $vm_ligne[1]);
		vm_delete($vm_ligne[2], $vm_ligne[3]);
	}
	else
	{
		vm_delete($vm_ligne[0], $vm_ligne[1]);
	}
	include ("include/footer.php");
	die;

}

?>
