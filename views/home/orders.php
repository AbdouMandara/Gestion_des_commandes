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
        <header style="margin-bottom: var(--space-5); display: flex; align-items: center; justify-content: space-between;">
            <div style="display: flex; align-items: center; gap: var(--space-3);">
                <a href="<?php echo BASE_URL; ?>/" class="avatar" style="width: 40px; height: 40px; background: white; border: 1px solid var(--border-subtle); color: var(--text-main); text-decoration: none;">
                    <span class="material-symbols-rounded" style="font-size: 20px;">arrow_back</span>
                </a>
                <div>
                    <h1 style="font-size: 28px; font-weight: 800; letter-spacing: -1px; margin-bottom: 2px;">Mes Commandes</h1>
                    <p class="text-muted">Suivez l'état de vos achats en temps réel.</p>
                </div>
            </div>
            
            <?php if (!empty($notifications)): ?>
            <div style="position: relative; display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 50%; background: white; border: 1px solid var(--border-subtle);">
                <span class="material-symbols-rounded" style="font-size: 20px; color: var(--color-primary-10);">notifications</span>
                <span style="position: absolute; top: 0; right: 0; width: 10px; height: 10px; background: var(--color-danger); border: 2px solid white; border-radius: 50%;"></span>
            </div>
            <?php endif; ?>
        </header>

        <?php if (!empty($notifications)): ?>
        <div style="margin-bottom: var(--space-5); background: white; border: 1px solid var(--border-subtle); border-radius: var(--radius-md); padding: var(--space-3);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--space-3); border-bottom: 1px solid var(--border-subtle); padding-bottom: var(--space-2);">
                <h3 style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted); margin: 0;">Centre de notifications</h3>
                <a href="<?php echo BASE_URL; ?>/notifications/read" style="font-size: 12px; color: var(--color-primary); font-weight: 500; text-decoration: none;">Tout marquer comme lu</a>
            </div>
             <div style="display: flex; flex-direction: column; gap: var(--space-2);">
                <?php foreach ($notifications as $notif): ?>
                    <div style="display: flex; justify-content: space-between; align-items: center; font-size: 13px; padding: var(--space-2); background: var(--color-neutral-95); border-radius: var(--radius-sm);">
                        <span style="flex: 1; font-weight: 500;"><?php echo htmlspecialchars($notif['message']); ?></span>
                        <a href="<?php echo BASE_URL; ?>/notifications/read?id=<?php echo $notif['id']; ?>" class="btn" style="padding: 4px 8px; font-size: 11px; background: white; border: 1px solid var(--border-subtle); display: flex; gap: 4px; align-items: center;">
                            <span class="material-symbols-rounded" style="font-size: 14px;">done</span> Vu
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
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
                                <td style="font-weight: 700; color: var(--color-primary-10);"><?php echo number_format($order['total_amount'], 2); ?> FCFA</td>
                                <td>
                                    <span class="badge <?php 
                                        echo ($order['status'] === 'livrée' ? 'badge-success' : 
                                             ($order['status'] === 'en cours' ? 'badge-warning' : 
                                             ($order['status'] === 'rejetée' ? 'badge-danger' : ''))); 
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
