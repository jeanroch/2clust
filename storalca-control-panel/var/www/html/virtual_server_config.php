<?php
include ("include/header.php");
include ("include/header_virtual_server.php");
?>

<div id="corps">
    <h1>Maintenance sur les serveurs virtuels</h1>
	<br>

<?php
	include ("function/function_status.php");
	modify_vm_status();
?>

<?php
include ("include/footer.php");
?>
