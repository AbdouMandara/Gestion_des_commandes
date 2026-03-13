<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Clients - Admin</title>
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
                    <li style="margin-bottom: 15px;"><a href="/logout" style="color:white; text-decoration: none;">Déconnexion</a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                <h1>Gestion des Clients</h1>
                <a href="/admin/clients/add" class="btn btn-primary" style="width: auto; padding: 10px 20px;">Ajouter un client</a>
            </div>

            <table style="width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: var(--shadow);">
                <thead style="background: #f1f5f9;">
                    <tr>
                        <th style="padding: 15px; text-align: left;">Nom</th>
                        <th style="padding: 15px; text-align: left;">Email</th>
                        <th style="padding: 15px; text-align: left;">Téléphone</th>
                        <th style="padding: 15px; text-align: left;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($clients)): ?>
                        <tr>
                            <td colspan="4" style="padding: 20px; text-align: center; color: var(--text-muted);">Aucun client trouvé.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($clients as $client): ?>
                            <tr style="border-bottom: 1px solid var(--border-color);">
                                <td style="padding: 15px;"><?php echo htmlspecialchars($client['name']); ?></td>
                                <td style="padding: 15px;"><?php echo htmlspecialchars($client['email']); ?></td>
                                <td style="padding: 15px;"><?php echo htmlspecialchars($client['phone']); ?></td>
                                <td style="padding: 15px;">
                                    <a href="/admin/clients/edit?id=<?php echo $client['id']; ?>" style="color: var(--primary-color); text-decoration: none; margin-right: 15px;">Modifier</a>
                                    <a href="/admin/clients/delete?id=<?php echo $client['id']; ?>" style="color: var(--error-color); text-decoration: none;" onclick="return confirm('Supprimer ce client ?')">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
