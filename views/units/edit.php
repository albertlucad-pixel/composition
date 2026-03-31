<?php ob_start(); ?>
<section class="units">
    <h2>Modifier une Unité</h2>
    <form method="POST">
        <label>Nom de l'unité:</label>
        <select name="name" required>
            <option value="">-- Sélectionner une unité --</option>
            <?php foreach ($predefinedNames as $name): ?>
                <option value="<?php echo htmlspecialchars($name); ?>"
                    <?php echo ($unit['name'] === $name) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($name); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="number" name="health" placeholder="Santé" value="<?php echo htmlspecialchars($unit['health']); ?>" required>
        <input type="number" name="damage" placeholder="Dégâts" value="<?php echo htmlspecialchars($unit['damage']); ?>" required>
        <input type="number" name="armor" placeholder="Armure" value="<?php echo htmlspecialchars($unit['armor']); ?>" required>
        <input type="number" name="speed" placeholder="Vitesse" value="<?php echo htmlspecialchars($unit['speed']); ?>" required>
        <input type="number" name="cost" placeholder="Coût" value="<?php echo htmlspecialchars($unit['cost']); ?>" required>
        <button type="submit">Mettre à jour</button>
    </form>
</section>
<?php $content = ob_get_clean(); include 'views/layout.php'; ?>