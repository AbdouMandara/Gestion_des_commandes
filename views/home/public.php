<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Publique | GestionPro</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body class="bg-main">
    <nav style="background: white; border-bottom: 1px solid var(--border-subtle); padding: var(--space-3) var(--space-5); display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 10;">
        <div style="font-weight: 800; font-size: 20px; letter-spacing: -0.5px;">Gestion<span style="color: var(--color-primary);">Pro</span></div>
        <div style="display: flex; gap: var(--space-2);">
            <a href="<?php echo BASE_URL; ?>/login" class="btn btn-secondary" style="padding: 8px 16px; background: white; border: 1px solid var(--border-subtle); color: var(--text-main);">Connexion</a>
            <a href="<?php echo BASE_URL; ?>/register" class="btn btn-primary" style="padding: 8px 16px;">Créer un compte</a>
        </div>
    </nav>

    <div class="container" style="max-width: 1000px; padding-top: var(--space-5);">
        <header style="margin-bottom: var(--space-6); text-align: center;">
            <h1 style="font-size: 42px; font-weight: 800; letter-spacing: -1.5px; margin-bottom: var(--space-2);">Nos Équipements Professionnels</h1>
            <p class="text-muted" style="max-width: 600px; margin: 0 auto; font-size: 16px;">Parcourez notre catalogue et inscrivez-vous en un clic pour passer commande ou suivre vos achats.</p>
        </header>

        <div class="grid grid-3" style="gap: var(--space-4); margin-bottom: var(--space-6);">
            <?php foreach ($products as $product): ?>
                <div class="card" style="display: flex; flex-direction: column; padding: 0; overflow: hidden; border: 1px solid var(--border-subtle); border-radius: var(--radius-lg); background: white;">
                    <div class="card-body" style="flex-grow: 1; padding: var(--space-4);">
                        <h2 style="font-size: 16px; font-weight: 700; color: var(--color-primary-10); margin-bottom: var(--space-1);">
                            <?php echo htmlspecialchars($product['name']); ?>
                        </h2>
                        <p style="margin-bottom: var(--space-2); color: var(--text-muted); font-size: 14px; line-height: 1.5;">
                            <?php echo htmlspecialchars($product['description'] ?: 'Aucune description disponible.'); ?>
                        </p>
                    </div>
                    <div class="card-footer" style="padding: var(--space-3) var(--space-4); background: var(--color-neutral-98); border-top: 1px solid var(--border-subtle); display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 18px; font-weight: 800; color: var(--color-primary-10);"><?php echo number_format($product['price'], 2); ?> FCFA</span>
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
