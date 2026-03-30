<?php
$content = '
<section class="compositions">
    <h2>Mes Compositions</h2>
    <a href="index.php?page=compositions_create" class="btn">+ Créer une composition</a>
    
    <div class="compositions-list">
' . (empty($compositions) ? '<p>Aucune composition</p>' : implode('', array_map(fn($c) => '
        <div class="composition-card">
            <h3>' . htmlspecialchars($c['name']) . '</h3>
            <p>' . htmlspecialchars($c['description']) . '</p>
            <p>Créée le: ' . $c['created_at'] . '</p>
            <div class="composition-actions">
                <a href="index.php?page=compositions_detail&id=' . $c['id'] . '" class="btn">Consulter</a>
                <a href="index.php?page=compositions_edit&id=' . $c['id'] . '" class="btn-edit">Modifier</a>
                <a href="index.php?page=compositions_delete&id=' . $c['id'] . '" class="btn-delete" onclick="return confirm(\'Êtes-vous sûr ?\')">Supprimer</a>
            </div>
        </div>
', $compositions))) . '
    </div>
</section>
';
include 'views/layout.php';
?>