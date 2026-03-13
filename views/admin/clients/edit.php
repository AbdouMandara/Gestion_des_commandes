<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un client - Admin</title>
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
                    <h1>Modifier le client</h1>
                </div>
            </header>

            <div class="card" style="max-width: 600px;">
                <?php if (!$client): ?>
                    <div class="badge badge-danger" style="display: block; text-align: center; padding: 12px;">Client non trouvé.</div>
                <?php else: ?>
                    <form action="<?php echo BASE_URL; ?>/admin/clients/edit?id=<?php echo $client['id']; ?>" method="POST">
                        <div class="form-group">
                            <label for="name">Nom complet</label>
                            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($client['name']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($client['email']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Téléphone</label>
                            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($client['phone']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="address">Adresse</label>
                            <textarea id="address" name="address" rows="4"><?php echo htmlspecialchars($client['address']); ?></textarea>
                        </div>
                        <div style="display: flex; gap: 15px; margin-top: 20px; border-top: 1px solid var(--border-subtle); padding-top: 20px;">
                            <button type="submit" class="btn btn-primary" style="padding: 12px 30px;">Enregistrer les modifications</button>
                            <a href="<?php echo BASE_URL; ?>/admin/clients" class="btn btn-secondary" style="padding: 12px 30px;">Annuler</a>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>
</html>
