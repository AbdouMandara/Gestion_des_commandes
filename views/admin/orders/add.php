<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle Commande | GestionPro</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style>
        .product-row { 
            display: grid; 
            grid-template-columns: 2fr 1fr auto; 
            gap: var(--space-3); 
            padding: var(--space-3); 
            background: var(--color-neutral-98); 
            border: 1px solid var(--border-subtle); 
            border-radius: var(--radius-md);
            align-items: end;
        }
    </style>
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
                    <li><a href="<?php echo BASE_URL; ?>/admin/orders" class="active"><span class="material-symbols-rounded">shopping_cart</span>Commandes</a></li>
                    <li style="margin-top: auto; padding-top: var(--space-5);"><a href="<?php echo BASE_URL; ?>/logout" style="color: var(--color-danger);"><span class="material-symbols-rounded">logout</span>Déconnexion</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header class="main-header">
                <div class="header-search">
                    <span class="material-symbols-rounded">search</span>
                    <input type="text" placeholder="Rechercher...">
                </div>
                <div class="user-nav">
                    <div class="user-info"><p class="user-name">Admin Abdel</p><p class="user-role">Administrateur</p></div>
                    <div class="avatar">A</div>
                </div>
            </header>

            <div style="margin-bottom: var(--space-5);">
                <a href="<?php echo BASE_URL; ?>/admin/orders" class="btn btn-secondary" style="padding: 6px 12px; font-size: 11px; margin-bottom: var(--space-2); gap: var(--space-1); background: white; border: 1px solid var(--border-subtle); color: var(--text-main);">
                    <span class="material-symbols-rounded" style="font-size: 18px;">arrow_back</span>
                    Retour à la liste
                </a>
                <h1 style="font-size: 28px; font-weight: 800; letter-spacing: -1px;">Nouvelle Commande</h1>
                <p class="text-muted">Créez une transaction manuelle pour un client.</p>
            </div>

            <?php if (isset($error)): ?>
                <div class="badge badge-danger" style="display: block; text-align: center; padding: var(--space-3); margin-bottom: var(--space-4); border-radius: var(--radius-md);">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <div class="form-card" style="max-width: 850px; margin: 0; padding: var(--space-5);">
                <form action="<?php echo BASE_URL; ?>/admin/orders/add" method="POST" id="order-form">
                    <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: var(--space-4); margin-bottom: var(--space-6);">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label for="client_id">Client destinataire</label>
                            <select id="client_id" name="client_id" required>
                                <option value="">-- Sélectionner un client --</option>
                                <?php foreach ($clients as $client): ?>
                                    <option value="<?php echo $client['id']; ?>"><?php echo htmlspecialchars($client['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label for="status">Statut de la commande</label>
                            <select id="status" name="status" required>
                                <option value="en cours">En cours de traitement</option>
                                <option value="livrée">Livrée</option>
                            </select>
                        </div>
                    </div>

                    <div style="margin-bottom: var(--space-3); display: flex; justify-content: space-between; align-items: center;">
                        <h3 style="font-size: 12px; font-weight: 800; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em;">Lignes de commande</h3>
                        <button type="button" id="add-product-btn" class="btn btn-secondary" style="padding: 8px 12px; font-size: 11px; display: flex; align-items: center; gap: var(--space-1); border: 1px solid var(--border-subtle); background: white;">
                            <span class="material-symbols-rounded" style="font-size: 18px; color: var(--color-primary);">add_circle</span>
                            Ajouter un article
                        </button>
                    </div>

                    <div id="product-list" style="display: flex; flex-direction: column; gap: var(--space-3); margin-bottom: var(--space-6);">
                        <div class="product-row">
                            <div class="form-group" style="margin-bottom: 0;">
                                <label>Article</label>
                                <select name="products[]" required class="product-select" onchange="updateMaxQuantity(this)">
                                    <option value="" data-max="0">-- Choisir un produit --</option>
                                    <?php foreach ($products as $product): ?>
                                        <option value="<?php echo $product['id']; ?>" data-max="<?php echo $product['quantity']; ?>" <?php echo $product['quantity'] <= 0 ? 'disabled' : ''; ?>>
                                            <?php echo htmlspecialchars($product['name']); ?> (<?php echo number_format($product['price'], 2); ?> €) - Stock: <?php echo $product['quantity']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group" style="margin-bottom: 0;">
                                <label>Qté</label>
                                <input type="number" name="quantities[]" min="1" value="1" required class="quantity-input" onchange="validateQuantity(this)" disabled>
                            </div>
                            <button type="button" class="btn btn-danger remove-product" style="display: none; height: 44px; width: 44px; padding: 0; justify-content: center; align-items: center; border: 1px solid var(--border-danger-subtle);">
                                <span class="material-symbols-rounded">delete</span>
                            </button>
                        </div>
                    </div>

                    <div class="form-actions" style="border-top: 1px solid var(--border-subtle); padding-top: var(--space-5);">
                        <button type="submit" class="btn btn-primary" style="flex: 2; padding: 14px; font-weight: 700;">Finaliser la Commande</button>
                        <a href="<?php echo BASE_URL; ?>/admin/orders" class="btn btn-secondary" style="flex: 1; padding: 14px; text-align: center; background: white; border: 1px solid var(--border-subtle); color: var(--text-main);">Annuler</a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        const addBtn = document.getElementById('add-product-btn');
        const productList = document.getElementById('product-list');

        function updateRemoveButtons() {
            const rows = productList.querySelectorAll('.product-row');
            rows.forEach(row => {
                const btn = row.querySelector('.remove-product');
                btn.style.display = rows.length > 1 ? 'flex' : 'none';
            });
        }
        
        function updateMaxQuantity(selectElement) {
            const row = selectElement.closest('.product-row');
            const qtyInput = row.querySelector('.quantity-input');
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            
            if (selectElement.value === "") {
                qtyInput.value = "1";
                qtyInput.max = "";
                qtyInput.disabled = true;
            } else {
                const maxVal = selectedOption.getAttribute('data-max');
                qtyInput.disabled = false;
                qtyInput.max = maxVal;
                qtyInput.value = "1";
            }
        }
        
        function validateQuantity(inputElement) {
            const maxVal = parseInt(inputElement.max, 10);
            const currentVal = parseInt(inputElement.value, 10);
            
            if (currentVal > maxVal) {
                alert("Erreur: La quantité demandée (" + currentVal + ") est supérieure au stock disponible (" + maxVal + ") pour ce produit.");
                inputElement.value = maxVal;
            } else if (currentVal < 1) {
                inputElement.value = 1;
            }
        }

        addBtn.addEventListener('click', () => {
            const rows = productList.querySelectorAll('.product-row');
            const newRow = rows[0].cloneNode(true);
            
            newRow.querySelector('select').value = '';
            
            const qtyInput = newRow.querySelector('input');
            qtyInput.value = '1';
            qtyInput.max = '';
            qtyInput.disabled = true;
            
            newRow.querySelector('.remove-product').addEventListener('click', () => {
                newRow.remove();
                updateRemoveButtons();
            });
            
            productList.appendChild(newRow);
            updateRemoveButtons();
        });

        // Initialize clicks for existing rows
        productList.addEventListener('click', (e) => {
            const removeBtn = e.target.closest('.remove-product');
            if (removeBtn) {
                const rows = productList.querySelectorAll('.product-row');
                if (rows.length > 1) {
                    removeBtn.closest('.product-row').remove();
                    updateRemoveButtons();
                }
            }
        });
    </script>
</body>
</html>
