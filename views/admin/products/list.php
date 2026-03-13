<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits - Admin</title>
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
                        <a href="<?php echo BASE_URL; ?>/admin/products" class="active">
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
                    <input type="text" placeholder="Rechercher un produit..." style="width: 100%; padding: 12px 12px 12px 48px; border-radius: var(--radius-md); border: 1px solid var(--border-subtle); background: var(--color-neutral-95); font-size: 14px;">
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
                    <h1 style="font-size: 28px; font-weight: 800; color: var(--color-primary-10); letter-spacing: -1px; margin-bottom: 8px;">Gestion des Produits</h1>
                    <p class="text-muted">Consultez et gérez votre catalogue de produits.</p>
                </div>
                <a href="<?php echo BASE_URL; ?>/admin/products/add" class="btn btn-primary" style="display: flex; align-items: center; gap: 8px;">
                    <span class="material-symbols-rounded">add_box</span>
                    Ajouter un produit
                </a>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($products)): ?>
                            <tr>
                                <td colspan="4" style="padding: 40px; text-align: center; color: var(--text-muted);">Aucun produit trouvé.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 12px;">
                                            <div style="width: 32px; height: 32px; border-radius: 8px; background: var(--color-neutral-95); display: flex; align-items: center; justify-content: center; color: var(--text-muted);">
                                                <span class="material-symbols-rounded" style="font-size: 20px;">inventory_2</span>
                                            </div>
                                            <span style="font-weight: 600; color: var(--color-primary-10);"><?php echo htmlspecialchars($product['name']); ?></span>
                                        </div>
                                    </td>
                                    <td style="font-weight: 700; color: var(--color-primary);"><?php echo number_format($product['price'], 2); ?> €</td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 8px;">
                                            <span style="width: 8px; height: 8px; border-radius: 50%; background: <?php echo $product['quantity'] > 5 ? 'var(--color-success)' : ($product['quantity'] > 0 ? 'var(--color-warning)' : 'var(--color-danger)'); ?>;"></span>
                                            <span style="font-weight: 600;"><?php echo $product['quantity']; ?> en stock</span>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div style="display: flex; gap: 8px; justify-content: flex-end;">
                                            <a href="<?php echo BASE_URL; ?>/admin/products/edit?id=<?php echo $product['id']; ?>" class="btn btn-secondary" style="padding: 6px 12px; font-size: 12px;">
                                                <span class="material-symbols-rounded" style="font-size: 18px;">edit</span>
                                            </a>
                                            <a href="<?php echo BASE_URL; ?>/admin/products/delete?id=<?php echo $product['id']; ?>" class="btn btn-danger" style="padding: 6px 12px; font-size: 12px;" onclick="return confirm('Supprimer ce produit ?')">
                                                <span class="material-symbols-rounded" style="font-size: 18px;">delete</span>
                                            </a>
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
</html>
