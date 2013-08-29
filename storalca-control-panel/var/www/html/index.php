<?php
include ("include/header.php");
?>

<div id="corps">
    <h4><a href="cluster_status.php">Status Cluster</a></h4>
   <p>Affiche l'état de l'ensemble du cluster
   </p>

    <h4><a href="virtual_server_status.php">Serveurs Virtuels</a></h4>
   <p>Permet de créer, détruire ou modifier les serveurs virtuels
   </p>

    <h4><a href="virtual_disk_status.php">Disques Virtuels</a></h4>
   <p>Permet de créer, détruire ou modifier les espaces de disque
   <br>Chaque serveur virtuel doit possèder un espace disque dédié. A créer avant toute creation de serveur virtuel
   </p>

    <h4><a href="host_server_infos.php">Maintenance</a></h4>
   <p>Pour faire des modifications sur les serveurs physiques
   <br>Il est conseillé de ne modifier les paramètres qu'une seule fois, lors de la première mise en route
   </p>

</div>

<?php
include ("include/footer.php");
?>
