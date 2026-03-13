<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouvelle commande - Admin</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        .product-row { display: flex; gap: 10px; margin-bottom: 10px; align-items: flex-end; }
        .product-row > div { flex: 1; }
        .remove-product { background: var(--error-color); color: white; border: none; padding: 10px; border-radius: 6px; cursor: pointer; height: 40px; }
    </style>
</head>
<body>
    <div class="dashboard-layout">
        <aside class="sidebar">
            <h2 style="margin-bottom: 20px;">Admin</h2>
            <nav>
                <ul style="list-style: none;">
                    <li style="margin-bottom: 15px;"><a href="/admin/dashboard" style="color:white; text-decoration: none;">Dashboard</a></li>
                    <li style="margin-bottom: 15px;"><a href="/admin/clients" style="color:white; text-decoration: none;">Clients</a></li>
                    <li style="margin-bottom: 15px;"><a href="/admin/products" style="color:white; text-decoration: none;">Produits</a></li>
                    <li style="margin-bottom: 15px;"><a href="/admin/orders" style="color:white; text-decoration: none;">Commandes</a></li>
                    <li style="margin-bottom: 15px;"><a href="/logout" style="color:white; text-decoration: none;">Déconnexion</a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <h1>Créer une nouvelle commande</h1>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger" style="margin-top: 20px;"><?php echo $error; ?></div>
            <?php endif; ?>

            <div style="margin-top: 30px; background: white; padding: 30px; border-radius: 8px; box-shadow: var(--shadow);">
                <form action="/admin/orders/add" method="POST" id="order-form">
                    <div class="form-group" style="max-width: 400px;">
                        <label for="client_id">Client</label>
                        <select name="client_id" id="client_id" required style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 6px;">
                            <option value="">Sélectionnez un client</option>
                            <?php foreach ($clients as $client): ?>
                                <option value="<?php echo $client['id']; ?>"><?php echo htmlspecialchars($client['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <h3 style="margin: 30px 0 15px 0;">Produits</h3>
                    <div id="product-list">
                        <div class="product-row">
                            <div class="form-group">
                                <label>Produit</label>
                                <select name="products[]" required style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 6px;">
                                    <option value="">Choisir un produit</option>
                                    <?php foreach ($products as $product): ?>
                                        <option value="<?php echo $product['id']; ?>" data-price="<?php echo $product['price']; ?>">
                                            <?php echo htmlspecialchars($product['name']); ?> (<?php echo $product['quantity']; ?> en stock)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group" style="max-width: 150px;">
                                <label>Quantité</label>
                                <input type="number" name="quantities[]" min="1" value="1" required style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 6px;">
                            </div>
                            <button type="button" class="remove-product" style="display:none;">Supprimer</button>
                        </div>
                    </div>

                    <button type="button" id="add-product" class="btn" style="width: auto; padding: 8px 15px; background: #e2e8f0; margin-bottom: 30px; color: var(--text-color);">+ Ajouter un autre produit</button>

                    <div style="display: flex; gap: 15px; margin-top: 20px; border-top: 1px solid var(--border-color); padding-top: 20px;">
                        <button type="submit" class="btn btn-primary" style="width: auto; padding: 10px 25px;">Valider la commande</button>
                        <a href="/admin/orders" class="btn" style="width: auto; padding: 10px 25px; background: #eee; text-decoration: none; color: black; text-align: center;">Annuler</a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        document.getElementById('add-product').addEventListener('click', function() {
            const productList = document.getElementById('product-list');
            const newRow = productList.children[0].cloneNode(true);
            
            // Clear values
            newRow.querySelector('select').value = '';
            newRow.querySelector('input').value = '1';
            
            // Show remove button
            const removeBtn = newRow.querySelector('.remove-product');
            removeBtn.style.display = 'block';
            removeBtn.addEventListener('click', function() {
                newRow.remove();
            });
            
            productList.appendChild(newRow);
        });

        // Initialize first row remove button logic (even if hidden)
        document.querySelectorAll('.remove-product').forEach(btn => {
            btn.addEventListener('click', function() {
                if (document.getElementById('product-list').children.length > 1) {
                    btn.closest('.product-row').remove();
                }
            });
        });
    </script>
</body>
</html>
