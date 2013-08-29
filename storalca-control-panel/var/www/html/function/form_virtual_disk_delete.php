<?php
/* -----------------------------------
Is there any data sent on the form
------------------------------------*/

if (isset($_POST['form_post']))
{
	$lv_name = $_POST['lv_name'];

	echo '
		<table width=90% align=center cellpadding=10>
		<form action="virtual_disk_delete.php" method="post">';
	echo "<tr><td align=center><h3>Voulez vous détruire le volume $lv_name ?</h3>";
	echo "Attention les données présentes seront complètements éffacées";

	echo '
		<br><br>
		<input type="hidden" name="lv_name_confirm" value="';

	echo "$lv_name";
	echo '">
		<tr><td align=center>
		<input type="hidden" name="form_post_confirm" value="ok">
		<input type="submit" value="Envoyer">
		</form>
		</table>';

	include ("include/footer.php");
	die;

}

if (isset($_POST['form_post_confirm']))
{
	$lv_name_confirm = $_POST['lv_name_confirm'];

	$command = escapeshellcmd("/usr/bin/sudo /usr/local/bin/alca_disk_delete_lv lvname=$lv_name_confirm");
	unset($values);
	exec($command, $values, $return_code);
	if ($return_code != 0)
	{
		echo "<h3>Erreur: le volume $lv_name_confirm n'a pas été détruit</h3>";
		foreach ($values as &$err_msg)
		{
			echo "$err_msg<br>";
		}
		include ("include/footer.php");
		die;
	}
	else
	{
		echo "<h3>Le volume $lv_name_confirm a bien été détruit</h3><br>";
	}
	include ("include/footer.php");
	die;
}

?>
