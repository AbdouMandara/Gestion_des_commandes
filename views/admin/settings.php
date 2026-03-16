<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres | GestionPro</title>
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
                    <li><a href="<?php echo BASE_URL; ?>/admin/dashboard"><span class="material-symbols-rounded">dashboard</span>Tableau de bord</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/admin/clients"><span class="material-symbols-rounded">group</span>Clients</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/admin/products"><span class="material-symbols-rounded">inventory_2</span>Produits</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/admin/orders">
                            <span class="material-symbols-rounded">shopping_cart</span>
                            <span style="flex-grow: 1;">Commandes</span>
                            <?php if (isset($pendingOrdersCount) && $pendingOrdersCount > 0): ?>
                                <span class="badge badge-danger" style="padding: 2px 6px; font-size: 11px;"><?php echo $pendingOrdersCount; ?></span>
                            <?php endif; ?>
                        </a></li>
                    <li><a href="<?php echo BASE_URL; ?>/admin/settings" class="active"><span class="material-symbols-rounded">settings</span>Paramètres</a></li>
                    <li style="margin-top: auto; padding-top: var(--space-5);"><a href="<?php echo BASE_URL; ?>/logout" style="color: var(--color-danger);"><span class="material-symbols-rounded">logout</span>Déconnexion</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header class="main-header">
                <div class="header-search"></div>
                <div class="user-nav">
                    <div class="user-info">
                        <p class="user-name">Admin Bieni Loic</p>
                        <p class="user-role">Administrateur</p>
                    </div>
                    <div class="avatar">A</div>
                </div>
            </header>

            <div style="margin-bottom: var(--space-5);">
                <h1 style="font-size: 28px; font-weight: 800; letter-spacing: -1px;">Paramètres du Profil</h1>
                <p class="text-muted">Gérez vos informations personnelles et de connexion.</p>
            </div>

            <?php if (isset($_GET['success'])): ?>
                <div class="badge badge-success" style="display: block; text-align: center; padding: var(--space-3); margin-bottom: var(--space-4); border-radius: var(--radius-md);">
                    Profil mis à jour avec succès !
                </div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                <div class="badge badge-danger" style="display: block; text-align: center; padding: var(--space-3); margin-bottom: var(--space-4); border-radius: var(--radius-md);">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <div class="form-card" style="max-width: 600px; margin: 0; padding: var(--space-5);">
                <form action="<?php echo BASE_URL; ?>/admin/settings" method="POST">
                    <div class="form-group">
                        <label for="username">Nom d'affichage</label>
                        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Adresse Email</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Nouveau mot de passe (laisser vide pour ne pas changer)</label>
                        <input type="password" id="password" name="password" placeholder="••••••••">
                    </div>
                    <div class="form-actions" style="margin-top: var(--space-4);">
                        <button type="submit" class="btn btn-primary" style="flex: 2; padding: 14px; font-weight: 700;">Enregistrer les modifications</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
