<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commandes - Admin</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="dashboard-layout">
        <aside class="sidebar">
            <h2>Gestion Pro Admin</h2>
            <nav>
                <ul class="sidebar-nav">
                    <li><a href="<?php echo BASE_URL; ?>/admin/dashboard">Tableau de bord</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/admin/clients">Clients</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/admin/products">Produits</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/admin/orders" class="active">Commandes</a></li>
                    <li style="margin-top: 40px;"><a href="<?php echo BASE_URL; ?>/logout" style="color: var(--color-danger-76);">Déconnexion</a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <header>
                <div>
                    <h1>Gestion des Commandes</h1>
                    <p class="text-muted">Suivez et mettez à jour l'état des commandes clients.</p>
                </div>
                <a href="<?php echo BASE_URL; ?>/admin/orders/add" class="btn btn-primary">Nouvelle commande</a>
            </header>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client</th>
                            <th>Montant Total</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($orders)): ?>
                            <tr>
                                <td colspan="6" style="padding: 40px; text-align: center; color: var(--text-muted);">Aucune commande trouvée.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td style="font-weight: 700;">#<?php echo $order['id']; ?></td>
                                    <td><?php echo htmlspecialchars($order['client_name']); ?></td>
                                    <td style="font-weight: 600; color: var(--color-primary);"><?php echo number_format($order['total_amount'], 2); ?> €</td>
                                    <td>
                                        <span class="badge <?php 
                                            echo ($order['status'] === 'livrée' ? 'badge-success' : ($order['status'] === 'en cours' ? 'badge-warning' : '')); 
                                        ?>">
                                            <?php echo ucfirst($order['status']); ?>
                                        </span>
                                    </td>
                                    <td class="text-muted"><?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></td>
                                    <td class="text-right">
                                        <div style="display: flex; gap: 8px; justify-content: flex-end;">
                                            <select onchange="window.location.href='<?php echo BASE_URL; ?>/admin/orders/status?id=<?php echo $order['id']; ?>&status=' + this.value" class="btn btn-secondary" style="padding: 5px; font-size: 12px; width: auto;">
                                                <option value="">Changer statut</option>
                                                <option value="en attente">En attente</option>
                                                <option value="en cours">En cours</option>
                                                <option value="livrée">Livrée</option>
                                            </select>
                                            <a href="<?php echo BASE_URL; ?>/admin/orders/delete?id=<?php echo $order['id']; ?>" class="btn btn-danger" style="padding: 6px 12px; font-size: 12px;" onclick="return confirm('Supprimer cette commande ?')">Supprimer</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html></html>
