<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | GestionPro</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body class="auth-body">
    <div class="auth-wrapper">
        <div class="auth-card" style="padding: var(--space-6); position: relative;">
            <a href="<?php echo BASE_URL; ?>/" style="position: absolute; top: 16px; left: 16px; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; background: var(--color-neutral-95); border: 1px solid var(--border-subtle); border-radius: 50%; color: var(--text-main); text-decoration: none;" title="Retour à l'accueil">
                <span class="material-symbols-rounded" style="font-size: 20px;">arrow_back</span>
            </a>

            <div class="auth-brand" style="margin-bottom: var(--space-5); text-align: center; margin-top: 12px;">
                <h1 style="font-size: 32px; font-weight: 800; letter-spacing: -1.5px; margin-bottom: var(--space-1);">Gestion<span>Pro</span></h1>
                <p class="text-muted" style="font-size: 13px;">Système de gestion commerciale premium</p>
            </div>

            <?php if (isset($error)): ?>
                <div class="badge badge-danger" style="display: block; text-align: center; padding: var(--space-3); margin-bottom: var(--space-5); border-radius: var(--radius-md);">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form action="<?php echo BASE_URL; ?>/login" method="POST">
                <div class="form-group" style="margin-bottom: var(--space-4);">
                    <label for="username">Adresse e-mail</label>
                    <input type="text" id="username" name="email" required placeholder="e-mail ..." autofocus>
                </div>
                <div class="form-group" style="margin-bottom: var(--space-5);">
                    <label for="password">Mot de passe sécurisé</label>
                    <input type="password" id="password" name="password" required placeholder="••••••••">
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 14px; font-weight: 800; font-size: 14px; letter-spacing: -0.01em;">
                    Accéder au Dashboard
                </button>
            </form>
            
            <div style="margin-top: var(--space-6); text-align: center; border-top: 1px solid var(--border-subtle); padding-top: var(--space-4);">
                <p class="text-muted" style="font-size: 11px;">&copy; <?php echo date('Y'); ?> GestionPro. Tous droits réservés.</p>
            </div>
        </div>
    </div>
</body>
</html>
