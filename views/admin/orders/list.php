<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commandes - Admin</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body class="admin-body">
    <div class="dashboard-layout">
        <aside class="sidebar">
            <div class="sidebar-header" style="margin-bottom: 40px; padding: 0 16px;">
                <h2 style="color: var(--color-primary-48); font-size: 24px; letter-spacing: -0.5px;">Gestion<span style="color: white;">Pro</span></h2>
            </div>
            <nav>
                <ul class="sidebar-nav">
                    <li>
                        <a href="<?php echo BASE_URL; ?>/admin/dashboard">
                            <span class="material-symbols-rounded">dashboard</span>
                            Tableau de bord
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo BASE_URL; ?>/admin/clients">
                            <span class="material-symbols-rounded">group</span>
                            Clients
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo BASE_URL; ?>/admin/products">
                            <span class="material-symbols-rounded">inventory_2</span>
                            Produits
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo BASE_URL; ?>/admin/orders" class="active">
                            <span class="material-symbols-rounded">shopping_cart</span>
                            Commandes
                        </a>
                    </li>
                    <li style="margin-top: auto; padding-top: 40px;">
                        <a href="<?php echo BASE_URL; ?>/logout" style="color: var(--color-danger-76);">
                            <span class="material-symbols-rounded">logout</span>
                            Déconnexion
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <header class="main-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; padding-bottom: 20px; border-bottom: 1px solid var(--border-subtle);">
                <div class="search-bar" style="position: relative; width: 400px;">
                    <span class="material-symbols-rounded" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 20px;">search</span>
                    <input type="text" placeholder="Rechercher une commande..." style="width: 100%; padding: 12px 12px 12px 48px; border-radius: var(--radius-md); border: 1px solid var(--border-subtle); background: var(--color-neutral-95); font-size: 14px;">
                </div>
                <div class="user-profile" style="display: flex; align-items: center; gap: 16px;">
                    <div style="text-align: right;">
                        <p style="font-weight: 600; font-size: 14px; margin: 0; color: var(--color-primary-10);">Admin Abdel</p>
                        <p style="font-size: 12px; color: var(--text-muted); margin: 0;">Administrateur</p>
                    </div>
                    <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--color-primary); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700;">A</div>
                </div>
            </header>

            <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 32px;">
                <div>
                    <h1 style="font-size: 28px; font-weight: 800; color: var(--color-primary-10); letter-spacing: -1px; margin-bottom: 8px;">Gestion des Commandes</h1>
                    <p class="text-muted">Suivez et mettez à jour l'état des commandes clients.</p>
                </div>
                <a href="<?php echo BASE_URL; ?>/admin/orders/add" class="btn btn-primary" style="display: flex; align-items: center; gap: 8px;">
                    <span class="material-symbols-rounded">add_shopping_cart</span>
                    Nouvelle commande
                </a>
            </div>

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
                                    <td style="font-weight: 800; color: var(--color-primary);">#<?php echo $order['id']; ?></td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 10px;">
                                            <div style="width: 28px; height: 28px; border-radius: 50%; background: var(--color-neutral-95); display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: 700; color: var(--color-primary);">
                                                <?php echo strtoupper(substr($order['client_name'], 0, 1)); ?>
                                            </div>
                                            <span style="font-weight: 600;"><?php echo htmlspecialchars($order['client_name']); ?></span>
                                        </div>
                                    </td>
                                    <td style="font-weight: 700; color: var(--color-primary-10);"><?php echo number_format($order['total_amount'], 2); ?> €</td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 8px;">
                                            <span style="width: 8px; height: 8px; border-radius: 50%; background: <?php echo ($order['status'] === 'livrée' ? 'var(--color-success)' : ($order['status'] === 'en cours' ? 'var(--color-warning)' : 'var(--text-muted)')); ?>;"></span>
                                            <span class="badge <?php echo ($order['status'] === 'livrée' ? 'badge-success' : ($order['status'] === 'en cours' ? 'badge-warning' : '')); ?>" style="background: transparent; border: none; padding: 0; color: var(--text-main); font-weight: 600;">
                                                <?php echo ucfirst($order['status']); ?>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="text-muted" style="font-size: 13px;"><?php echo date('d/m/Y', strtotime($order['created_at'])); ?></td>
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
