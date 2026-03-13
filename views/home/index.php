<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Espace - Gestion des Commandes</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header>
            <div>
                <h1>Bonjour, <?php echo htmlspecialchars($username); ?> !</h1>
                <p class="text-muted">Gérez vos commandes en toute simplicité.</p>
            </div>
            <nav>
                <a href="<?php echo BASE_URL; ?>/logout" class="btn btn-danger">Déconnexion</a>
            </nav>
        </header>

        <div class="grid grid-3">
            <a href="<?php echo BASE_URL; ?>/catalog" class="card">
                <h2>Catalogue</h2>
                <p>Découvrez nos produits disponibles et trouvez ce qu'il vous faut.</p>
                <div class="mt-10" style="color: var(--color-primary); font-weight: 600;">Voir les produits →</div>
            </a>
            <a href="<?php echo BASE_URL; ?>/order/create" class="card">
                <h2>Commander</h2>
                <p>Passez une nouvelle commande immédiatement en quelques clics.</p>
                <div class="mt-10" style="color: var(--color-primary); font-weight: 600;">Nouvelle commande →</div>
            </a>
            <a href="<?php echo BASE_URL; ?>/my-orders" class="card">
                <h2>Mes Commandes</h2>
                <p>Suivez l'état de vos commandes en temps réel et consultez l'historique.</p>
                <div class="mt-10" style="color: var(--color-primary); font-weight: 600;">Suivre mes commandes →</div>
            </a>
        </div>
    </div>
</body>
</html>
