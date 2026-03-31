<?php ob_start(); ?>
<section class="composition-detail">
    <p><strong>Nom:</strong> <?php echo htmlspecialchars($composition['name']); ?></p>
    <p><strong>Créé par:</strong> <?php echo htmlspecialchars($composition['username']); ?></p>
    <p><strong>Description:</strong> <?php echo htmlspecialchars($composition['description']); ?></p>
    <p><strong>Créée le:</strong> <?php echo $composition['created_at']; ?></p>

    <h3>Unités de cette composition:</h3>

    <?php if (empty($units)): ?>
        <p>Aucune unité</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Nom</th>
                <th>Santé</th>
                <th>Dégâts</th>
                <th>Armure</th>
                <th>Vitesse</th>
                <th>Coût</th>
                <th>Quantité</th>
            </tr>
            <?php foreach ($units as $u): ?>
                <tr>
                    <td><?php echo htmlspecialchars($u['name']); ?></td>
                    <td><?php echo $u['health']; ?></td>
                    <td><?php echo $u['damage']; ?></td>
                    <td><?php echo $u['armor']; ?></td>
                    <td><?php echo $u['speed']; ?></td>
                    <td><?php echo $u['cost']; ?></td>
                    <td><?php echo $u['quantity']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</section>
<?php $content = ob_get_clean(); include 'views/layout.php'; ?>