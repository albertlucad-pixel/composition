<?php ob_start(); ?>
<section class="compositions">
    <h2>Compositions Publiques</h2>

    <div class="compositions-list">
        <?php if (empty($compositions)): ?>
            <p>Aucune composition disponible</p>
        <?php else: ?>
            <?php foreach ($compositions as $c): ?>
                <div class="composition-card">
                    <p><strong>Nom:</strong> <?php echo htmlspecialchars($c['name']); ?></p>
                    <p><strong>Créé par:</strong> <?php echo htmlspecialchars($c['username']); ?></p>
                    <p><strong>Créée le:</strong> <?php echo $c['created_at']; ?></p>
                    <div class="composition-actions">
                        <a href="index.php?page=public_compositions_detail&id=<?php echo $c['id']; ?>" class="btn">Consulter</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>
<?php $content = ob_get_clean(); include 'views/layout.php'; ?>