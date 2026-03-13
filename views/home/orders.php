<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Commandes - Gestion des Commandes</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header>
            <div>
                <a href="<?php echo BASE_URL; ?>/" class="btn btn-secondary" style="padding: 5px 10px; font-size: 12px; margin-bottom: 10px;">← Retour</a>
                <h1>Mes Commandes</h1>
            </div>
        </header>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Commande #</th>
                        <th>Date</th>
                        <th>Montant</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($orders)): ?>
                        <tr>
                            <td colspan="4" style="padding: 40px; text-align: center; color: var(--text-muted);">
                                Vous n'avez pas encore passé de commande.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td style="font-weight: 700;">#<?php echo $order['id']; ?></td>
                                <td><?php echo date('d/m/Y', strtotime($order['created_at'])); ?></td>
                                <td style="font-weight: 600; color: var(--color-primary);"><?php echo number_format($order['total_amount'], 2); ?> €</td>
                                <td>
                                    <span class="badge <?php 
                                        echo ($order['status'] === 'livrée' ? 'badge-success' : ($order['status'] === 'en cours' ? 'badge-warning' : '')); 
                                    ?>">
                                        <?php echo ucfirst($order['status']); ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
