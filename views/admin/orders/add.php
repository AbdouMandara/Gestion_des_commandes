<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle commande - Admin</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .product-row { display: flex; gap: 15px; margin-bottom: 15px; align-items: flex-end; }
        .product-row > .flex-1 { flex: 1; }
        .product-row > .w-150 { width: 150px; }
        .remove-product { 
            background: var(--color-danger-95); 
            color: var(--color-danger); 
            border: 1px solid var(--color-danger-86); 
            padding: 0 15px; 
            border-radius: var(--radius-md); 
            cursor: pointer; 
            height: 48px; 
            font-size: 14px;
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body class="admin-body">
    <div class="dashboard-layout">
        <aside class="sidebar">
            <div class="sidebar-header" style="margin-bottom: 40px; padding: 0 16px;">
                <h2 style="color: var(--color-primary-48); font-size: 24px; letter-spacing: -0.5px;">Gestion<span style="color: white;">Pro</span></h2>
            </div>
            <nav>
                <ul class="sidebar-nav">
                    <li>
                        <a href="<?php echo BASE_URL; ?>/admin/dashboard">
                            <span class="material-symbols-rounded">dashboard</span>
                            Tableau de bord
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo BASE_URL; ?>/admin/clients">
                            <span class="material-symbols-rounded">group</span>
                            Clients
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo BASE_URL; ?>/admin/products">
                            <span class="material-symbols-rounded">inventory_2</span>
                            Produits
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo BASE_URL; ?>/admin/orders" class="active">
                            <span class="material-symbols-rounded">shopping_cart</span>
                            Commandes
                        </a>
                    </li>
                    <li style="margin-top: auto; padding-top: 40px;">
                        <a href="<?php echo BASE_URL; ?>/logout" style="color: var(--color-danger-76);">
                            <span class="material-symbols-rounded">logout</span>
                            Déconnexion
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>        <main class="main-content">
            <header class="main-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; padding-bottom: 20px; border-bottom: 1px solid var(--border-subtle);">
                <div class="search-bar" style="position: relative; width: 400px;">
                    <span class="material-symbols-rounded" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 20px;">search</span>
                    <input type="text" placeholder="Rechercher..." style="width: 100%; padding: 12px 12px 12px 48px; border-radius: var(--radius-md); border: 1px solid var(--border-subtle); background: var(--color-neutral-95); font-size: 14px;">
                </div>
                <div class="user-profile" style="display: flex; align-items: center; gap: 16px;">
                    <div style="text-align: right;">
                        <p style="font-weight: 600; font-size: 14px; margin: 0; color: var(--color-primary-10);">Admin Abdel</p>
                        <p style="font-size: 12px; color: var(--text-muted); margin: 0;">Administrateur</p>
                    </div>
                    <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--color-primary); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700;">A</div>
                </div>
            </header>

            <div style="margin-bottom: 32px;">
                <a href="<?php echo BASE_URL; ?>/admin/orders" class="btn btn-secondary" style="padding: 6px 16px; font-size: 12px; margin-bottom: 16px; gap: 6px; display: inline-flex; align-items: center;">
                    <span class="material-symbols-rounded" style="font-size: 18px;">arrow_back</span>
                    Retour à la liste
                </a>
                <h1 style="font-size: 28px; font-weight: 800; color: var(--color-primary-10); letter-spacing: -1px;">Créer une commande</h1>
            </div>
            
            <?php if (isset($error)): ?>
                <div class="badge badge-danger" style="display: block; text-align: center; margin-bottom: 20px; padding: 12px;"><?php echo $error; ?></div>
            <?php endif; ?>

            <div class="form-card" style="max-width: 900px;">
                <form action="<?php echo BASE_URL; ?>/admin/orders/add" method="POST" id="order-form">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 32px;">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label for="client_id">Sélectionner le Client</label>
                            <select id="client_id" name="client_id" required>
                                <option value="">-- Choisir un client --</option>
                                <?php foreach ($clients as $client): ?>
                                    <option value="<?php echo $client['id']; ?>"><?php echo htmlspecialchars($client['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label for="status">Statut Initial</label>
                            <select id="status" name="status" required>
                                <option value="en cours">En cours</option>
                                <option value="livrée">Livrée</option>
                            </select>
                        </div>
                    </div>

                    <div style="margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid var(--border-subtle); display: flex; justify-content: space-between; align-items: center;">
                        <h3 style="font-size: 14px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em;">Produits & Quantités</h3>
                        <button type="button" id="add-product-btn" class="btn btn-secondary" style="padding: 8px 16px; font-size: 12px; display: flex; align-items: center; gap: 8px;">
                            <span class="material-symbols-rounded" style="font-size: 18px;">add_circle</span>
                            Ajouter un produit
                        </button>
                    </div>

                    <div id="product-list" style="display: flex; flex-direction: column; gap: 16px; margin-bottom: 32px;">
                        <div class="product-row" style="display: flex; gap: 16px; align-items: flex-start;">
                            <div class="form-group" style="flex: 2; margin-bottom: 0;">
                                <label>Produit</label>
                                <select name="products[]" required>
                                    <option value="">-- Sélectionner --</option>
                                    <?php foreach ($products as $product): ?>
                                        <option value="<?php echo $product['id']; ?>"><?php echo htmlspecialchars($product['name']); ?> (<?php echo $product['price']; ?> €)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group" style="flex: 1; margin-bottom: 0;">
                                <label>Quantité</label>
                                <input type="number" name="quantities[]" min="1" value="1" required>
                            </div>
                            <div style="padding-top: 24px;">
                                <button type="button" class="btn btn-danger remove-product" style="display: none; height: 44px; width: 44px; padding: 0; justify-content: center; align-items: center;">
                                    <span class="material-symbols-rounded">delete</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary" style="flex: 2; padding: 14px;">Enregistrer la commande</button>
                        <a href="<?php echo BASE_URL; ?>/admin/orders" class="btn btn-secondary" style="flex: 1; padding: 14px; text-align: center;">Annuler</a>
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
            rows.forEach((row, index) => {
                const btn = row.querySelector('.remove-product');
                btn.style.display = rows.length > 1 ? 'flex' : 'none';
            });
        }

        addBtn.addEventListener('click', () => {
            const rows = productList.querySelectorAll('.product-row');
            const newRow = rows[0].cloneNode(true);
            
            // Reset values
            newRow.querySelector('select').value = '';
            newRow.querySelector('input').value = '1';
            
            // Add remove event
            newRow.querySelector('.remove-product').addEventListener('click', () => {
                newRow.remove();
                updateRemoveButtons();
            });
            
            productList.appendChild(newRow);
            updateRemoveButtons();
        });

        // Initialize first row remove button
        document.querySelectorAll('.remove-product').forEach(btn => {
            btn.addEventListener('click', (e) => {
                if (productList.querySelectorAll('.product-row').length > 1) {
                    e.target.closest('.product-row').remove();
                    updateRemoveButtons();
                }
            });
        });
    </script>
</body>
</html>
