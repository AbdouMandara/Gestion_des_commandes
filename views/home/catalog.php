<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Catalogue - Gestion des Commandes</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="main-content" style="max-width: 1000px; margin: 0 auto; padding-top: 50px;">
        <header style="margin-bottom: 40px;">
            <a href="/" style="text-decoration: none; color: var(--text-muted); font-size: 14px;">← Retour</a>
            <h1 style="margin-top: 10px;">Catalogue de Produits</h1>
        </header>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
            <?php foreach ($products as $product): ?>
                <div style="background: white; padding: 20px; border-radius: 12px; box-shadow: var(--shadow); display: flex; flex-direction: column;">
                    <h3 style="margin-bottom: 10px;"><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p style="color: var(--text-muted); font-size: 14px; flex-grow: 1; margin-bottom: 15px;">
                        <?php echo htmlspecialchars($product['description'] ?: 'Aucune description disponible.'); ?>
                    </p>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: auto;">
                        <span style="font-size: 20px; font-weight: 700; color: var(--primary-color);"><?php echo number_format($product['price'], 2); ?> €</span>
                        <span style="font-size: 12px; color: <?php echo $product['quantity'] > 0 ? '#166534' : '#991b1b'; ?>; background: <?php echo $product['quantity'] > 0 ? '#dcfce7' : '#fee2e2'; ?>; padding: 4px 8px; border-radius: 4px;">
                            <?php echo $product['quantity'] > 0 ? $product['quantity'] . ' en stock' : 'Rupture'; ?>
                        </span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
