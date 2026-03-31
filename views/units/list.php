<?php ob_start(); ?>
<section class="units">
    <h2>Unités</h2>
    <a href="index.php?page=units_create" class="btn">+ Créer une unité</a>

    <table>
        <tr>
            <th>Nom</th>
            <th>Santé</th>
            <th>Dégâts</th>
            <th>Armure</th>
            <th>Vitesse</th>
            <th>Coût</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($units as $u): ?>
            <tr>
                <td><?php echo htmlspecialchars($u['name']); ?></td>
                <td><?php echo $u['health']; ?></td>
                <td><?php echo $u['damage']; ?></td>
                <td><?php echo $u['armor']; ?></td>
                <td><?php echo $u['speed']; ?></td>
                <td><?php echo $u['cost']; ?></td>
                <td>
                    <a href="index.php?page=units_edit&id=<?php echo $u['id']; ?>" class="btn-edit">Modifier</a>
                    <a href="index.php?page=units_delete&id=<?php echo $u['id']; ?>" class="btn-delete"
                       onclick="return confirm('Êtes-vous sûr ?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>
<?php $content = ob_get_clean(); include 'views/layout.php'; ?>