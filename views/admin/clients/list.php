<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients | GestionPro</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body class="admin-body">
    <div class="dashboard-layout">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Gestion<span>Pro</span></h2>
            </div>
            <nav>
                <ul class="sidebar-nav">
                    <li><a href="<?php echo BASE_URL; ?>/admin/dashboard"><span class="material-symbols-rounded">dashboard</span>Tableau de bord</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/admin/clients" class="active"><span class="material-symbols-rounded">group</span>Clients</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/admin/products"><span class="material-symbols-rounded">inventory_2</span>Produits</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/admin/orders"><span class="material-symbols-rounded">shopping_cart</span>Commandes</a></li>
                    <li style="margin-top: auto; padding-top: var(--space-5);"><a href="<?php echo BASE_URL; ?>/logout" style="color: var(--color-danger);"><span class="material-symbols-rounded">logout</span>Déconnexion</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header class="main-header">
                <div class="header-search">
                    <span class="material-symbols-rounded">search</span>
                    <input type="text" placeholder="Rechercher un client...">
                </div>
                <div class="user-nav">
                    <div class="user-info"><p class="user-name">Admin Abdel</p><p class="user-role">Administrateur</p></div>
                    <div class="avatar">A</div>
                </div>
            </header>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--space-4);">
                <div>
                    <h1 style="font-size: 28px; font-weight: 800; letter-spacing: -1px; margin-bottom: var(--space-1);">Gestion des Clients</h1>
                    <p class="text-muted">Consultez et gérez votre base de données clients.</p>
                </div>
                <a href="<?php echo BASE_URL; ?>/admin/clients/add" class="btn btn-primary" style="gap: var(--space-1);">
                    <span class="material-symbols-rounded">person_add</span>
                    Ajouter un client
                </a>
            </div>

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
                            <tr><td colspan="4" style="padding: var(--space-5); text-align: center; color: var(--text-muted);">Aucun client enregistré.</td></tr>
                        <?php else: ?>
                            <?php foreach ($clients as $client): ?>
                                <tr>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: var(--space-2);">
                                            <div class="avatar" style="width: 32px; height: 32px; font-size: 12px; background: var(--color-neutral-86); color: var(--color-primary-10);">
                                                <?php echo strtoupper(substr($client['name'], 0, 1)); ?>
                                            </div>
                                            <span style="font-weight: 600;"><?php echo htmlspecialchars($client['name']); ?></span>
                                        </div>
                                    </td>
                                    <td><?php echo htmlspecialchars($client['email']); ?></td>
                                    <td class="text-muted"><?php echo htmlspecialchars($client['phone']); ?></td>
                                    <td class="text-right">
                                        <div style="display: flex; gap: var(--space-1); justify-content: flex-end;">
                                            <a href="<?php echo BASE_URL; ?>/admin/clients/edit?id=<?php echo $client['id']; ?>" class="btn btn-secondary" style="padding: 6px 10px; background: white; border: 1px solid var(--border-subtle); color: var(--text-main);">
                                                <span class="material-symbols-rounded" style="font-size: 18px;">edit</span>
                                            </a>
                                            <a href="<?php echo BASE_URL; ?>/admin/clients/delete?id=<?php echo $client['id']; ?>" class="btn btn-danger" style="padding: 6px 10px; background: white; border: 1px solid var(--color-danger-86); color: var(--color-danger);" onclick="return confirm('Supprimer ce client ?')">
                                                <span class="material-symbols-rounded" style="font-size: 18px;">delete</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
    </div>
</body>
</html>
