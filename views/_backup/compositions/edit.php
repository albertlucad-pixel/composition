<?php
$content = '
<section class="compositions">
    <h2>Modifier une Composition</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Nom de la composition" value="' . htmlspecialchars($composition['name']) . '" required>
        <textarea name="description" placeholder="Description">' . htmlspecialchars($composition['description']) . '</textarea>
        
        <div style="margin: 15px 0;">
            <label>
                <input type="checkbox" name="is_private" value="1"' . ($composition['is_private'] ? ' checked' : '') . '>
                Composition privée (non visible publiquement)
            </label>
        </div>
        
        <h3>Sélectionner les unités</h3>
' . implode('', array_map(fn($u) => '
        <div>
            <label>' . htmlspecialchars($u['name']) . '</label>
            <input type="number" name="units[' . $u['id'] . ']" placeholder="Quantité" min="0" value="' . (isset(array_column($compositionUnits, null, 'id')[$u['id']]) ? array_column($compositionUnits, null, 'id')[$u['id']]['quantity'] : 0) . '">
        </div>
', $units)) . '
        
        <button type="submit">Mettre à jour</button>
    </form>
</section>
';
include 'views/layout.php';
?>