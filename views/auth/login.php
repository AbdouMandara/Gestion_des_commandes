<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Gestion des Commandes</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-card">
            <header style="border-bottom: none; justify-content: center; margin-bottom: 10px;">
                <h1 style="color: var(--color-primary); font-size: 32px;">Gestion Pro</h1>
            </header>
            <p style="text-align: center; margin-bottom: 30px; color: var(--text-muted);">Connectez-vous pour gérer vos commandes.</p>
            
            <?php if (isset($error)): ?>
                <div class="badge badge-danger" style="display: block; text-align: center; margin-bottom: 20px; padding: 12px; border-radius: var(--radius-md);"><?php echo $error; ?></div>
            <?php endif; ?>
 
            <form action="<?php echo BASE_URL; ?>/login" method="POST">
                <div class="form-group">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" id="username" name="username" required placeholder="admin">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required placeholder="••••••••">
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%; border-radius: var(--radius-md); padding: 14px; font-weight: 600;">Se connecter</button>
            </form>
        </div>
    </div>
</body>
</html>
