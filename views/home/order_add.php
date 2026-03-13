<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passer une commande - Gestion des Commandes</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
    <div class="container" style="max-width: 800px;">
        <div style="margin-bottom: 32px;">
            <a href="<?php echo BASE_URL; ?>/" class="btn btn-secondary" style="padding: 6px 16px; font-size: 12px; margin-bottom: 16px; gap: 6px; display: inline-flex; align-items: center;">
                <span class="material-symbols-rounded" style="font-size: 18px;">arrow_back</span>
                Retour
            </a>
            <h1 style="font-size: 28px; font-weight: 800; color: var(--color-primary-10); letter-spacing: -1px;">Passer une commande</h1>
        </div>
        
        <?php if (isset($error)): ?>
            <div class="badge badge-danger" style="display: block; text-align: center; margin-bottom: 24px; padding: 12px;"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="form-card" style="max-width: 800px; margin: 0;">
            <form action="<?php echo BASE_URL; ?>/order/create" method="POST" id="order-form">
                <div style="margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid var(--border-subtle); display: flex; justify-content: space-between; align-items: center;">
                    <h3 style="font-size: 14px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em;">Sélection des produits</h3>
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
                                <option value="">-- Choisir un produit --</option>
                                <?php foreach ($products as $product): ?>
                                    <option value="<?php echo $product['id']; ?>" <?php echo $product['quantity'] <= 0 ? 'disabled' : ''; ?>>
                                        <?php echo htmlspecialchars($product['name']); ?> (<?php echo number_format($product['price'], 2); ?> €)
                                    </option>
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
                    <button type="submit" class="btn btn-primary" style="flex: 2; padding: 14px;">Confirmer la commande</button>
                    <a href="<?php echo BASE_URL; ?>/" class="btn btn-secondary" style="flex: 1; padding: 14px; text-align: center;">Annuler</a>
                </div>
            </form>
        </div>
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
            newRow.querySelector('select').value = '';
            newRow.querySelector('input').value = '1';
            newRow.querySelector('.remove-product').addEventListener('click', () => {
                newRow.remove();
                updateRemoveButtons();
            });
            productList.appendChild(newRow);
            updateRemoveButtons();
        });

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
