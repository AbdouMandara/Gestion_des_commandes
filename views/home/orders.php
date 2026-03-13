<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Commandes | GestionPro</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body class="bg-main">
    <div class="container" style="max-width: 1000px; padding-top: var(--space-5);">
        <header style="margin-bottom: var(--space-5); display: flex; align-items: center; gap: var(--space-3);">
            <a href="<?php echo BASE_URL; ?>/" class="avatar" style="width: 40px; height: 40px; background: white; border: 1px solid var(--border-subtle); color: var(--text-main); text-decoration: none;">
                <span class="material-symbols-rounded" style="font-size: 20px;">arrow_back</span>
            </a>
            <div>
                <h1 style="font-size: 28px; font-weight: 800; letter-spacing: -1px; margin-bottom: 2px;">Mes Commandes</h1>
                <p class="text-muted">Suivez l'état de vos achats en temps réel.</p>
            </div>
        </header>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>N° Commande</th>
                        <th>Date d'émission</th>
                        <th>Montant HT</th>
                        <th>État actuel</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($orders)): ?>
                        <tr>
                            <td colspan="4" style="padding: var(--space-6); text-align: center; color: var(--text-muted); font-weight: 500;">
                                Vous n'avez pas encore passé de commande.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td style="font-weight: 800; color: var(--color-primary-10);">#<?php echo $order['id']; ?></td>
                                <td class="text-muted"><?php echo date('d/m/Y', strtotime($order['created_at'])); ?></td>
                                <td style="font-weight: 700; color: var(--color-primary-10);"><?php echo number_format($order['total_amount'], 2); ?> €</td>
                                <td>
                                    <span class="badge <?php echo ($order['status'] === 'livrée' ? 'badge-success' : ($order['status'] === 'en cours' ? 'badge-warning' : '')); ?>">
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
