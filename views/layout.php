
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarCraft Compositions</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <h1><a href="index.php">StarCraft Compositions</a></h1>
            <div>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <span>Bienvenue <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    <a href="index.php?page=profile">Profil</a>
                    <a href="index.php?page=logout">Déconnexion</a>
                <?php else: ?>
                    <a href="index.php?page=login">Connexion</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <main>
        <div style="margin-bottom: 20px;">
            <a href="index.php" class="btn">← Accueil</a>
        </div>
        <?php echo $content ?? ''; ?>
    </main>

    <footer>
        <p>&copy; 2026 Compositions</p>
    </footer>
</body>
</html>