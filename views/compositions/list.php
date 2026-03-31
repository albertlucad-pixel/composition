<?php ob_start(); ?>
<section class="compositions">
    <h2>Mes Compositions</h2>
    <a href="index.php?page=compositions_create" class="btn">+ Créer une composition</a>

    <div class="compositions-list">
        <?php if (empty($compositions)): ?>
            <p>Aucune composition</p>
        <?php else: ?>
            <?php foreach ($compositions as $c): ?>
                <div class="composition-card">
                    <h3><?php echo htmlspecialchars($c['name']); ?></h3>
                    <p><?php echo htmlspecialchars($c['description']); ?></p>
                    <p>Créée le: <?php echo $c['created_at']; ?></p>
                    <div class="composition-actions">
                        <a href="index.php?page=compositions_detail&id=<?php echo $c['id']; ?>" class="btn">Consulter</a>
                        <a href="index.php?page=compositions_edit&id=<?php echo $c['id']; ?>" class="btn-edit">Modifier</a>
                        <a href="index.php?page=compositions_delete&id=<?php echo $c['id']; ?>" class="btn-delete"
                           onclick="return confirm('Êtes-vous sûr ?')">Supprimer</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>
<?php $content = ob_get_clean(); include 'views/layout.php'; ?>