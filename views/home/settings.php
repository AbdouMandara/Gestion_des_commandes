<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Paramètres | GestionPro</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body class="bg-main">
    <div class="container" style="max-width: 800px; padding-top: var(--space-5);">
        <header style="margin-bottom: var(--space-5); display: flex; align-items: center; justify-content: space-between;">
            <div style="display: flex; align-items: center; gap: var(--space-3);">
                <a href="<?php echo BASE_URL; ?>/" class="avatar" style="width: 40px; height: 40px; background: white; border: 1px solid var(--border-subtle); color: var(--text-main); text-decoration: none;">
                    <span class="material-symbols-rounded" style="font-size: 20px;">arrow_back</span>
                </a>
                <div>
                    <h1 style="font-size: 28px; font-weight: 800; letter-spacing: -1px; margin-bottom: 2px;">Mes Paramètres</h1>
                    <p class="text-muted">Gérez vos informations personnelles et votre compte.</p>
                </div>
            </div>
        </header>

        <?php if (isset($_GET['success'])): ?>
            <div class="badge badge-success" style="display: block; text-align: center; padding: var(--space-3); margin-bottom: var(--space-4); border-radius: var(--radius-md);">
                Votre profil a été mis à jour avec succès !
            </div>
        <?php endif; ?>

        <div class="form-card" style="max-width: 100%; margin: 0; padding: var(--space-5);">
            <form action="<?php echo BASE_URL; ?>/settings" method="POST">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--space-4);">
                    <div class="form-group">
                        <label for="name">Nom complet / Entreprise</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($client['name']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Adresse Email</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($client['email']); ?>" required>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--space-4);">
                    <div class="form-group">
                        <label for="phone">Téléphone</label>
                        <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($client['phone']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Nouveau mot de passe (pas obligatoire)</label>
                        <input type="password" id="password" name="password" placeholder="••••••••">
                    </div>
                </div>

                <div class="form-group">
                    <label for="address">Adresse de livraison</label>
                    <textarea id="address" name="address" rows="3"><?php echo htmlspecialchars($client['address']); ?></textarea>
                </div>

                <div class="form-actions" style="margin-top: var(--space-4);">
                    <button type="submit" class="btn btn-primary" style="flex: 2; padding: 14px; font-weight: 700;">Enregistrer les modifications</button>
                    <a href="<?php echo BASE_URL; ?>/" class="btn btn-secondary" style="flex: 1; padding: 14px; text-align: center; background: white; border: 1px solid var(--border-subtle); color: var(--text-main);">Annuler</a>
                </div>
            </form>
        </div>

        <footer style="margin-top: var(--space-8); text-align: center; color: var(--text-muted); font-size: 12px;">
            <p>&copy; <?php echo date('Y'); ?> GestionPro • Espace Sécurisé</p>
        </footer>
    </div>

    <!-- Password Confirmation Modal -->
    <div id="password-modal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-icon">
                    <span class="material-symbols-rounded">lock</span>
                </div>
                <h2>Confirmer les modifications</h2>
                <p>Veuillez saisir votre mot de passe actuel pour valider les changements.</p>
            </div>
            <div class="modal-body">
                <div id="modal-error-msg" class="modal-error">Le mot de passe est incorrect</div>
                <input type="password" id="password-confirm-input" placeholder="••••••••" autocomplete="current-password">
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-confirm-password" class="btn">Confirmer et enregistrer</button>
                <button type="button" id="btn-cancel-modal" class="btn btn-ghost">Annuler</button>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const settingsForm = document.querySelector('form');
        const modal = document.getElementById('password-modal');
        const passwordInput = document.getElementById('password-confirm-input');
        const confirmBtn = document.getElementById('btn-confirm-password');
        const cancelBtn = document.getElementById('btn-cancel-modal');
        const errorMsg = document.getElementById('modal-error-msg');
        
        let isPasswordVerified = false;

        if (settingsForm) {
            settingsForm.addEventListener('submit', function(e) {
                if (!isPasswordVerified) {
                    e.preventDefault();
                    modal.classList.add('active');
                    passwordInput.focus();
                }
            });
        }

        cancelBtn.addEventListener('click', function() {
            modal.classList.remove('active');
            passwordInput.value = '';
            errorMsg.style.display = 'none';
        });

        confirmBtn.addEventListener('click', async function() {
            const password = passwordInput.value;
            if (!password) {
                showError('Veuillez saisir votre mot de passe');
                return;
            }

            confirmBtn.classList.add('loading');
            confirmBtn.innerText = 'Vérification...';
            errorMsg.style.display = 'none';

            try {
                const formData = new FormData();
                formData.append('password', password);

                const response = await fetch('<?php echo BASE_URL; ?>/verify-password', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    isPasswordVerified = true;
                    settingsForm.submit();
                } else {
                    showError(data.error || 'Le mot de passe est incorrect');
                }
            } catch (error) {
                showError('Une erreur est survenue lors de la vérification');
            } finally {
                confirmBtn.classList.remove('loading');
                confirmBtn.innerText = 'Confirmer et enregistrer';
            }
        });

        function showError(msg) {
            errorMsg.innerText = msg;
            errorMsg.style.display = 'block';
            passwordInput.value = '';
            passwordInput.focus();
        }
        
        passwordInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                confirmBtn.click();
            }
        });
    });
    </script>
</body>
</html>
