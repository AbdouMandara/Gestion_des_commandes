<?php
require_once __DIR__ . '/../config/database.php';

try {
    $db = Database::getInstance();

    echo "Initialisation du script de création d'utilisateurs...\n";

    // 1. Création de l'administrateur
    $adminUsername = 'admin';
    $adminPasswordRaw = 'admin123';
    $adminPasswordHash = password_hash($adminPasswordRaw, PASSWORD_DEFAULT);

    // Supprimer si déjà existant pour éviter les doublons
    $db->prepare("DELETE FROM users WHERE username = ?")->execute([$adminUsername]);

    $stmt = $db->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'admin')");
    $stmt->execute([$adminUsername, $adminPasswordHash]);
    echo "Administrateur créé : $adminUsername / $adminPasswordRaw\n";

    // 2. Création d'un client utilisateur (pour la connexion)
    $clientUsername = 'jean_dupont';
    $clientPasswordRaw = 'jean123';
    $clientPasswordHash = password_hash($clientPasswordRaw, PASSWORD_DEFAULT);
    $clientEmail = $clientUsername . "@example.com";

    // Supprimer si déjà existant
    $db->prepare("DELETE FROM users WHERE username = ?")->execute([$clientUsername]);
    $db->prepare("DELETE FROM clients WHERE email = ?")->execute([$clientEmail]);

    $stmt = $db->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'user')");
    $stmt->execute([$clientUsername, $clientPasswordHash]);
    echo "Utilisateur client créé : $clientUsername / $clientPasswordRaw\n";

    // 3. Création des données client (pour les commandes)
    $stmt = $db->prepare("INSERT INTO clients (name, email, phone, address) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        'Jean Dupont',
        $clientEmail,
        '06 12 34 56 78',
        '123 Rue de la République, Paris'
    ]);
    echo "Données client insérées pour : Jean Dupont ($clientEmail)\n";

    echo "\nTerminé avec succès !\n";

} catch (PDOException $e) {
    die("\nErreur lors de l'insertion : " . $e->getMessage() . "\n");
}
?>
