<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau Client | GestionPro</title>
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
                    <li><a href="<?php echo BASE_URL; ?>/admin/clients" class="active"><span class="material-symbols-rounded">group</span>Clients</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/admin/products"><span class="material-symbols-rounded">inventory_2</span>Produits</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/admin/orders"><span class="material-symbols-rounded">shopping_cart</span>Commandes</a></li>
                    <li style="margin-top: auto; padding-top: var(--space-5);"><a href="<?php echo BASE_URL; ?>/logout" style="color: var(--color-danger);"><span class="material-symbols-rounded">logout</span>Déconnexion</a></li>
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
                    <div class="user-info"><p class="user-name">Admin Bieni Loic</p><p class="user-role">Administrateur</p></div>
                    <div class="avatar">A</div>
                </div>
            </header>

            <div style="margin-bottom: var(--space-5);">
                <a href="<?php echo BASE_URL; ?>/admin/clients" class="btn btn-secondary" style="padding: 6px 12px; font-size: 11px; margin-bottom: var(--space-2); gap: var(--space-1); background: white; border: 1px solid var(--border-subtle); color: var(--text-main);">
                    <span class="material-symbols-rounded" style="font-size: 18px;">arrow_back</span>
                    Retour à la liste
                </a>
                <h1 style="font-size: 28px; font-weight: 800; letter-spacing: -1px;">Ajouter un Client</h1>
                <p class="text-muted">Enregistrez un nouveau partenaire commercial.</p>
            </div>

            <div class="form-card" style="max-width: 600px; margin: 0; padding: var(--space-5);">
                <form action="<?php echo BASE_URL; ?>/admin/clients/add" method="POST">
                    <div class="form-group">
                        <label for="name">Nom complet</label>
                        <input type="text" id="name" name="name" placeholder="Ex: Boutique Alpha" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email professionnel</label>
                        <input type="email" id="email" name="email" placeholder="contact@alpha.com" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Numéro de téléphone</label>
                        <input type="text" id="phone" name="phone" placeholder="+33 0 00 00 00 00">
                    </div>
                    <div class="form-group">
                        <label for="address">Adresse de livraison</label>
                        <textarea id="address" name="address" rows="3" placeholder="Adresse complète..."></textarea>
                    </div>
                    <div class="form-actions" style="margin-top: var(--space-4);">
                        <button type="submit" class="btn btn-primary" style="flex: 2; padding: 14px; font-weight: 700;">Créer le Client</button>
                        <a href="<?php echo BASE_URL; ?>/admin/clients" class="btn btn-secondary" style="flex: 1; padding: 14px; text-align: center; background: white; border: 1px solid var(--border-subtle); color: var(--text-main);">Annuler</a>
                    </div>
                </form>
            </div>
    </div>
</body>
</html>
