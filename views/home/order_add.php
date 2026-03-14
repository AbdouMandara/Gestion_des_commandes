<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passer une commande | GestionPro</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body class="bg-main">
    <div class="container" style="max-width: 800px; padding-top: var(--space-5);">
        <header style="margin-bottom: var(--space-5); display: flex; align-items: center; gap: var(--space-3);">
            <a href="<?php echo BASE_URL; ?>/" class="avatar" style="width: 40px; height: 40px; background: white; border: 1px solid var(--border-subtle); color: var(--text-main); text-decoration: none;">
                <span class="material-symbols-rounded" style="font-size: 20px;">arrow_back</span>
            </a>
            <div>
                <h1 style="font-size: 28px; font-weight: 800; letter-spacing: -1px; margin-bottom: 2px;">Nouvelle Commande</h1>
                <p class="text-muted">Sélectionnez vos articles pour valider votre achat.</p>
            </div>
        </header>
        
        <?php if (isset($error)): ?>
            <div class="badge badge-danger" style="display: block; text-align: center; margin-bottom: var(--space-4); padding: var(--space-2); border-radius: var(--radius-md);">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <div class="form-card" style="max-width: 100%; margin: 0; padding: var(--space-5);">
            <form action="<?php echo BASE_URL; ?>/order/create" method="POST" id="order-form">
                <div style="margin-bottom: var(--space-4); padding-bottom: var(--space-3); border-bottom: 1px solid var(--border-subtle); display: flex; justify-content: space-between; align-items: center;">
                    <h3 style="font-size: 13px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.1em;">Sélection des Produits</h3>
                    <button type="button" id="add-product-btn" class="btn btn-secondary" style="padding: 6px 12px; font-size: 12px; gap: var(--space-1); background: white; border: 1px solid var(--border-subtle); color: var(--text-main);">
                        <span class="material-symbols-rounded" style="font-size: 18px;">add_circle</span>
                        Ajouter un article
                    </button>
                </div>

                <div id="product-list" style="display: flex; flex-direction: column; gap: var(--space-2); margin-bottom: var(--space-5);">
                    <div class="product-row" style="display: flex; gap: var(--space-3); align-items: flex-end;">
                        <div class="form-group" style="flex: 2; margin-bottom: 0;">
                            <label>Produit</label>
                            <select name="products[]" required class="product-select" onchange="updateMaxQuantity(this)">
                                <option value="" data-max="0">-- Choisir un produit --</option>
                                <?php foreach ($products as $product): ?>
                                    <option value="<?php echo $product['id']; ?>" data-max="<?php echo $product['quantity']; ?>" <?php echo $product['quantity'] <= 0 ? 'disabled' : ''; ?>>
                                        <?php echo htmlspecialchars($product['name']); ?> (<?php echo number_format($product['price'], 2); ?> FCFA)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group" style="flex: 1; margin-bottom: 0;">
                            <label>Quantité</label>
                            <input type="number" name="quantities[]" min="1" value="1" required class="quantity-input" onchange="validateQuantity(this)" disabled>
                        </div>
                        <div style="padding-bottom: 0;">
                            <button type="button" class="btn btn-danger remove-product" style="display: none; height: 44px; width: 44px; padding: 0; background: white; border: 1px solid var(--color-danger-86); color: var(--color-danger);">
                                <span class="material-symbols-rounded">delete</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-actions" style="border-top: 1px solid var(--border-subtle); padding-top: var(--space-5); margin-top: 0;">
                    <button type="submit" class="btn btn-primary" style="flex: 2; padding: 14px; font-weight: 700;">Valider et Commander</button>
                    <a href="<?php echo BASE_URL; ?>/" class="btn btn-secondary" style="flex: 1; padding: 14px; text-align: center; background: white; border: 1px solid var(--border-subtle); color: var(--text-main);">Annuler</a>
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
            
            newRow.querySelector('.remove-product').addEventListener('click', (e) => {
                e.target.closest('.product-row').remove();
                updateRemoveButtons();
            });
            productList.appendChild(newRow);
            updateRemoveButtons();
        });

        document.querySelectorAll('.remove-product').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const row = e.target.closest('.product-row');
                if (productList.querySelectorAll('.product-row').length > 1) {
                    row.remove();
                    updateRemoveButtons();
                }
            });
        });
        updateRemoveButtons(); // Call on initial load
    </script>
</body>
</html>
