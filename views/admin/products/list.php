<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits - Admin</title>
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
                    <li><a href="<?php echo BASE_URL; ?>/admin/products" class="active">Produits</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/admin/orders">Commandes</a></li>
                    <li style="margin-top: 40px;"><a href="<?php echo BASE_URL; ?>/logout" style="color: var(--color-danger-76);">Déconnexion</a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <header>
                <div>
                    <h1>Gestion des Produits</h1>
                    <p class="text-muted">Consultez et gérez votre catalogue de produits.</p>
                </div>
                <a href="<?php echo BASE_URL; ?>/admin/products/add" class="btn btn-primary">Ajouter un produit</a>
            </header>

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
                                    <td style="font-weight: 600;"><?php echo htmlspecialchars($product['name']); ?></td>
                                    <td style="font-weight: 600; color: var(--color-primary);"><?php echo number_format($product['price'], 2); ?> €</td>
                                    <td>
                                        <span class="badge <?php echo $product['quantity'] > 0 ? 'badge-success' : 'badge-danger'; ?>">
                                            <?php echo $product['quantity']; ?>
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <a href="<?php echo BASE_URL; ?>/admin/products/edit?id=<?php echo $product['id']; ?>" class="btn btn-secondary" style="padding: 6px 12px; font-size: 12px; margin-right: 5px;">Modifier</a>
                                        <a href="<?php echo BASE_URL; ?>/admin/products/delete?id=<?php echo $product['id']; ?>" class="btn btn-danger" style="padding: 6px 12px; font-size: 12px;" onclick="return confirm('Supprimer ce produit ?')">Supprimer</a>
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
