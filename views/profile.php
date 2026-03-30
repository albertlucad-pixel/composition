<?php
// Calculer l'ancienneté
$createdAt = new DateTime($user['created_at']);
$now = new DateTime();
$interval = $now->diff($createdAt);

if ($interval->days > 365) {
    $anciennete = floor($interval->days / 365) . ' ans';
} elseif ($interval->days > 30) {
    $anciennete = floor($interval->days / 30) . ' mois';
} elseif ($interval->days > 0) {
    $anciennete = $interval->days . ' jours';
} elseif ($interval->h > 0) {
    $anciennete = $interval->h . ' heures';
} else {
    $anciennete = $interval->i . ' minutes';
}

$content = '
<section class="profile">
    <h2>Mon Profil</h2>
    
    <div style="background: #f9f9f9; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
        <p><strong>Nom d\'utilisateur:</strong> ' . htmlspecialchars($user['username']) . '</p>
        <p><strong>Membre depuis:</strong> ' . $anciennete . ' (depuis le ' . date('d/m/Y', strtotime($user['created_at'])) . ')</p>
    </div>
    
    <h3>Mes Compositions</h3>
    <div style="display: flex; gap: 20px; margin-bottom: 20px;">
        <div style="background: #e3f2fd; padding: 15px; border-radius: 5px; flex: 1;">
            <p><strong>Compositions Publiques:</strong></p>
            <p style="font-size: 24px; color: #1976d2;">' . $publicCount . '</p>
        </div>
        <div style="background: #f3e5f5; padding: 15px; border-radius: 5px; flex: 1;">
            <p><strong>Compositions Privées:</strong></p>
            <p style="font-size: 24px; color: #7b1fa2;">' . $privateCount . '</p>
        </div>
    </div>
    
    <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd;">
        <a href="index.php?page=compositions" class="btn">Mes Compositions</a>
        <a href="index.php?page=delete_account" class="btn-delete" style="margin-left: 10px;" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irreversible et supprimera tous vos compositions.\')">Supprimer mon compte</a>
    </div>
</section>
';
include 'views/layout.php';
?>