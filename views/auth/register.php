<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte | GestionPro</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body class="bg-main" style="display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: var(--space-4);">
    <div style="width: 100%; max-width: 450px;">
        <div style="text-align: center; margin-bottom: var(--space-5); position: relative;">
                    <a href="<?php echo BASE_URL; ?>/" style="position: absolute; top: 16px; left: 16px; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; background: var(--color-neutral-95); border: 1px solid var(--border-subtle); border-radius: 50%; color: var(--text-main); text-decoration: none;" title="Retour à l'accueil">
                <span class="material-symbols-rounded" style="font-size: 20px;">arrow_back</span>
            </a>
            <div style="display: inline-flex; align-items: center; justify-content: center; width: 48px; height: 48px; background: var(--color-neutral-95); border-radius: var(--radius-lg); margin-bottom: var(--space-3); border: 1px solid var(--border-subtle);">
                <span class="material-symbols-rounded" style="color: var(--color-primary-10);">person_add</span>
            </div>
            <h1 style="font-size: 24px; font-weight: 800; letter-spacing: -0.5px; margin-bottom: 2px;">Inscription Client</h1>
            <p class="text-muted">Créez votre profil pour commencer vos achats.</p>
        </div>

        <?php if (isset($error)): ?>
            <div class="badge badge-danger" style="display: block; text-align: center; margin-bottom: var(--space-4); padding: var(--space-3); border-radius: var(--radius-md);">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <div class="form-card" style="padding: var(--space-5);">
            <form action="<?php echo BASE_URL; ?>/register" method="POST">
                <div class="form-group">
                    <label for="name">Nom complet</label>
                    <input type="text" id="name" name="name" required placeholder="BIENI LOIC" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="email">Adresse mail</label>
                    <input type="email" id="email" name="email" required placeholder="nom@entreprise.com" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required placeholder="••••••••">
                </div>

                <div class="form-group">
                    <label for="phone">Téléphone</label>
                    <input type="text" id="phone" name="phone" required placeholder="06 XX XX XX XX" value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
                </div>

                <div class="form-group" style="margin-bottom: var(--space-5);">
                    <label for="address">Adresse de livraison</label>
                    <textarea id="address" name="address" rows="2" required placeholder="123 rue de la Paix..."><?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; font-size: 15px; font-weight: 600;">Valider l'inscription</button>
            </form>
        </div>
        
        <p style="text-align: center; margin-top: var(--space-4); font-size: 14px; color: var(--text-muted);">
            Vous avez déjà un compte ? <a href="<?php echo BASE_URL; ?>/login" style="color: var(--color-primary); font-weight: 600; text-decoration: none;">Connectez-vous</a>
        </p>
    </div>
</body>
</html>
