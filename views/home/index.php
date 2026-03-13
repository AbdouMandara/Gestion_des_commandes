<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Espace | GestionPro</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body class="bg-main">
    <div class="container" style="max-width: 1000px; padding-top: var(--space-6);">
        <header style="margin-bottom: var(--space-6); display: flex; justify-content: space-between; align-items: flex-start; border-bottom: none;">
            <div>
                <h1 style="font-size: 32px; font-weight: 800; letter-spacing: -1.5px; margin-bottom: var(--space-1);">
                    Bonjour, <?php echo htmlspecialchars($username); ?>
                </h1>
                <p class="text-muted" style="font-size: 16px;">Accédez à vos outils de commande et suivi.</p>
            </div>
            <a href="<?php echo BASE_URL; ?>/logout" class="btn btn-secondary" style="background: white; border: 1px solid var(--border-subtle); color: var(--color-danger); gap: var(--space-1); border-radius: 99px;">
                <span class="material-symbols-rounded" style="font-size: 20px;">logout</span>
                Déconnexion
            </a>
        </header>

        <div class="grid grid-3" style="gap: var(--space-4);">
            <a href="<?php echo BASE_URL; ?>/catalog" class="card" style="text-align: center; padding: var(--space-6) var(--space-4);">
                <div class="avatar" style="width: 56px; height: 56px; margin: 0 auto var(--space-3); background: var(--color-neutral-95); color: var(--color-primary); border-radius: 12px; border: 1px solid var(--border-subtle);">
                    <span class="material-symbols-rounded" style="font-size: 28px;">grid_view</span>
                </div>
                <h2 style="font-size: 18px; font-weight: 700; margin-bottom: var(--space-1);">Catalogue</h2>
                <p>Consultez nos produits et stocks disponibles.</p>
            </a>

            <a href="<?php echo BASE_URL; ?>/order/create" class="card" style="text-align: center; padding: var(--space-6) var(--space-4);">
                <div class="avatar" style="width: 56px; height: 56px; margin: 0 auto var(--space-3); background: var(--color-neutral-95); color: var(--color-primary); border-radius: 12px; border: 1px solid var(--border-subtle);">
                    <span class="material-symbols-rounded" style="font-size: 28px;">add_shopping_cart</span>
                </div>
                <h2 style="font-size: 18px; font-weight: 700; margin-bottom: var(--space-1);">Commander</h2>
                <p>Réalisez une nouvelle commande rapidement.</p>
            </a>

            <a href="<?php echo BASE_URL; ?>/my-orders" class="card" style="text-align: center; padding: var(--space-6) var(--space-4);">
                <div class="avatar" style="width: 56px; height: 56px; margin: 0 auto var(--space-3); background: var(--color-neutral-95); color: var(--color-primary); border-radius: 12px; border: 1px solid var(--border-subtle);">
                    <span class="material-symbols-rounded" style="font-size: 28px;">history</span>
                </div>
                <h2 style="font-size: 18px; font-weight: 700; margin-bottom: var(--space-1);">Mes Commandes</h2>
                <p>Historique et suivi de vos achats.</p>
            </a>
        </div>

        <footer style="margin-top: calc(var(--space-8) * 2); border-top: 1px solid var(--border-subtle); padding-top: var(--space-4); text-align: center; color: var(--text-muted); font-size: 12px; font-weight: 500;">
            <p>&copy; <?php echo date('Y'); ?> GestionPro • Espace Client Sécurisé</p>
        </footer>
    </div>
</body>
</html>
