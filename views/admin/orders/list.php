<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Commandes - Admin</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="dashboard-layout">
        <aside class="sidebar">
            <h2 style="margin-bottom: 20px;">Admin</h2>
            <nav>
                <ul style="list-style: none;">
                    <li style="margin-bottom: 15px;"><a href="/admin/dashboard" style="color:white; text-decoration: none;">Dashboard</a></li>
                    <li style="margin-bottom: 15px;"><a href="/admin/clients" style="color:white; text-decoration: none;">Clients</a></li>
                    <li style="margin-bottom: 15px;"><a href="/admin/products" style="color:white; text-decoration: none;">Produits</a></li>
                    <li style="margin-bottom: 15px;"><a href="/admin/orders" style="color:white; text-decoration: none;">Commandes</a></li>
                    <li style="margin-bottom: 15px;"><a href="/logout" style="color:white; text-decoration: none;">Déconnexion</a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                <h1>Gestion des Commandes</h1>
                <a href="/admin/orders/add" class="btn btn-primary" style="width: auto; padding: 10px 20px;">Nouvelle commande</a>
            </div>

            <table style="width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: var(--shadow);">
                <thead style="background: #f1f5f9;">
                    <tr>
                        <th style="padding: 15px; text-align: left;">ID</th>
                        <th style="padding: 15px; text-align: left;">Client</th>
                        <th style="padding: 15px; text-align: left;">Montant Total</th>
                        <th style="padding: 15px; text-align: left;">Statut</th>
                        <th style="padding: 15px; text-align: left;">Date</th>
                        <th style="padding: 15px; text-align: left;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($orders)): ?>
                        <tr>
                            <td colspan="6" style="padding: 20px; text-align: center; color: var(--text-muted);">Aucune commande trouvée.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($orders as $order): ?>
                            <tr style="border-bottom: 1px solid var(--border-color);">
                                <td style="padding: 15px;">#<?php echo $order['id']; ?></td>
                                <td style="padding: 15px;"><?php echo htmlspecialchars($order['client_name']); ?></td>
                                <td style="padding: 15px; font-weight: 600;"><?php echo number_format($order['total_amount'], 2); ?> €</td>
                                <td style="padding: 15px;">
                                    <span style="padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 500; background: <?php 
                                        echo ($order['status'] === 'livrée' ? '#dcfce7; color: #166534;' : ($order['status'] === 'en cours' ? '#fef9c3; color: #854d0e;' : '#f1f5f9; color: #475569;')); 
                                    ?>">
                                        <?php echo ucfirst($order['status']); ?>
                                    </span>
                                </td>
                                <td style="padding: 15px; color: var(--text-muted);"><?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></td>
                                <td style="padding: 15px;">
                                    <div style="display: flex; gap: 10px;">
                                        <select onchange="window.location.href='/admin/orders/status?id=<?php echo $order['id']; ?>&status=' + this.value" style="padding: 5px; border-radius: 4px; border: 1px solid var(--border-color); font-size: 13px;">
                                            <option value="">Changer statut</option>
                                            <option value="en attente">En attente</option>
                                            <option value="en cours">En cours</option>
                                            <option value="livrée">Livrée</option>
                                        </select>
                                        <a href="/admin/orders/delete?id=<?php echo $order['id']; ?>" style="color: var(--error-color); text-decoration: none;" onclick="return confirm('Supprimer cette commande ?')">Supprimer</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
