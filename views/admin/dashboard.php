<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="dashboard-layout">
        <aside class="sidebar">
            <h2 style="color: var(--color-primary-48);">Gestion Pro Admin</h2>
            <nav>
                <ul class="sidebar-nav">
                    <li><a href="<?php echo BASE_URL; ?>/admin/dashboard" class="active">Tableau de bord</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/admin/clients">Clients</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/admin/products">Produits</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/admin/orders">Commandes</a></li>
                    <li style="margin-top: 40px;"><a href="<?php echo BASE_URL; ?>/logout" style="color: var(--color-danger-76);">Déconnexion</a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <header>
                <div>
                    <h1>Tableau de Bord</h1>
                    <p class="text-muted">Bienvenue dans votre espace d'administration, <?php echo htmlspecialchars($username); ?>.</p>
                </div>
            </header>

            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Total Clients</h3>
                    <div class="value"><?php echo $clientCount; ?></div>
                </div>
                <div class="stat-card">
                    <h3>Total Produits</h3>
                    <div class="value"><?php echo $productCount; ?></div>
                </div>
                <div class="stat-card">
                    <h3>Total Commandes</h3>
                    <div class="value"><?php echo $orderCount; ?></div>
                </div>
            </div>

            <section class="card">
                <h2 style="margin-bottom: 20px;">Actions Rapides</h2>
                <div style="display: flex; gap: 15px;">
                    <a href="<?php echo BASE_URL; ?>/admin/clients/add" class="btn btn-primary">Nouveau Client</a>
                    <a href="<?php echo BASE_URL; ?>/admin/products/add" class="btn btn-secondary">Nouveau Produit</a>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
