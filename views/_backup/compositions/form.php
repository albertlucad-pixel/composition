<?php
$content = '
<section class="compositions">
    <h2>Créer une Composition</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Nom de la composition" required>
        <textarea name="description" placeholder="Description"></textarea>
        
        <div style="margin: 15px 0;">
            <label>
                <input type="checkbox" name="is_private" value="1">
                Composition privée (non visible publiquement)
            </label>
        </div>
        
        <h3>Sélectionner les unités</h3>
' . implode('', array_map(fn($u) => '
        <div>
            <label>' . htmlspecialchars($u['name']) . '</label>
            <input type="number" name="units[' . $u['id'] . ']" placeholder="Quantité" min="0" value="0">
        </div>
', $units)) . '
        
        <button type="submit">Créer</button>
    </form>
</section>
';
include 'views/layout.php';
?>