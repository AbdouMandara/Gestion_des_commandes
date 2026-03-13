<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Commandes - Gestion des Commandes</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="main-content" style="max-width: 1000px; margin: 0 auto; padding-top: 50px;">
        <header style="margin-bottom: 40px;">
            <a href="/" style="text-decoration: none; color: var(--text-muted); font-size: 14px;">← Retour</a>
            <h1 style="margin-top: 10px;">Mes Commandes</h1>
        </header>

        <section style="background: white; border-radius: 12px; box-shadow: var(--shadow); overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="background: #f1f5f9;">
                    <tr>
                        <th style="padding: 15px; text-align: left;">Commande #</th>
                        <th style="padding: 15px; text-align: left;">Date</th>
                        <th style="padding: 15px; text-align: left;">Montant</th>
                        <th style="padding: 15px; text-align: left;">Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($orders)): ?>
                        <tr>
                            <td colspan="4" style="padding: 30px; text-align: center; color: var(--text-muted);">
                                Vous n'avez pas encore passé de commande.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($orders as $order): ?>
                            <tr style="border-bottom: 1px solid var(--border-color);">
                                <td style="padding: 15px; font-weight: 600;">#<?php echo $order['id']; ?></td>
                                <td style="padding: 15px; color: var(--text-muted);"><?php echo date('d/m/Y', strtotime($order['created_at'])); ?></td>
                                <td style="padding: 15px;"><?php echo number_format($order['total_amount'], 2); ?> €</td>
                                <td style="padding: 15px;">
                                    <span style="padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 500; background: <?php 
                                        echo ($order['status'] === 'livrée' ? '#dcfce7; color: #166534;' : ($order['status'] === 'en cours' ? '#fef9c3; color: #854d0e;' : '#f1f5f9; color: #475569;')); 
                                    ?>">
                                        <?php echo ucfirst($order['status']); ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>
