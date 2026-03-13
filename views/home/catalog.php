<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue | GestionPro</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body class="bg-main">
    <div class="container" style="max-width: 1000px; padding-top: var(--space-5);">
        <header style="margin-bottom: var(--space-5); display: flex; align-items: center; gap: var(--space-3);">
            <a href="<?php echo BASE_URL; ?>/" class="avatar" style="width: 40px; height: 40px; background: white; border: 1px solid var(--border-subtle); color: var(--text-main); text-decoration: none;">
                <span class="material-symbols-rounded" style="font-size: 20px;">arrow_back</span>
            </a>
            <div>
                <h1 style="font-size: 28px; font-weight: 800; letter-spacing: -1px; margin-bottom: 2px;">Catalogue</h1>
                <p class="text-muted">Explorez nos produits disponibles.</p>
            </div>
        </header>

        <div class="grid grid-3" style="gap: var(--space-4);">
            <?php foreach ($products as $product): ?>
                <div class="card" style="display: flex; flex-direction: column; padding: 0; overflow: hidden;">
                    <div class="card-body" style="flex-grow: 1;">
                        <h2 style="font-size: 16px; font-weight: 700; color: var(--color-primary-10); margin-bottom: var(--space-1);">
                            <?php echo htmlspecialchars($product['name']); ?>
                        </h2>
                        <p style="margin-bottom: var(--space-2);">
                            <?php echo htmlspecialchars($product['description'] ?: 'Aucune description disponible.'); ?>
                        </p>
                    </div>
                    <div class="card-footer" style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 18px; font-weight: 800; color: var(--color-primary-10);"><?php echo number_format($product['price'], 2); ?> €</span>
                        <span class="badge <?php echo $product['quantity'] > 0 ? 'badge-success' : 'badge-danger'; ?>" style="font-size: 11px;">
                            <?php echo $product['quantity'] > 0 ? $product['quantity'] . ' en stock' : 'Rupture'; ?>
                        </span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
