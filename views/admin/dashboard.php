<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Admin</title>
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
            <header style="margin-bottom: 40px;">
                <h1>Tableau de Bord</h1>
                <p style="color: var(--text-muted);">Bienvenue, <?php echo htmlspecialchars($username); ?>.</p>
            </header>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 40px;">
                <div style="background: white; padding: 25px; border-radius: 12px; box-shadow: var(--shadow);">
                    <h3 style="color: var(--text-muted); font-size: 14px; text-transform: uppercase;">Total Clients</h3>
                    <p style="font-size: 32px; font-weight: 700; margin-top: 10px;"><?php echo $clientCount; ?></p>
                </div>
                <div style="background: white; padding: 25px; border-radius: 12px; box-shadow: var(--shadow);">
                    <h3 style="color: var(--text-muted); font-size: 14px; text-transform: uppercase;">Total Produits</h3>
                    <p style="font-size: 32px; font-weight: 700; margin-top: 10px;"><?php echo $productCount; ?></p>
                </div>
                <div style="background: white; padding: 25px; border-radius: 12px; box-shadow: var(--shadow);">
                    <h3 style="color: var(--text-muted); font-size: 14px; text-transform: uppercase;">Total Commandes</h3>
                    <p style="font-size: 32px; font-weight: 700; margin-top: 10px;"><?php echo $orderCount; ?></p>
                </div>
            </div>

            <section style="background: white; padding: 30px; border-radius: 12px; box-shadow: var(--shadow);">
                <h2>Actions Rapides</h2>
                <div style="display: flex; gap: 15px; margin-top: 20px;">
                    <a href="/admin/clients/add" class="btn btn-primary" style="width: auto; padding: 10px 20px; text-decoration: none;">Nouveau Client</a>
                    <a href="/admin/products/add" class="btn btn-primary" style="width: auto; padding: 10px 20px; text-decoration: none; background: #10b981;">Nouveau Produit</a>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
