<?php
$content = '
<section class="units">
    <h2>Modifier une Unité</h2>
    <form method="POST">
        <label>Nom de l\'unité:</label>
        <select name="name" required>
            <option value="">-- Sélectionner une unité --</option>
' . implode('', array_map(fn($name) => '
            <option value="' . htmlspecialchars($name) . '"' . ($unit['name'] === $name ? ' selected' : '') . '>' . htmlspecialchars($name) . '</option>
', $predefinedNames)) . '
        </select>
        
        <input type="number" name="health" placeholder="Santé" value="' . htmlspecialchars($unit['health']) . '" required>
        <input type="number" name="damage" placeholder="Dégâts" value="' . htmlspecialchars($unit['damage']) . '" required>
        <input type="number" name="armor" placeholder="Armure" value="' . htmlspecialchars($unit['armor']) . '" required>
        <input type="number" name="speed" placeholder="Vitesse" value="' . htmlspecialchars($unit['speed']) . '" required>
        <input type="number" name="cost" placeholder="Coût" value="' . htmlspecialchars($unit['cost']) . '" required>
        <button type="submit">Mettre à jour</button>
    </form>
</section>
';
include 'views/layout.php';
?>