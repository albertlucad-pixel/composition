<?php
$content = '
<section class="register">
    <h2>Créer un compte</h2>
    ' . (isset($error) ? '<p class="error">' . htmlspecialchars($error) . '</p>' : '') . '
    ' . (isset($success) ? '<p class="success">' . htmlspecialchars($success) . '</p>' : '') . '
    <form method="POST">
        <input type="text" name="username" placeholder="Nom d\'utilisateur" minlength="3" required>
        <input type="password" name="password" placeholder="Mot de passe" id="password" required>
        <input type="password" name="password_confirm" placeholder="Confirmer le mot de passe" required>
        <button type="submit">Créer un compte</button>
    </form>
    
    <div style="background: #fff3cd; padding: 15px; border-radius: 5px; margin-top: 20px;">
        <p><strong>Critères du mot de passe fort :</strong></p>
        <ul style="margin: 10px 0; padding-left: 20px;">
            <li>Au minimum 8 caractères</li>
            <li>Au moins 1 lettre majuscule (A-Z)</li>
            <li>Au moins 1 lettre minuscule (a-z)</li>
            <li>Au moins 1 chiffre (0-9)</li>
            <li>Au moins 1 caractère spécial (@$!%*?&)</li>
        </ul>
        <p><strong>Exemple :</strong> MyPass123@</p>
    </div>
    
    <div style="margin-top: 15px;">
        <a href="index.php?page=login" class="btn">Déjà un compte ? Se connecter</a>
    </div>
</section>
';
include 'views/layout.php';
?>