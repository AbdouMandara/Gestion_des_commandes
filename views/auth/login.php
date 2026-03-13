<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | GestionPro</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-brand" style="margin-bottom: 24px;">
                <h1 style="color: var(--color-primary-10); font-weight: 700;">GestionPro</h1>
                <p style="color: var(--text-muted); font-size: 14px; margin-top: 4px;">Connectez-vous à votre espace</p>
            </div>

            <?php if (isset($error)): ?>
                <div class="badge badge-danger" style="display: block; text-align: center; margin-bottom: 24px; padding: 12px; font-weight: 500;">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form action="<?php echo BASE_URL; ?>/login" method="POST">
                <div class="form-group">
                    <label for="username">Identifiant</label>
                    <input type="text" id="username" name="username" required placeholder="Saisissez votre identifiant" autofocus>
                </div>
                <div class="form-group">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                        <label for="password" style="margin-bottom: 0;">Mot de passe</label>
                    </div>
                    <input type="password" id="password" name="password" required placeholder="••••••••">
                </div>
                
                <div style="margin-top: 32px;">
                    <button type="submit" class="btn btn-primary" style="width: 100%; padding: 14px; font-weight: 700; font-size: 14px; letter-spacing: 0.5px;">
                        Se connecter au tableau de bord
                    </button>
                </div>
            </form>

        </div>
    </div>
</body>
</html>
