<?php
include ("include/header.php");
include ("include/header_virtual_server.php");
?>

<div id="corps">
<h1>Status Serveurs Virtuels</h4>
<br>

<?php
	include ("function/function_status.php");
	show_vm_status();
?>

<?php
include ("include/footer.php");
?>
