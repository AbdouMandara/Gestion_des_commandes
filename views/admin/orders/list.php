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
                    <li><a href="<?php echo BASE_URL; ?>/admin/settings"><span class="material-symbols-rounded">settings</span>Paramètres</a></li>
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
                    <div class="user-info"><p class="user-name"><?php echo htmlspecialchars($username ?? 'Administrateur'); ?></p><p class="user-role">Administrateur</p></div>
                    <div class="avatar"><?php echo strtoupper(substr($username ?? 'A', 0, 1)); ?></div>
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
                                            <button onclick="showOrderDetail(<?php echo $order['id']; ?>)" class="btn" style="padding: 6px 10px; background: white; border: 1px solid var(--border-subtle); color: var(--color-primary-10);" title="Voir le détail">
                                                <span class="material-symbols-rounded" style="font-size: 18px;">visibility</span>
                                            </button>
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

<!-- MODAL DÉTAIL COMMANDE -->
<div id="orderModal" style="display:none; position:fixed; inset:0; z-index:1000; background:rgba(0,0,0,0.45); backdrop-filter:blur(4px); align-items:center; justify-content:center;">
    <div style="background:white; border-radius:16px; width:100%; max-width:620px; max-height:85vh; overflow-y:auto; box-shadow:0 20px 60px rgba(0,0,0,0.25); margin:16px;">
        <div style="display:flex; justify-content:space-between; align-items:center; padding:20px 24px; border-bottom:1px solid #e5e7eb;">
            <div>
                <h2 id="modalTitle" style="font-size:18px; font-weight:800; letter-spacing:-0.5px; margin:0;">Commande #—</h2>
                <p id="modalDate" style="font-size:12px; color:#6b7280; margin:2px 0 0;"></p>
            </div>
            <div style="display:flex; align-items:center; gap:12px;">
                <span id="modalStatus" class="badge"></span>
                <button onclick="closeModal()" style="background:none; border:none; cursor:pointer; color:#6b7280; display:flex; align-items:center;">
                    <span class="material-symbols-rounded" style="font-size:24px;">close</span>
                </button>
            </div>
        </div>
        <div style="padding:24px;">
            <p style="font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#6b7280; margin:0 0 12px;">Produits commandés</p>
            <table style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr style="font-size:11px; text-transform:uppercase; color:#9ca3af; letter-spacing:0.04em;">
                        <th style="text-align:left; padding:0 0 8px;">Produit</th>
                        <th style="text-align:center; padding:0 0 8px;">Qté</th>
                        <th style="text-align:right; padding:0 0 8px;">Prix unit.</th>
                        <th style="text-align:right; padding:0 0 8px;">Sous-total</th>
                    </tr>
                </thead>
                <tbody id="modalItems"></tbody>
            </table>
            <div style="margin-top:16px; padding-top:16px; border-top:2px solid #f3f4f6; display:flex; justify-content:space-between; align-items:center;">
                <span style="font-weight:700; font-size:14px;">Total commande</span>
                <span id="modalTotal" style="font-weight:800; font-size:18px; color:#1e1e2e;"></span>
            </div>
        </div>
    </div>
</div>

<script>
    const BASE = '<?php echo BASE_URL; ?>';
    const statusBadges = { 'en attente': '', 'en cours': 'badge-warning', 'livree': 'badge-success', 'rejetee': 'badge-danger' };
    const statusLabels = { 'en attente': 'En attente', 'en cours': 'En cours', 'livree': 'Livrée', 'rejetee': 'Rejetée' };

    function showOrderDetail(id) {
        fetch(BASE + '/admin/orders/detail?id=' + id)
            .then(r => r.json())
            .then(data => {
                const o = data.order;
                document.getElementById('modalTitle').textContent = 'Commande #' + o.id + (o.client_name ? ' — ' + o.client_name : '');
                document.getElementById('modalDate').textContent = 'Passée le ' + new Date(o.created_at).toLocaleDateString('fr-FR');
                const st = document.getElementById('modalStatus');
                st.textContent = statusLabels[o.status] || o.status;
                st.className = 'badge ' + (statusBadges[o.status] || '');
                document.getElementById('modalTotal').textContent = parseFloat(o.total_amount).toLocaleString('fr-FR', {minimumFractionDigits:2}) + ' FCFA';
                let rows = '';
                data.items.forEach(item => {
                    const sub = (item.price_at_purchase * item.quantity).toFixed(2);
                    rows += `<tr style="border-top:1px solid #f3f4f6;">
                        <td style="padding:10px 0; font-weight:600;">${item.product_name}</td>
                        <td style="text-align:center; color:#6b7280;">${item.quantity}</td>
                        <td style="text-align:right; color:#6b7280;">${parseFloat(item.price_at_purchase).toLocaleString('fr-FR',{minimumFractionDigits:2})} FCFA</td>
                        <td style="text-align:right; font-weight:700;">${parseFloat(sub).toLocaleString('fr-FR',{minimumFractionDigits:2})} FCFA</td>
                    </tr>`;
                });
                document.getElementById('modalItems').innerHTML = rows;
                const modal = document.getElementById('orderModal');
                modal.style.display = 'flex';
            });
    }

    function closeModal() { document.getElementById('orderModal').style.display = 'none'; }
    document.getElementById('orderModal').addEventListener('click', function(e) { if (e.target === this) closeModal(); });
</script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('.header-search input');
            const tableRows = document.querySelectorAll('tbody tr:not(#modalItems *)'); // Exclude modal items if any

            searchInput.addEventListener('input', function(e) {
                const term = e.target.value.toLowerCase().trim();
                
                tableRows.forEach(row => {
                    // Only filter rows that are in the main table body, not the modal
                    if (!row.closest('#orderModal')) {
                        const text = row.textContent.toLowerCase();
                        row.style.display = text.includes(term) ? '' : 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>
