<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue - Gestion des Commandes</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header>
            <div>
                <a href="<?php echo BASE_URL; ?>/" class="btn btn-secondary" style="padding: 5px 10px; font-size: 12px; margin-bottom: 10px;">← Retour</a>
                <h1>Catalogue de Produits</h1>
            </div>
        </header>

        <div class="grid grid-3">
            <?php foreach ($products as $product): ?>
                <div class="card" style="display: flex; flex-direction: column; cursor: default;">
                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p class="text-muted" style="flex-grow: 1; margin-bottom: 15px;">
                        <?php echo htmlspecialchars($product['description'] ?: 'Aucune description disponible.'); ?>
                    </p>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: auto;">
                        <span style="font-size: 20px; font-weight: 700; color: var(--color-primary);"><?php echo number_format($product['price'], 2); ?> €</span>
                        <span class="badge <?php echo $product['quantity'] > 0 ? 'badge-success' : 'badge-danger'; ?>">
                            <?php echo $product['quantity'] > 0 ? $product['quantity'] . ' en stock' : 'Rupture'; ?>
                        </span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
