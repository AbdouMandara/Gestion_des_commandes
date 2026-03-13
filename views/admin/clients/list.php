<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients - Admin</title>
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
                    <h1>Gestion des Clients</h1>
                    <p class="text-muted">Consultez et gérez la liste de vos clients.</p>
                </div>
                <a href="<?php echo BASE_URL; ?>/admin/clients/add" class="btn btn-primary">Ajouter un client</a>
            </header>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($clients)): ?>
                            <tr>
                                <td colspan="4" style="padding: 40px; text-align: center; color: var(--text-muted);">Aucun client trouvé.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($clients as $client): ?>
                                <tr>
                                    <td style="font-weight: 600;"><?php echo htmlspecialchars($client['name']); ?></td>
                                    <td><?php echo htmlspecialchars($client['email']); ?></td>
                                    <td><?php echo htmlspecialchars($client['phone']); ?></td>
                                    <td class="text-right">
                                        <a href="<?php echo BASE_URL; ?>/admin/clients/edit?id=<?php echo $client['id']; ?>" class="btn btn-secondary" style="padding: 6px 12px; font-size: 12px; margin-right: 5px;">Modifier</a>
                                        <a href="<?php echo BASE_URL; ?>/admin/clients/delete?id=<?php echo $client['id']; ?>" class="btn btn-danger" style="padding: 6px 12px; font-size: 12px;" onclick="return confirm('Supprimer ce client ?')">Supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
