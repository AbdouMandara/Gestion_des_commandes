<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord | GestionPro</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body class="admin-body">
    <div class="dashboard-layout">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Gestion<span>Pro</span></h2>
            </div>
            <nav>
                <ul class="sidebar-nav">
                    <li>
                        <a href="<?php echo BASE_URL; ?>/admin/dashboard" class="active">
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
                        <a href="<?php echo BASE_URL; ?>/admin/orders">
                            <span class="material-symbols-rounded">shopping_cart</span>
                            <span style="flex-grow: 1;">Commandes</span>
                            <?php if (isset($pendingOrdersCount) && $pendingOrdersCount > 0): ?>
                                <span class="badge badge-danger" style="padding: 2px 6px; font-size: 11px;"><?php echo $pendingOrdersCount; ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <li style="margin-top: auto; padding-top: var(--space-5);">
                        <a href="<?php echo BASE_URL; ?>/logout" style="color: var(--color-danger);">
                            <span class="material-symbols-rounded">logout</span>
                            Déconnexion
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header class="main-header">
                <div class="header-search">
                    <span class="material-symbols-rounded">search</span>
                    <input type="text" placeholder="Rechercher...">
                </div>
                
                <div class="user-nav">
                    <div class="user-info">
                        <p class="user-name">Admin Bieni Loic</p>
                        <p class="user-role">Administrateur</p>
                    </div>
                    <div class="avatar">A</div>
                </div>
            </header>

            <div style="margin-bottom: var(--space-5);">
                <h1 style="font-size: 28px; font-weight: 800; letter-spacing: -1px; margin-bottom: var(--space-1);">Tableau de bord</h1>
                <p class="text-muted">Vue d'ensemble de votre activité de gestion.</p>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-card-header" style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: var(--space-2);">
                        <h3>Revenu Total</h3>
                        <div class="stat-icon">
                            <span class="material-symbols-rounded">payments</span>
                        </div>
                    </div>
                    <div class="value"><?php echo number_format($totalRevenue, 2); ?> FCFA</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-card-header" style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: var(--space-2);">
                        <h3>Commandes</h3>
                        <div class="stat-icon">
                            <span class="material-symbols-rounded">shopping_bag</span>
                        </div>
                    </div>
                    <div class="value"><?php echo $orderCount; ?></div>
                </div>

                <div class="stat-card">
                    <div class="stat-card-header" style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: var(--space-2);">
                        <h3>Clients</h3>
                        <div class="stat-icon">
                            <span class="material-symbols-rounded">person</span>
                        </div>
                    </div>
                    <div class="value"><?php echo $clientCount; ?></div>
                </div>

                <div class="stat-card">
                    <div class="stat-card-header" style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: var(--space-2);">
                        <h3>Produits</h3>
                        <div class="stat-icon">
                            <span class="material-symbols-rounded">inventory_2</span>
                        </div>
                    </div>
                    <div class="value"><?php echo $productCount; ?></div>
                </div>
            </div>

            <div class="dashboard-grid" style="display: grid; grid-template-columns: 2fr 1fr; gap: var(--space-4); margin-top: var(--space-5);">
                <div class="card" style="padding: 0; overflow: hidden;">
                    <div class="card-header">
                        <h3 style="font-size: 16px; font-weight: 700;">Commandes Récentes</h3>
                        <a href="<?php echo BASE_URL; ?>/admin/orders" class="btn btn-secondary" style="font-size: 12px;">Voir tout</a>
                    </div>
                    <div class="table-container" style="border: none; box-shadow: none; margin-top: 0;">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Client</th>
                                    <th>Total</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recentOrders as $order): ?>
                                    <tr>
                                        <td style="font-weight: 700; color: var(--color-primary);">#<?php echo $order['id']; ?></td>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                <div class="avatar" style="width: 24px; height: 24px; font-size: 10px; background: var(--color-neutral-86); color: var(--color-primary-10);">
                                                    <?php echo strtoupper(substr($order['client_name'], 0, 1)); ?>
                                                </div>
                                                <?php echo htmlspecialchars($order['client_name']); ?>
                                            </div>
                                        </td>
                                        <td style="font-weight: 600;"><?php echo number_format($order['total_amount'], 2); ?> FCFA</td>
                                        <td>
                                            <span class="badge <?php echo ($order['status'] === 'livrée' ? 'badge-success' : ($order['status'] === 'en cours' ? 'badge-warning' : '')); ?>">
                                                <?php echo ucfirst($order['status']); ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" style="border-bottom: none; padding-bottom: 0;">
                        <h3 style="font-size: 16px; font-weight: 700;">Actions Rapides</h3>
                    </div>
                    <div class="card-body" style="display: flex; flex-direction: column; gap: var(--space-2);">
                        <a href="<?php echo BASE_URL; ?>/admin/orders/add" class="btn btn-primary" style="justify-content: flex-start; padding: 12px 16px;">
                            <span class="material-symbols-rounded" style="margin-right: 12px;">add_shopping_cart</span>
                            Nouvelle Commande
                        </a>
                        <a href="<?php echo BASE_URL; ?>/admin/clients/add" class="btn btn-secondary" style="justify-content: flex-start; padding: 12px 16px; background: white; border: 1px solid var(--border-subtle); color: var(--text-main);">
                            <span class="material-symbols-rounded" style="margin-right: 12px;">person_add</span>
                            Inscrire un Client
                        </a>
                        <a href="<?php echo BASE_URL; ?>/admin/products/add" class="btn btn-secondary" style="justify-content: flex-start; padding: 12px 16px; background: white; border: 1px solid var(--border-subtle); color: var(--text-main);">
                            <span class="material-symbols-rounded" style="margin-right: 12px;">add_box</span>
                            Ajouter un Produit
                        </a>
                        
                        <div style="margin-top: var(--space-2); padding-top: var(--space-2); border-top: 1px solid var(--border-subtle);">
                            <a href="<?php echo BASE_URL; ?>/logout" style="color: var(--color-danger); font-size: 13px; text-decoration: none; display: flex; align-items: center; gap: 8px; font-weight: 600;">
                                <span class="material-symbols-rounded" style="font-size: 18px;">power_settings_new</span>
                                Quitter la session
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('.header-search input');
            const tableRows = document.querySelectorAll('tbody tr');

            searchInput.addEventListener('input', function(e) {
                const term = e.target.value.toLowerCase().trim();
                
                tableRows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(term) ? '' : 'none';
                });
            });
        });
    </script>
</body>
</html>

</html>
