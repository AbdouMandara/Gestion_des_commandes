<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passer une commande - Gestion des Commandes</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .product-row { display: flex; gap: 15px; margin-bottom: 15px; align-items: flex-end; }
        .product-row > .flex-1 { flex: 1; }
        .product-row > .w-120 { width: 120px; }
        .remove-product { 
            background: var(--color-danger-95); 
            color: var(--color-danger); 
            border: 1px solid var(--color-danger-86); 
            padding: 0 15px; 
            border-radius: var(--radius-md); 
            cursor: pointer; 
            height: 48px; 
            font-size: 20px;
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="container" style="max-width: 800px;">
        <header>
            <div>
                <a href="<?php echo BASE_URL; ?>/" class="btn btn-secondary" style="padding: 5px 10px; font-size: 12px; margin-bottom: 10px;">← Retour</a>
                <h1>Passer une nouvelle commande</h1>
            </div>
        </header>
        
        <?php if (isset($error)): ?>
            <div class="badge badge-danger" style="display: block; text-align: center; margin-bottom: 20px; padding: 12px; border-radius: var(--radius-md);"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="card">
            <form action="<?php echo BASE_URL; ?>/order/create" method="POST" id="order-form">
                <h3 style="margin-bottom: 20px;">Sélectionnez vos produits</h3>
                <div id="product-list">
                    <div class="product-row">
                        <div class="form-group flex-1">
                            <label>Produit</label>
                            <select name="products[]" required>
                                <option value="">Choisir un produit</option>
                                <?php foreach ($products as $product): ?>
                                    <option value="<?php echo $product['id']; ?>" <?php echo $product['quantity'] <= 0 ? 'disabled' : ''; ?>>
                                        <?php echo htmlspecialchars($product['name']); ?> (<?php echo number_format($product['price'], 2); ?> €)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group w-120">
                            <label>Quantité</label>
                            <input type="number" name="quantities[]" min="1" value="1" required>
                        </div>
                        <button type="button" class="remove-product" style="display:none; margin-bottom: 20px;">&times;</button>
                    </div>
                </div>

                <button type="button" id="add-product" class="btn btn-secondary" style="margin-bottom: 30px;">+ Ajouter un produit</button>

                <div style="display: flex; gap: 15px; margin-top: 20px; border-top: 1px solid var(--border-subtle); padding-top: 20px;">
                    <button type="submit" class="btn btn-primary" style="padding: 12px 30px;">Confirmer la commande</button>
                    <a href="<?php echo BASE_URL; ?>/" class="btn btn-secondary" style="padding: 12px 30px;">Annuler</a>
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
            removeBtn.style.display = 'flex';
            removeBtn.addEventListener('click', () => newRow.remove());
            productList.appendChild(newRow);
        });
    </script>
</body>
</html>
