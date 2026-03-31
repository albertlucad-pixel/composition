<?php
$compositionUnitsById = array_column($compositionUnits, null, 'id');
ob_start();
?>
<section class="compositions">
    <h2>Modifier une Composition</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Nom de la composition"
               value="<?php echo htmlspecialchars($composition['name']); ?>" required>
        <textarea name="description" placeholder="Description"><?php echo htmlspecialchars($composition['description']); ?></textarea>

        <div style="margin: 15px 0;">
            <label>
                <input type="checkbox" name="is_private" value="1" <?php echo $composition['is_private'] ? 'checked' : ''; ?>>
                Composition privée (non visible publiquement)
            </label>
        </div>

        <h3>Sélectionner les unités</h3>
        <?php foreach ($units as $u): ?>
            <div>
                <label><?php echo htmlspecialchars($u['name']); ?></label>
                <input type="number" name="units[<?php echo $u['id']; ?>]" placeholder="Quantité" min="0"
                       value="<?php echo isset($compositionUnitsById[$u['id']]) ? $compositionUnitsById[$u['id']]['quantity'] : 0; ?>">
            </div>
        <?php endforeach; ?>

        <button type="submit">Mettre à jour</button>
    </form>
</section>
<?php $content = ob_get_clean(); include 'views/layout.php'; ?>