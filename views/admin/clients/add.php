<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un client - Admin</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="dashboard-layout">
        <aside class="sidebar">
            <h2 style="margin-bottom: 20px;">Admin</h2>
            <nav>
                <ul style="list-style: none;">
                    <li style="margin-bottom: 15px;"><a href="/admin/dashboard" style="color:white; text-decoration: none;">Dashboard</a></li>
                    <li style="margin-bottom: 15px;"><a href="/admin/clients" style="color:white; text-decoration: none;">Clients</a></li>
                    <li style="margin-bottom: 15px;"><a href="/logout" style="color:white; text-decoration: none;">Déconnexion</a></li>
                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <h1>Ajouter un nouveau client</h1>
            <div style="max-width: 600px; margin-top: 30px; background: white; padding: 30px; border-radius: 8px; box-shadow: var(--shadow);">
                <form action="/admin/clients/add" method="POST">
                    <div class="form-group">
                        <label for="name">Nom complet</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Téléphone</label>
                        <input type="text" id="phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="address">Adresse</label>
                        <textarea id="address" name="address" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 6px;" rows="4"></textarea>
                    </div>
                    <div style="display: flex; gap: 15px; margin-top: 20px;">
                        <button type="submit" class="btn btn-primary" style="width: auto; padding: 10px 25px;">Enregistrer</button>
                        <a href="/admin/clients" class="btn" style="width: auto; padding: 10px 25px; background: #eee; text-decoration: none; color: black; text-align: center;">Annuler</a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
