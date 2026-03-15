<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commandes | GestionPro</title>
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
                    <li><a href="<?php echo BASE_URL; ?>/admin/clients"><span class="material-symbols-rounded">group</span>Clients</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/admin/products"><span class="material-symbols-rounded">inventory_2</span>Produits</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/admin/orders" class="active">
                            <span class="material-symbols-rounded">shopping_cart</span>
                            <span style="flex-grow: 1;">Commandes</span>
                            <?php if (isset($pendingOrdersCount) && $pendingOrdersCount > 0): ?>
                                <span class="badge badge-danger" style="padding: 2px 6px; font-size: 11px;"><?php echo $pendingOrdersCount; ?></span>
                            <?php endif; ?>
                        </a></li>
                    <li style="margin-top: auto; padding-top: var(--space-5);"><a href="<?php echo BASE_URL; ?>/logout" style="color: var(--color-danger);"><span class="material-symbols-rounded">logout</span>Déconnexion</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header class="main-header">
                <div class="header-search">
                    <span class="material-symbols-rounded">search</span>
                    <input type="text" placeholder="Suivre une commande...">
                </div>
                <div class="user-nav">
                    <div class="user-info"><p class="user-name">Admin Bieni Loic</p><p class="user-role">Administrateur</p></div>
                    <div class="avatar">A</div>
                </div>
            </header>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--space-4);">
                <div>
                    <h1 style="font-size: 28px; font-weight: 800; letter-spacing: -1px; margin-bottom: var(--space-1);">Gestion des Commandes</h1>
                    <p class="text-muted">Suivez et gérez l'état des commandes en temps réel.</p>
                </div>
                <a href="<?php echo BASE_URL; ?>/admin/orders/add" class="btn btn-primary" style="gap: var(--space-1);">
                    <span class="material-symbols-rounded">add_shopping_cart</span>
                    Nouvelle commande
                </a>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>N° Commande</th>
                            <th>Client</th>
                            <th>Montant Total</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($orders)): ?>
                            <tr><td colspan="6" style="padding: var(--space-5); text-align: center; color: var(--text-muted);">Aucune commande enregistrée.</td></tr>
                        <?php else: ?>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td style="font-weight: 800; color: var(--color-primary);">#<?php echo $order['id']; ?></td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: var(--space-2);">
                                            <div class="avatar" style="width: 32px; height: 32px; font-size: 10px; background: var(--color-neutral-86); color: var(--color-primary-10);">
                                                <?php echo strtoupper(substr($order['client_name'], 0, 1)); ?>
                                            </div>
                                            <span style="font-weight: 600;"><?php echo htmlspecialchars($order['client_name']); ?></span>
                                        </div>
                                    </td>
                                    <td style="font-weight: 700; color: var(--color-primary-10);"><?php echo number_format($order['total_amount'], 2); ?> FCFA</td>
                                    <td>
                                        <?php
                                            $statusLabels = ['en attente' => 'En attente', 'en cours' => 'En cours', 'livree' => 'Livrée', 'rejetee' => 'Rejetée'];
                                            $statusBadge  = ['livree' => 'badge-success', 'en cours' => 'badge-warning', 'rejetee' => 'badge-danger'];
                                            $sl = $order['status'];
                                        ?>
                                        <span class="badge <?php echo $statusBadge[$sl] ?? ''; ?>">
                                            <?php echo $statusLabels[$sl] ?? ucfirst($sl); ?>
                                        </span>
                                    </td>
                                    <td class="text-muted" style="font-size: 13px;"><?php echo date('d/m/Y', strtotime($order['created_at'])); ?></td>
                                    <td class="text-right">
                                        <div style="display: flex; gap: var(--space-1); justify-content: flex-end; align-items: center;">
                                            <?php if ($order['status'] === 'en attente'): ?>
                                                <a href="<?php echo BASE_URL; ?>/admin/orders/status?id=<?php echo $order['id']; ?>&status=en cours" class="btn btn-primary" style="padding: 6px 12px; font-size: 11px; background: #10b981; color: white; border: none;" title="Valider la commande">
                                                    <span class="material-symbols-rounded" style="font-size: 18px;">check_circle</span>
                                                    Valider
                                                </a>
                                                <a href="<?php echo BASE_URL; ?>/admin/orders/status?id=<?php echo $order['id']; ?>&status=rejetee" class="btn btn-danger" style="padding: 6px 12px; font-size: 11px; background: #ef4444; border: none; color: white;" title="Rejeter la commande">
                                                    <span class="material-symbols-rounded" style="font-size: 18px;">cancel</span>
                                                    Rejeter
                                                </a>
                                            <?php elseif ($order['status'] === 'rejetee'): ?>
                                                <span style="font-size: 12px; font-weight: 600; color: var(--text-muted); margin-right: 8px;">Rejetée</span>
                                            <?php elseif ($order['status'] === 'livree'): ?>
                                                <span style="font-size: 12px; font-weight: 600; color: var(--color-success); margin-right: 8px;">✓ Livrée</span>
                                            <?php else: ?>
                                                <form method="GET" action="<?php echo BASE_URL; ?>/admin/orders/status" style="display:inline;">
                                                    <input type="hidden" name="id" value="<?php echo $order['id']; ?>">
                                                    <select name="status" onchange="this.form.submit()" class="btn" style="padding: 6px 10px; font-size: 11px; width: auto; background: var(--color-neutral-95); border: 1px solid var(--border-subtle); color: var(--text-main); font-weight: 600;">
                                                        <option value="en cours" <?php echo $order['status'] == 'en cours' ? 'selected' : ''; ?>>En cours</option>
                                                        <option value="livree">Livrée</option>
                                                    </select>
                                                </form>
                                            <?php endif; ?>
                                            <a href="<?php echo BASE_URL; ?>/admin/orders/delete?id=<?php echo $order['id']; ?>" class="btn btn-danger" style="padding: 6px 10px; background: white; border: 1px solid var(--color-danger-86); color: var(--color-danger);" onclick="return confirm('Confirmer la suppression ?')">
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('.search-bar input');
            const tableRows = document.querySelectorAll('.data-table tbody tr');

            searchInput.addEventListener('input', function(e) {
                const term = e.target.value.toLowerCase();
                
                tableRows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(term) ? '' : 'none';
                });
            });
        });
    </script>
</body>
</html>
