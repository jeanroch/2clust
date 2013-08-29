<?php
include ("include/header.php");
include ("include/header_virtual_disk.php");
?>

<div id="corps">
<h1>Status espace disque</h4>
        <br>
        <table border width=96% align=center cellpadding=10>
	<tr><td>
        <table width=100% align=center cellpadding=10>
        <tr>
                <td>Espace disque total
                <td>Taille utilisé
                <td>Taille libre
        <tr>

<?php
	$command = "/usr/bin/sudo /usr/local/bin/alca_disk_vgsize";
	unset($values);
	exec($command, $values, $return_code);
	echo "<td>$values[0]";
	echo "<td>$values[1]";
	echo "<td>$values[2]";
?>
        </table>
        </table>
        <br><br><br>

        <table border width=96% align=center cellpadding=10>
	<tr><td>
        <table width=80% align=center cellpadding=10>
        <tr>
                <td>Nom du volume
                <td>Taille
		<td width=30%>
        <tr>
<?php
	$command = "/usr/bin/sudo /usr/local/bin/alca_disk_lvsize";
	unset($values);
	exec($command, $values, $return_code);
	if (count($values) > 0)
	{
		for ($i = 0; $i < count($values); $i++)
		{
			$ligne = explode(" ", $values[$i]);
			echo "<tr>";
			echo "<td>$ligne[0]";
			echo "<td>$ligne[1]";
		}
	}
?>
        </table>
        </table>
        <br>

<?php
include ("include/footer.php");
?>
