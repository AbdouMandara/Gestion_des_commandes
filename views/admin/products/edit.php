<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le produit - Admin</title>
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
                    <a href="<?php echo BASE_URL; ?>/admin/products" class="btn btn-secondary" style="padding: 5px 10px; font-size: 12px; margin-bottom: 10px;">← Retour</a>
                    <h1>Modifier le produit</h1>
                </div>
            </header>

            <div class="card" style="max-width: 600px;">
                <?php if (!$product): ?>
                    <div class="badge badge-danger" style="display: block; text-align: center; padding: 12px;">Produit non trouvé.</div>
                <?php else: ?>
                    <form action="<?php echo BASE_URL; ?>/admin/products/edit?id=<?php echo $product['id']; ?>" method="POST">
                        <div class="form-group">
                            <label for="name">Nom du produit</label>
                            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Prix (€)</label>
                            <input type="number" id="price" name="price" step="0.01" value="<?php echo $product['price']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantité en stock</label>
                            <input type="number" id="quantity" name="quantity" value="<?php echo $product['quantity']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" rows="4"><?php echo htmlspecialchars($product['description']); ?></textarea>
                        </div>
                        <div style="display: flex; gap: 15px; margin-top: 20px; border-top: 1px solid var(--border-subtle); padding-top: 20px;">
                            <button type="submit" class="btn btn-primary" style="padding: 12px 30px;">Enregistrer les modifications</button>
                            <a href="<?php echo BASE_URL; ?>/admin/products" class="btn btn-secondary" style="padding: 12px 30px;">Annuler</a>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>
</html>
