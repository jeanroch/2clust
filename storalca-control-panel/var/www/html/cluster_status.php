<?php
include ("include/header.php");
?>

<div id="corps">

    <h1>Status général des systèmes</h1>
	<table border width=98% align=center cellpadding=10>
	<tr>

<?php
	for ($nb_server = 1; $nb_server < 3; $nb_server++)
	{
		$command = "/usr/bin/ssh apache@storalca"."$nb_server '/usr/bin/sudo /usr/local/bin/alca_host_status'";
		unset($values);
		exec($command, $values, $return_code);
		echo "
			<td><table width=100% align=center cellpadding=10>
			<tr><td colspan=2 align=center><h3>Serveur $nb_server</h3>
			";

		foreach ($values as &$param)
		{
			// check for OpenVZ status
			if (preg_match('/^OpenVZ =/', $param))
			{
				$param_value = preg_replace('/^OpenVZ =/', '', $param);
				echo "<tr><td>Systèmes virtuels<td>".$param_value;
			}

			// check for DRBD status
			if (preg_match('/^DRBD =/', $param))
			{
				$param_value = preg_replace('/^DRBD =/', '', $param);
				echo "<tr><td>Synchonisation<td>".$param_value;
			}

			// Actual CPU usage
			if (preg_match('/^Actual CPU usage =/', $param))
			{
				$param_value = preg_replace('/^Actual CPU usage =/', '', $param);
				echo "<tr><td>Utilisation CPU<td>".$param_value;
			}

			// Last hour CPU usage
			if (preg_match('/^Last hour CPU usage =/', $param))
			{
				$param_value = preg_replace('/^Last hour CPU usage =/', '', $param);
				echo "<tr><td>Moyenne CPU sur 1 heure<td>".$param_value;
			}

			// Memory usage
			if (preg_match('/^Memory usage =/', $param))
			{
				$param_value = preg_replace('/^Memory usage =/', '', $param);
				echo "<tr><td>Mémoire<td>".$param_value;
			}

			// Swap usage
			if (preg_match('/^Swap usage =/', $param))
			{
				$param_value = preg_replace('/^Swap usage =/', '', $param);
				echo "<tr><td>Swap<td>".$param_value;
			}

			// Number of process
			if (preg_match('/^Number of process =/', $param))
			{
				$param_value = preg_replace('/^Number of process =/', '', $param);
				echo "<tr><td>Nombre de process<td>".$param_value;
			}

			// CPU temperature
			if (preg_match('/^CPU temperature =/', $param))
			{
				$param_value = preg_replace('/^CPU temperature =/', '', $param);
				echo "<tr><td>Température CPU<td>".$param_value;
			}

			// Disk temperature
			if (preg_match('/^Disk temperature =/', $param))
			{
				$param_value = preg_replace('/^Disk temperature =/', '', $param);
				echo "<tr><td>Température disk<td>".$param_value;
			}

			// Disk health test
			if (preg_match('/^Disk health test =/', $param))
			{
				$param_value = preg_replace('/^Disk health test =/', '', $param);
				echo "<tr><td>Test Smart<td>".$param_value;
			}
		}
		echo "</table>";
	}
?> 

	</table>

<?php
include ("include/footer.php");
?>
