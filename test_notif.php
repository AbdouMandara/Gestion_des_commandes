<?php
require_once 'c:\wamp64\www\Gestion_des_commandes_projet_Abdel\config\database.php';
require_once 'c:\wamp64\www\Gestion_des_commandes_projet_Abdel\models\Model.php';
require_once 'c:\wamp64\www\Gestion_des_commandes_projet_Abdel\models\Commande.php';

try {
    $commande = new Commande();
    $commande->updateStatus(1, 'rejetée');
    echo "Status updated to 'rejetée'. Checking notifications...\n";

    require_once 'c:\wamp64\www\Gestion_des_commandes_projet_Abdel\models\Notification.php';
    $notif = new Notification();
    $notifs = $notif->getAllByClient(2);
    
    if (count($notifs) > 0) {
        echo "Success: Found " . count($notifs) . " notifications.\n";
        echo "Latest message: " . $notifs[0]['message'] . "\n";
    } else {
        echo "Error: No notifications found.\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
