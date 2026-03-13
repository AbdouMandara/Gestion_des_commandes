<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Passer une commande - Gestion des Commandes</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        .product-row { display: flex; gap: 10px; margin-bottom: 10px; align-items: flex-end; }
        .product-row > div { flex: 1; }
        .remove-product { background: var(--error-color); color: white; border: none; padding: 10px; border-radius: 6px; cursor: pointer; height: 40px; }
    </style>
</head>
<body>
    <div class="main-content" style="max-width: 800px; margin: 0 auto; padding-top: 50px;">
        <header style="margin-bottom: 40px;">
            <a href="/" style="text-decoration: none; color: var(--text-muted); font-size: 14px;">← Retour</a>
            <h1 style="margin-top: 10px;">Passer une nouvelle commande</h1>
        </header>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: var(--shadow);">
            <form action="/order/create" method="POST" id="order-form">
                <h3 style="margin-bottom: 15px;">Sélectionnez vos produits</h3>
                <div id="product-list">
                    <div class="product-row">
                        <div class="form-group">
                            <label>Produit</label>
                            <select name="products[]" required style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 6px;">
                                <option value="">Choisir un produit</option>
                                <?php foreach ($products as $product): ?>
                                    <option value="<?php echo $product['id']; ?>" <?php echo $product['quantity'] <= 0 ? 'disabled' : ''; ?>>
                                        <?php echo htmlspecialchars($product['name']); ?> (<?php echo number_format($product['price'], 2); ?> €)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group" style="max-width: 120px;">
                            <label>Quantité</label>
                            <input type="number" name="quantities[]" min="1" value="1" required style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 6px;">
                        </div>
                        <button type="button" class="remove-product" style="display:none;">×</button>
                    </div>
                </div>

                <button type="button" id="add-product" class="btn" style="width: auto; padding: 8px 15px; background: #f1f5f9; margin-bottom: 30px; color: var(--text-color); font-weight: 500;">+ Ajouter un produit</button>

                <div style="display: flex; gap: 15px; margin-top: 20px; border-top: 1px solid var(--border-color); padding-top: 20px;">
                    <button type="submit" class="btn btn-primary" style="width: auto; padding: 12px 30px;">Confirmer la commande</button>
                    <a href="/" class="btn" style="width: auto; padding: 12px 30px; background: #eee; text-decoration: none; color: black; text-align: center;">Annuler</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('add-product').addEventListener('click', function() {
            const productList = document.getElementById('product-list');
            const newRow = productList.children[0].cloneNode(true);
            newRow.querySelector('select').value = '';
            newRow.querySelector('input').value = '1';
            const removeBtn = newRow.querySelector('.remove-product');
            removeBtn.style.display = 'block';
            removeBtn.addEventListener('click', () => newRow.remove());
            productList.appendChild(newRow);
        });
    </script>
</body>
</html>
