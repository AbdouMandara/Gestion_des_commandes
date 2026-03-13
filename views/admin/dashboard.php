<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin</title>
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
                    <input type="text" placeholder="Rechercher une commande, un client..." style="width: 100%; padding: 12px 12px 12px 48px; border-radius: var(--radius-md); border: 1px solid var(--border-subtle); background: var(--color-neutral-95); font-size: 14px;">
                </div>
                
                <div class="user-profile" style="display: flex; align-items: center; gap: 16px;">
                    <div style="text-align: right;">
                        <p style="font-weight: 600; font-size: 14px; margin: 0; color: var(--color-primary-10);">Admin Abdel</p>
                        <p style="font-size: 12px; color: var(--text-muted); margin: 0;">Administrateur</p>
                    </div>
                    <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--color-primary); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700;">A</div>
                </div>
            </header>

            <div style="margin-bottom: 40px;">
                <h1 style="font-size: 28px; font-weight: 800; color: var(--color-primary-10); letter-spacing: -1px; margin-bottom: 8px;">Tableau de bord</h1>
                <p class="text-muted">Bienvenue sur votre espace de gestion premium.</p>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <h3>Revenu Total</h3>
                        <span class="material-symbols-rounded" style="color: var(--color-primary); background: var(--color-primary-95); padding: 8px; border-radius: 8px;">payments</span>
                    </div>
                    <div class="value"><?php echo number_format($totalRevenue, 2); ?> €</div>
                    <div class="trend" style="color: var(--color-success); font-weight: 600;">
                        <span class="material-symbols-rounded" style="font-size: 16px; vertical-align: middle;">trending_up</span>
                        +12.5% vs mois dernier
                    </div>
                </div>
                <div class="stat-card">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <h3>Commandes</h3>
                        <span class="material-symbols-rounded" style="color: var(--color-accent); background: var(--color-accent-95); padding: 8px; border-radius: 8px;">shopping_bag</span>
                    </div>
                    <div class="value"><?php echo $orderCount; ?></div>
                    <div class="trend" style="color: var(--color-success); font-weight: 600;">
                        <span class="material-symbols-rounded" style="font-size: 16px; vertical-align: middle;">trending_up</span>
                        +5.2% ce mois
                    </div>
                </div>
                <div class="stat-card">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <h3>Clients</h3>
                        <span class="material-symbols-rounded" style="color: var(--color-secondary); background: var(--color-secondary-95); padding: 8px; border-radius: 8px;">person</span>
                    </div>
                    <div class="value"><?php echo $clientCount; ?></div>
                    <div class="trend" style="color: var(--text-muted); font-weight: 500;">Stable</div>
                </div>
                <div class="stat-card">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <h3>Produits</h3>
                        <span class="material-symbols-rounded" style="color: #6366f1; background: #eef2ff; padding: 8px; border-radius: 8px;">inventory_2</span>
                    </div>
                    <div class="value"><?php echo $productCount; ?></div>
                    <div class="trend" style="color: var(--text-muted); font-weight: 500;">En stock</div>
                </div>
            </div>

            <div class="dashboard-grid" style="display: grid; grid-template-columns: 2fr 1fr; gap: 32px; margin-top: 40px;">
                <div class="card" style="padding: 0; overflow: hidden;">
                    <div style="padding: 24px; border-bottom: 1px solid var(--border-subtle); display: flex; justify-content: space-between; align-items: center;">
                        <h3 style="font-size: 16px; font-weight: 700; color: var(--color-primary-10);">Commandes Récentes</h3>
                        <a href="<?php echo BASE_URL; ?>/admin/orders" class="btn btn-secondary" style="font-size: 12px; padding: 8px 16px;">Voir tout</a>
                    </div>
                    <div class="table-container" style="box-shadow: none; border-radius: 0;">
                        <table style="width: 100%;">
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
                                                <div style="width: 28px; height: 28px; border-radius: 50%; background: var(--color-neutral-95); display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: 700; color: var(--color-primary);">
                                                    <?php echo strtoupper(substr($order['client_name'], 0, 1)); ?>
                                                </div>
                                                <?php echo htmlspecialchars($order['client_name']); ?>
                                            </div>
                                        </td>
                                        <td style="font-weight: 600;"><?php echo number_format($order['total_amount'], 2); ?> €</td>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 6px;">
                                                <span style="width: 8px; height: 8px; border-radius: 50%; background: <?php echo ($order['status'] === 'livrée' ? 'var(--color-success)' : ($order['status'] === 'en cours' ? 'var(--color-warning)' : 'var(--text-muted)')); ?>;"></span>
                                                <span class="badge <?php echo ($order['status'] === 'livrée' ? 'badge-success' : ($order['status'] === 'en cours' ? 'badge-warning' : '')); ?>" style="background: transparent; border: none; padding: 0; color: var(--text-main); font-weight: 500;">
                                                    <?php echo ucfirst($order['status']); ?>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card" style="padding: 24px;">
                    <h3 style="font-size: 16px; font-weight: 700; color: var(--color-primary-10); margin-bottom: 24px;">Actions Rapides</h3>
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        <a href="<?php echo BASE_URL; ?>/admin/orders/add" class="btn btn-primary" style="justify-content: center; padding: 14px;">
                            <span class="material-symbols-rounded" style="margin-right: 8px;">add_shopping_cart</span>
                            Nouvelle Commande
                        </a>
                        <a href="<?php echo BASE_URL; ?>/admin/clients/add" class="btn btn-secondary" style="justify-content: center; padding: 14px;">
                            <span class="material-symbols-rounded" style="margin-right: 8px;">person_add</span>
                            Inscrire un Client
                        </a>
                        <a href="<?php echo BASE_URL; ?>/admin/products/add" class="btn btn-secondary" style="justify-content: center; padding: 14px;">
                            <span class="material-symbols-rounded" style="margin-right: 8px;">add_box</span>
                            Ajouter un Produit
                        </a>
                        <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid var(--border-subtle);">
                            <p class="text-muted" style="font-size: 12px; margin-bottom: 10px;">Raccourcis Système</p>
                            <a href="<?php echo BASE_URL; ?>/logout" style="color: var(--color-danger); font-size: 14px; text-decoration: none; display: flex; align-items: center; gap: 8px;">
                                <span class="material-symbols-rounded" style="font-size: 18px;">power_settings_new</span>
                                Quitter la session
                            </a>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>
</body>
</html>
