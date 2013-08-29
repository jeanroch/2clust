<?php
include ("include/header.php");
include ("include/header_virtual_disk.php");
?>

<div id="corps">

<?php
include ("function/form_virtual_disk_create.php");
?>

	<h1>Créer un disque virtuel</h4>
	<br>
	<form action="virtual_disk_create.php" method="post">
	<table border width=96% align=center cellpadding=10>
	<tr><td>
	<table width=100% align=center cellpadding=10>
	<tr>
	<td>Nom du volume
	<td><input name="lv_name" size=40>
	<tr>
	<td>Taille
	<td><input name="lv_size" size=10>
	<select name="lv_unit">
		<option value="M">Mega
		<option value="G">Giga

	<tr>
	<td colspan=2 align=center>
		<input type="hidden" name="form_post" value="ok">
		<input type="submit" value="Envoyer">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset">
	</form>
	</table>
	</table>

<?php
include ("include/footer.php");
?>
