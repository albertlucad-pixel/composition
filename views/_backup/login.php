<?php
$content = '
<section class="login">
    <h2>Connexion</h2>
    ' . (isset($error) ? '<p class="error">' . htmlspecialchars($error) . '</p>' : '') . '
    <form method="POST">
        <input type="text" name="username" placeholder="Nom d\'utilisateur" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
    </form>
    <p>Test: username=test, password=TestOK20!20</p>
    <div style="margin-top: 15px;">
        <a href="index.php?page=register" class="btn">Créer un compte</a>
    </div>
</section>
';
include 'views/layout.php';
?>