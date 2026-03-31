<?php
$content = '
<section class="composition-detail">
    <p><strong>Nom:</strong> ' . htmlspecialchars($composition['name']) . '</p>
    <p><strong>Créé par:</strong> ' . htmlspecialchars($composition['username']) . '</p>
    <p><strong>Description:</strong> ' . htmlspecialchars($composition['description']) . '</p>
    <p><strong>Créée le:</strong> ' . $composition['created_at'] . '</p>
    
    <h3>Unités de cette composition:</h3>
    
    ' . (empty($units) ? '<p>Aucune unité</p>' : '
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
' . implode('', array_map(fn($u) => '
        <tr>
            <td>' . htmlspecialchars($u['name']) . '</td>
            <td>' . $u['health'] . '</td>
            <td>' . $u['damage'] . '</td>
            <td>' . $u['armor'] . '</td>
            <td>' . $u['speed'] . '</td>
            <td>' . $u['cost'] . '</td>
            <td>' . $u['quantity'] . '</td>
        </tr>
', $units)) . '
    </table>
    ') . '
</section>
';
include 'views/layout.php';
?>