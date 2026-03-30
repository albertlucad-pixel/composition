<?php
$content = '
<section class="units">
    <h2>Créer une Unité</h2>
    <form method="POST">
        <label>Nom de l\'unité:</label>
        <select name="name" required>
            <option value="">-- Sélectionner une unité --</option>
' . implode('', array_map(fn($name) => '
            <option value="' . htmlspecialchars($name) . '">' . htmlspecialchars($name) . '</option>
', $predefinedNames)) . '
        </select>
        
        <input type="number" name="health" placeholder="Santé" required>
        <input type="number" name="damage" placeholder="Dégâts" required>
        <input type="number" name="armor" placeholder="Armure" required>
        <input type="number" name="speed" placeholder="Vitesse" required>
        <input type="number" name="cost" placeholder="Coût" required>
        <button type="submit">Créer</button>
    </form>
</section>
';
include 'views/layout.php';
?>