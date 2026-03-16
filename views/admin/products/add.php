<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau Produit | GestionPro</title>
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
                    <li><a href="<?php echo BASE_URL; ?>/admin/products" class="active"><span class="material-symbols-rounded">inventory_2</span>Produits</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/admin/orders">
                            <span class="material-symbols-rounded">shopping_cart</span>
                            <span style="flex-grow: 1;">Commandes</span>
                            <?php if (isset($pendingOrdersCount) && $pendingOrdersCount > 0): ?>
                                <span class="badge badge-danger" style="padding: 2px 6px; font-size: 11px;"><?php echo $pendingOrdersCount; ?></span>
                            <?php endif; ?>
                        </a></li>
                    <li style="margin-top: auto; padding-top: var(--space-5);"><a href="<?php echo BASE_URL; ?>/logout" style="color: var(--color-danger);"><span class="material-symbols-rounded">logout</span>Déconnexion</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header class="main-header">
                <div class="header-search"></div>
                <div class="user-nav">
                    <div class="user-info"><p class="user-name">Admin Bieni Loic</p><p class="user-role">Administrateur</p></div>
                    <div class="avatar">A</div>
                </div>
            </header>

            <div style="margin-bottom: var(--space-5);">
                <a href="<?php echo BASE_URL; ?>/admin/products" class="btn btn-secondary" style="padding: 6px 12px; font-size: 11px; margin-bottom: var(--space-2); gap: var(--space-1); background: white; border: 1px solid var(--border-subtle); color: var(--text-main);">
                    <span class="material-symbols-rounded" style="font-size: 18px;">arrow_back</span>
                    Retour à la liste
                </a>
                <h1 style="font-size: 28px; font-weight: 800; letter-spacing: -1px;">Ajouter un Produit</h1>
                <p class="text-muted">Enregistrez un nouvel article dans le catalogue.</p>
            </div>

            <div class="form-card" style="max-width: 600px; margin: 0; padding: var(--space-5);">
                <form action="<?php echo BASE_URL; ?>/admin/products/add" method="POST">
                    <div class="form-group">
                        <label for="name">Nom du produit</label>
                        <input type="text" id="name" name="name" placeholder="Ex: Mac Studio M2" required>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--space-3);">
                        <div class="form-group">
                            <label for="price">Prix unitaire (FCFA)</label>
                            <input type="number" step="0.01" id="price" name="price" placeholder="0.00" required>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantité initiale</label>
                            <input type="number" id="quantity" name="quantity" placeholder="0" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description technique</label>
                        <textarea id="description" name="description" rows="4" placeholder="Détails du produit..."></textarea>
                    </div>
                    <div class="form-actions" style="margin-top: var(--space-4);">
                        <button type="submit" class="btn btn-primary" style="flex: 2; padding: 14px; font-weight: 700;">Ajouter au Catalogue</button>
                        <a href="<?php echo BASE_URL; ?>/admin/products" class="btn btn-secondary" style="flex: 1; padding: 14px; text-align: center; background: white; border: 1px solid var(--border-subtle); color: var(--text-main);">Annuler</a>
                    </div>
                </form>
            </div>
    </div>
</body>
</html>
