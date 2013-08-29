<?php
include ("include/header.php");
include ("include/header_virtual_server.php");
?>

<div id="corps">

<?php
include ("function/form_virtual_server_delete.php");
?>

	<h1>Détruire un serveur virtuel</h4>
	<br>
	<form action="virtual_server_delete.php" method="post">
	<table border width=96% align=center cellpadding=10>
	<tr><td>
	<table width=80% align=center cellpadding=10>
	<tr>
	<td align=right>Nom des serveurs virtuels
	<td><select name="vm_name">

<?php
	include ("function/function_form.php");
	display_htmlmenu_vm();
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
