<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le produit - Admin</title>
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
            <h1>Modifier le produit</h1>
            <div style="max-width: 600px; margin-top: 30px; background: white; padding: 30px; border-radius: 8px; box-shadow: var(--shadow);">
                <?php if (!$product): ?>
                    <p class="alert alert-danger">Produit non trouvé.</p>
                <?php else: ?>
                    <form action="/admin/products/edit?id=<?php echo $product['id']; ?>" method="POST">
                        <div class="form-group">
                            <label for="name">Nom du produit</label>
                            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Prix</label>
                            <input type="number" id="price" name="price" step="0.01" value="<?php echo $product['price']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantité en stock</label>
                            <input type="number" id="quantity" name="quantity" value="<?php echo $product['quantity']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 6px;" rows="4"><?php echo htmlspecialchars($product['description']); ?></textarea>
                        </div>
                        <div style="display: flex; gap: 15px; margin-top: 20px;">
                            <button type="submit" class="btn btn-primary" style="width: auto; padding: 10px 25px;">Enregistrer les modifications</button>
                            <a href="/admin/products" class="btn" style="width: auto; padding: 10px 25px; background: #eee; text-decoration: none; color: black; text-align: center;">Annuler</a>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>
</html>
