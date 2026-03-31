<?php ob_start(); ?>
<section class="home">
    <h2>Accueil</h2>
    <p>Bienvenue sur StarCraft Compositions</p>

    <?php if (isset($_SESSION['user_id'])): ?>
        <nav class="links">
            <a href="index.php?page=compositions">Mes Compositions</a>
            <a href="index.php?page=compositions_create">Créer une Composition</a>
            <a href="index.php?page=units">Gestion des Unités</a>
            <a href="index.php?page=public_compositions">Voir les compositions publiques</a>
        </nav>
    <?php else: ?>
        <p>Veuillez vous connecter pour accéder aux compositions</p>
        <div style="margin-top: 15px;">
            <a href="index.php?page=public_compositions" class="btn">Voir les compositions publiques</a>
        </div>
    <?php endif; ?>
</section>
<?php $content = ob_get_clean(); include 'views/layout.php'; ?>