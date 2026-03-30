<?php
$content = '
<section class="compositions">
    <h2>Compositions Publiques</h2>
    
    <div class="compositions-list">
' . (empty($compositions) ? '<p>Aucune composition disponible</p>' : implode('', array_map(fn($c) => '
        <div class="composition-card">
            <p><strong>Nom:</strong> ' . htmlspecialchars($c['name']) . '</p>
            <p><strong>Créé par:</strong> ' . htmlspecialchars($c['username']) . '</p>
            <p><strong>Créée le:</strong> ' . $c['created_at'] . '</p>
            <div class="composition-actions">
                <a href="index.php?page=public_compositions_detail&id=' . $c['id'] . '" class="btn">Consulter</a>
            </div>
        </div>
', $compositions))) . '
    </div>
</section>
';
include 'views/layout.php';
?>