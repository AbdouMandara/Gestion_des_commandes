<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un client - Admin</title>
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
                    <li><a href="<?php echo BASE_URL; ?>/admin/clients" class="active">Clients</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/admin/products">Produits</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/admin/orders">Commandes</a></li>
                    <li style="margin-top: 40px;"><a href="<?php echo BASE_URL; ?>/logout" style="color: var(--color-danger-76);">Déconnexion</a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <header>
                <div>
                    <a href="<?php echo BASE_URL; ?>/admin/clients" class="btn btn-secondary" style="padding: 5px 10px; font-size: 12px; margin-bottom: 10px;">← Retour</a>
                    <h1>Ajouter un nouveau client</h1>
                </div>
            </header>

            <div class="card" style="max-width: 600px;">
                <form action="<?php echo BASE_URL; ?>/admin/clients/add" method="POST">
                    <div class="form-group">
                        <label for="name">Nom complet</label>
                        <input type="text" id="name" name="name" placeholder="Ex: Jean Dupont" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="jean.dupont@example.com" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Téléphone</label>
                        <input type="text" id="phone" name="phone" placeholder="06 12 34 56 78">
                    </div>
                    <div class="form-group">
                        <label for="address">Adresse</label>
                        <textarea id="address" name="address" rows="4" placeholder="Adresse complète..."></textarea>
                    </div>
                    <div style="display: flex; gap: 15px; margin-top: 20px; border-top: 1px solid var(--border-subtle); padding-top: 20px;">
                        <button type="submit" class="btn btn-primary" style="padding: 12px 30px;">Enregistrer le client</button>
                        <a href="<?php echo BASE_URL; ?>/admin/clients" class="btn btn-secondary" style="padding: 12px 30px;">Annuler</a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
