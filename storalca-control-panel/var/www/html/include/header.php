<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <title>StorAlca Control Panel</title>
	   <META http-equiv="Content-Type" content="text/html; charset=utf-8" />
	   <META NAME="Description" CONTENT="StorAlca est le premier serveur haute disponibilité tolérant aux pannes destiné aux petites entreprises, aux associations et aux particuliers.">
	<META NAME="Author" CONTENT="StorAlca">
	<META NAME="Reply-to" CONTENT="support@storalca.com">
	   <link rel="stylesheet" media="screen" type="text/css" title="Design" href="include/storalca.css" />
   </head>
   <body>

<div id="tete">
   <!-- bannière  dans le css-->
</div>

<div id="menu">
   <ul id="onglets">
    <li><a href="index.php">Menu</a>&nbsp;&nbsp;</li>
    <li>&nbsp;&nbsp;<a href="cluster_status.php">Status Cluster</a>&nbsp;&nbsp;</li>
    <li>&nbsp;&nbsp;<a href="virtual_server_status.php">Serveurs Virtuels</a>&nbsp;&nbsp;</li>
    <li>&nbsp;&nbsp;<a href="virtual_disk_status.php">Disques Virtuels</a>&nbsp;&nbsp;</li>
    <li>&nbsp;&nbsp;<a href="host_server_infos.php">Maintenance</a>&nbsp;&nbsp;</li>
  </ul>
</div>

<?php
	echo "
		<div id=\"hidelater\"><div id=\"corps\">Veuillez patienter, demande en cours de traitement</div></div>
		<script>
		function waitmore() {
			document.getElementById(\"hidelater\").innerHTML = '<div id=\"corps\">Certaines actions (comme la création de serveur virtuel) peuvent prendre plus de 5 minutes.<br>Merci d\'être patient...</div>';
			}
		window.setTimeout('waitmore()',40000);</script>
		";
		// 1000 = 1 sec
	ob_flush(); flush();
?>
