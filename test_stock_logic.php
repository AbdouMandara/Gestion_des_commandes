<?php
require_once 'c:\wamp64\www\Gestion_des_commandes_projet_Abdel\config\database.php';
require_once 'c:\wamp64\www\Gestion_des_commandes_projet_Abdel\models\Model.php';
require_once 'c:\wamp64\www\Gestion_des_commandes_projet_Abdel\models\Commande.php';
require_once 'c:\wamp64\www\Gestion_des_commandes_projet_Abdel\models\Produit.php';

try {
    $db = Database::getInstance();
    $commande = new Commande();
    $produit = new Produit();
    
    // Retrieve a product to test on
    $sql = "SELECT id, quantity FROM produits LIMIT 1";
    $testProduct = $db->query($sql)->fetch();
    
    if(!$testProduct) die("No products found.");
    
    $productId = $testProduct['id'];
    $initialStock = $testProduct['quantity'];
    
    echo "Initial stock for product $productId: $initialStock\n";
    
    $items = [['id' => $productId, 'quantity' => 2]];
    
    // Create an order (should be in "en attente", stock should NOT decrease). Uses client_id 2.
    $orderId = $commande->create(2, $items);
    
    $currentStock = $produit->getById($productId)['quantity'];
    echo "Stock after order creation (Expected: $initialStock): $currentStock\n";
    
    if ($currentStock != $initialStock) {
         echo "TEST FAILED: Stock was deducted on creation.\n";
    }
    
    // Update order to "en cours" (stock SHOULD decrease by 2)
    $commande->updateStatus($orderId, 'en cours');
    
    $finalStock = $produit->getById($productId)['quantity'];
    $expectedFinal = $initialStock - 2;
    echo "Stock after order validation (Expected: $expectedFinal): $finalStock\n";
    
    if ($finalStock == $expectedFinal) {
        echo "TEST PASSED: Stock correctly deducted on validation.\n";
    } else {
        echo "TEST FAILED: Stock was not correctly deducted on validation.\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
