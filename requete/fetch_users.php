<?php
require 'db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    echo "Utilisateur non connecté.";
    exit;
}

$userId = $_SESSION['user_id'];

$sql = "SELECT u.id, u.nom, u.prenom, COUNT(m.id) AS unread_count
        FROM Utilisateurs u
        LEFT JOIN Messages m ON u.id = m.expediteur_id AND m.destinataire_id = ? AND m.is_read = 0
        WHERE u.id IN (
            SELECT DISTINCT expediteur_id FROM Messages WHERE destinataire_id = ?
            UNION
            SELECT DISTINCT destinataire_id FROM Messages WHERE expediteur_id = ?
        )
        AND u.id != ?
        GROUP BY u.id
        ORDER BY u.prenom, u.nom";

$stmt = $pdo->prepare($sql);
$stmt->execute([$userId, $userId, $userId, $userId]);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

$html = '<ul class="list-group">';
foreach ($users as $user) {
    $blinkClass = $user['unread_count'] > 0 ? 'blink' : '';
    $html .= '<li class="list-group-item user-select ' . $blinkClass . '" data-id="' . $user['id'] . '">' .
             htmlspecialchars($user['prenom'] . ' ' . $user['nom']) .
             ' <span class="unread-count">(' . $user['unread_count'] . ' messages non lus)</span></li>';
}
$html .= '</ul>';

echo $html;
?>
