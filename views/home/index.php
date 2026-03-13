<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Espace - Gestion des Commandes</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="main-content" style="max-width: 1000px; margin: 0 auto; padding-top: 50px;">
        <header style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px;">
            <div>
                <h1>Bonjour, <?php echo htmlspecialchars($username); ?> !</h1>
                <p style="color: var(--text-muted);">Gérez vos commandes en toute simplicité.</p>
            </div>
            <nav>
                <a href="/logout" class="btn" style="width: auto; background: #fee2e2; color: #dc2626; padding: 8px 15px; text-decoration: none; font-weight: 500;">Déconnexion</a>
            </nav>
        </header>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
            <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: var(--shadow); cursor: pointer;" onclick="window.location.href='/catalog'">
                <h2 style="margin-bottom: 10px;">Catalogue</h2>
                <p style="color: var(--text-muted); margin-bottom: 20px;">Découvrez nos produits disponibles.</p>
                <span style="color: var(--primary-color); font-weight: 600;">Voir les produits →</span>
            </div>
            <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: var(--shadow); cursor: pointer;" onclick="window.location.href='/order/create'">
                <h2 style="margin-bottom: 10px;">Commander</h2>
                <p style="color: var(--text-muted); margin-bottom: 20px;">Passez une nouvelle commande immédiatement.</p>
                <span style="color: var(--primary-color); font-weight: 600;">Nouvelle commande →</span>
            </div>
            <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: var(--shadow); cursor: pointer;" onclick="window.location.href='/my-orders'">
                <h2 style="margin-bottom: 10px;">Mes Commandes</h2>
                <p style="color: var(--text-muted); margin-bottom: 20px;">Suivez l'état de vos commandes en temps réel.</p>
                <span style="color: var(--primary-color); font-weight: 600;">Suivre mes commandes →</span>
            </div>
        </div>
    </div>
</body>
</html>
