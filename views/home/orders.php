<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Commandes | GestionPro</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body class="bg-main">
    <div class="container" style="max-width: 1000px; padding-top: var(--space-5);">
        <header style="margin-bottom: var(--space-5); display: flex; align-items: center; justify-content: space-between;">
            <div style="display: flex; align-items: center; gap: var(--space-3);">
                <a href="<?php echo BASE_URL; ?>/" class="avatar" style="width: 40px; height: 40px; background: white; border: 1px solid var(--border-subtle); color: var(--text-main); text-decoration: none;">
                    <span class="material-symbols-rounded" style="font-size: 20px;">arrow_back</span>
                </a>
                <div>
                    <h1 style="font-size: 28px; font-weight: 800; letter-spacing: -1px; margin-bottom: 2px;">Mes Commandes</h1>
                    <p class="text-muted">Suivez l'état de vos achats en temps réel.</p>
                </div>
            </div>
            
            <div style="display: flex; align-items: center; gap: var(--space-2);">
                <a href="<?php echo BASE_URL; ?>/settings" class="avatar" style="width: 40px; height: 40px; background: white; border: 1px solid var(--border-subtle); color: var(--text-main); text-decoration: none;" title="Paramètres">
                    <span class="material-symbols-rounded" style="font-size: 20px;">settings</span>
                </a>
                <?php if (!empty($notifications)): ?>
                <div style="position: relative; display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 50%; background: white; border: 1px solid var(--border-subtle);">
                    <span class="material-symbols-rounded" style="font-size: 20px; color: var(--color-primary-10);">notifications</span>
                    <span style="position: absolute; top: 0; right: 0; width: 10px; height: 10px; background: var(--color-danger); border: 2px solid white; border-radius: 50%;"></span>
                </div>
                <?php endif; ?>
            </div>
        </header>

        <?php if (!empty($notifications)): ?>
        <div style="margin-bottom: var(--space-5); background: white; border: 1px solid var(--border-subtle); border-radius: var(--radius-md); padding: var(--space-3);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--space-3); border-bottom: 1px solid var(--border-subtle); padding-bottom: var(--space-2);">
                <h3 style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted); margin: 0;">Centre de notifications</h3>
                <a href="<?php echo BASE_URL; ?>/notifications/read" style="font-size: 12px; color: var(--color-primary); font-weight: 500; text-decoration: none;">Tout marquer comme lu</a>
            </div>
             <div style="display: flex; flex-direction: column; gap: var(--space-2);">
                <?php foreach ($notifications as $notif): ?>
                    <div style="display: flex; justify-content: space-between; align-items: center; font-size: 13px; padding: var(--space-2); background: var(--color-neutral-95); border-radius: var(--radius-sm);">
                        <span style="flex: 1; font-weight: 500;"><?php echo htmlspecialchars($notif['message']); ?></span>
                        <a href="<?php echo BASE_URL; ?>/notifications/read?id=<?php echo $notif['id']; ?>" class="btn" style="padding: 4px 8px; font-size: 11px; background: white; border: 1px solid var(--border-subtle); display: flex; gap: 4px; align-items: center;">
                            <span class="material-symbols-rounded" style="font-size: 14px;">done</span> Vu
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>N° Commande</th>
                        <th>Date d'émission</th>
                        <th>Montant HT</th>
                        <th>État actuel</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($orders)): ?>
                        <tr>
                            <td colspan="4" style="padding: var(--space-6); text-align: center; color: var(--text-muted); font-weight: 500;">
                                Vous n'avez pas encore passé de commande.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td style="font-weight: 800; color: var(--color-primary-10);">#<?php echo $order['id']; ?></td>
                                <td class="text-muted"><?php echo date('d/m/Y', strtotime($order['created_at'])); ?></td>
                                <td style="font-weight: 700; color: var(--color-primary-10);"><?php echo number_format($order['total_amount'], 2); ?> FCFA</td>
                                <td>
                                    <?php 
                                        $labels = ['livree' => 'Livrée', 'rejetee' => 'Rejetée', 'en cours' => 'En cours', 'en attente' => 'En attente'];
                                        $badges = ['livree' => 'badge-success', 'en cours' => 'badge-warning', 'rejetee' => 'badge-danger'];
                                        $s = $order['status'];
                                    ?>
                                    <span class="badge <?php echo $badges[$s] ?? ''; ?>">
                                        <?php echo $labels[$s] ?? ucfirst($s); ?>
                                    </span>
                                </td>
                                <td class="text-right">
                                    <button onclick="showOrderDetail(<?php echo $order['id']; ?>)" class="btn" style="padding: 6px 10px; background: white; border: 1px solid var(--border-subtle); color: var(--color-primary-10);" title="Voir le détail">
                                        <span class="material-symbols-rounded" style="font-size: 18px;">visibility</span>
                                        Détails
                                    </button>
                                   <?php if ($s === 'livree'): ?>
                                   <button onclick="generatePDF(<?php echo $order['id']; ?>)" class="btn" style="padding: 6px 10px; background: white; border: 1px solid var(--border-subtle); color: var(--color-primary-10);" title="Télécharger le PDF">
                                        <span class="material-symbols-rounded" style="font-size: 18px;">download</span>
                                        PDF
                                    </button>
                                   <?php else: ?>
                                    <button disabled class="btn" style="padding: 6px 10px; background: var(--color-neutral-90); border: 1px solid var(--border-subtle); color: var(--text-muted); cursor: not-allowed;" title="PDF disponible uniquement si livrée">
                                        <span class="material-symbols-rounded" style="font-size: 18px;">download_off</span>
                                        PDF
                                    </button>
                                   <?php endif; ?>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
<script>
    const BASE = '<?php echo BASE_URL; ?>';
    const statusBadges = { 'en attente': '', 'en cours': 'badge-warning', 'livree': 'badge-success', 'rejetee': 'badge-danger' };
    const statusLabels = { 'en attente': 'En attente', 'en cours': 'En cours', 'livree': 'Livrée', 'rejetee': 'Rejetée' };

    function showOrderDetail(id) {
        fetch(BASE + '/orders/detail?id=' + id)
            .then(r => r.json())
            .then(data => {
                if(data.error) { alert(data.error); return; }
                const o = data.order;
                document.getElementById('modalTitle').textContent = 'Commande #' + o.id;
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

    function generatePDF(id) {
        fetch(BASE + '/orders/detail?id=' + id)
            .then(r => r.json())
            .then(data => {
                if(data.error) { alert(data.error); return; }
                const o = data.order;
                
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();
                
                // Helper custom formatter that only uses standard ASCII space (U+0020).
                // jsPDF's base fonts can severely corrupt kerning and character mapping 
                // when given non-breaking spaces like U+202F produced by toLocaleString('fr-FR')
                const formatMoney = (val) => {
                    return Number(val).toFixed(2).replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
                };

                const cleanStr = (str) => {
                    return str ? String(str).replace(/[\u202F\u00A0]/g, ' ') : '';
                };

                // Colors and Styling variables
                const primaryColor = [30, 30, 46];
                
                // Add header info
                doc.setFontSize(22);
                doc.setTextColor(primaryColor[0], primaryColor[1], primaryColor[2]);
                doc.setFont("helvetica", "bold");
                doc.text("GestionPro", 14, 20);
                
                doc.setFontSize(16);
                doc.setFont("helvetica", "normal");
                doc.text("Facture de la commande", 14, 30);
                
                // Add Order details
                doc.setFontSize(11);
                doc.setTextColor(100);
                doc.text(`Commande N° : ${o.id}`, 14, 45);
                
                let dateStr = new Date(o.updated_at || o.created_at).toLocaleDateString('fr-FR');
                doc.text(`Date de livraison : ${cleanStr(dateStr)}`, 14, 52);
                doc.text(`Statut : Livrée`, 14, 59);

                // Build Table
                const tableColumn = ["Produit", "Qté", "Prix unit. (FCFA)", "Sous-total (FCFA)"];
                const tableRows = [];

                data.items.forEach(item => {
                    const prix = parseFloat(item.price_at_purchase);
                    const qte = parseInt(item.quantity);
                    const subtotal = prix * qte;
                    tableRows.push([
                        cleanStr(item.product_name),
                        qte.toString(),
                        formatMoney(prix),
                        formatMoney(subtotal)
                    ]);
                });

                doc.autoTable({
                    startY: 70,
                    head: [tableColumn],
                    body: tableRows,
                    theme: 'striped',
                    headStyles: { fillColor: primaryColor },
                    columnStyles: {
                        1: { halign: 'center' },
                        2: { halign: 'right' },
                        3: { halign: 'right' }
                    }
                });

                // Add Total at the bottom
                const finalY = doc.lastAutoTable.finalY || 70;
                doc.setFontSize(14);
                doc.setTextColor(primaryColor[0], primaryColor[1], primaryColor[2]);
                doc.setFont("helvetica", "bold");
                const totalText = `Total : ${formatMoney(o.total_amount)} FCFA`;
                doc.text(totalText, 14, finalY + 15);

                // Footer
                doc.setFontSize(10);
                doc.setFont("helvetica", "normal");
                doc.setTextColor(150);
                doc.text("Merci pour votre confiance !", 14, finalY + 30);

                // Download the document
                doc.save(`Facture_Commande_${o.id}.pdf`);
            })
            .catch(err => {
                console.error(err);
                alert("Erreur lors de la génération du PDF.");
            });
    }
</script>
</body>
</html>
