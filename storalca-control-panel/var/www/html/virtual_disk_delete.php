<?php
include ("include/header.php");
include ("include/header_virtual_disk.php");
?>

<div id="corps">

<?php
include ("function/form_virtual_disk_delete.php");
?>

	<h1>Détruire un disque virtuel</h4>
	<br>
	<form action="virtual_disk_delete.php" method="post">
	<table border width=96% align=center cellpadding=10>
	<tr><td>
	<table width=80% align=center cellpadding=10>
	<tr>
	<td align=right>Nom du volume
	<td><select name="lv_name">

<?php
	include ("function/function_form.php");
	display_htmlmenu_lv();
?>

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
