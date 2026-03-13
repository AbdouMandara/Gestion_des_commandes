<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Produits - Admin</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="dashboard-layout">
        <aside class="sidebar">
            <h2 style="margin-bottom: 20px;">Admin</h2>
            <nav>
                <ul style="list-style: none;">
                    <li style="margin-bottom: 15px;"><a href="/admin/dashboard" style="color:white; text-decoration: none;">Dashboard</a></li>
                    <li style="margin-bottom: 15px;"><a href="/admin/clients" style="color:white; text-decoration: none;">Clients</a></li>
                    <li style="margin-bottom: 15px;"><a href="/admin/products" style="color:white; text-decoration: none;">Produits</a></li>
                    <li style="margin-bottom: 15px;"><a href="/logout" style="color:white; text-decoration: none;">Déconnexion</a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                <h1>Gestion des Produits</h1>
                <a href="/admin/products/add" class="btn btn-primary" style="width: auto; padding: 10px 20px;">Ajouter un produit</a>
            </div>

            <table style="width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: var(--shadow);">
                <thead style="background: #f1f5f9;">
                    <tr>
                        <th style="padding: 15px; text-align: left;">Nom</th>
                        <th style="padding: 15px; text-align: left;">Prix</th>
                        <th style="padding: 15px; text-align: left;">Quantité</th>
                        <th style="padding: 15px; text-align: left;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($products)): ?>
                        <tr>
                            <td colspan="4" style="padding: 20px; text-align: center; color: var(--text-muted);">Aucun produit trouvé.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($products as $product): ?>
                            <tr style="border-bottom: 1px solid var(--border-color);">
                                <td style="padding: 15px;"><?php echo htmlspecialchars($product['name']); ?></td>
                                <td style="padding: 15px;"><?php echo number_format($product['price'], 2); ?> €</td>
                                <td style="padding: 15px;"><?php echo $product['quantity']; ?></td>
                                <td style="padding: 15px;">
                                    <a href="/admin/products/edit?id=<?php echo $product['id']; ?>" style="color: var(--primary-color); text-decoration: none; margin-right: 15px;">Modifier</a>
                                    <a href="/admin/products/delete?id=<?php echo $product['id']; ?>" style="color: var(--error-color); text-decoration: none;" onclick="return confirm('Supprimer ce produit ?')">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
