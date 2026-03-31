<?php
$content = '
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
' . implode('', array_map(fn($u) => '
        <tr>
            <td>' . htmlspecialchars($u['name']) . '</td>
            <td>' . $u['health'] . '</td>
            <td>' . $u['damage'] . '</td>
            <td>' . $u['armor'] . '</td>
            <td>' . $u['speed'] . '</td>
            <td>' . $u['cost'] . '</td>
            <td>
                <a href="index.php?page=units_edit&id=' . $u['id'] . '" class="btn-edit">Modifier</a>
                <a href="index.php?page=units_delete&id=' . $u['id'] . '" class="btn-delete" onclick="return confirm(\'Êtes-vous sûr ?\')">Supprimer</a>
            </td>
        </tr>
', $units)) . '
    </table>
</section>
';
include 'views/layout.php';
?>