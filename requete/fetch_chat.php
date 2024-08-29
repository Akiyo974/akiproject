<?php
require 'db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || !isset($_POST['userID'])) {
    echo json_encode(['error' => 'Données incomplètes.']);
    exit;
}

$currentUserId = $_SESSION['user_id'];
$otherUserId = $_POST['userID'];

$sql = "SELECT m.*, u.prenom, u.nom, p.image_profil 
        FROM Messages m 
        JOIN Utilisateurs u ON m.expediteur_id = u.id 
        LEFT JOIN Profils_Utilisateurs p ON u.id = p.utilisateur_id
        WHERE (m.destinataire_id = ? AND m.expediteur_id = ?) 
           OR (m.expediteur_id = ? AND m.destinataire_id = ?)
        ORDER BY m.date_envoi ASC";

$stmt = $pdo->prepare($sql);
$stmt->execute([$currentUserId, $otherUserId, $currentUserId, $otherUserId]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

$html = '';
$lastMessageId = 0;
foreach ($messages as $message) {
    $sender = htmlspecialchars($message['prenom'] . ' ' . $message['nom']);
    $text = htmlspecialchars($message['texte']);
    $date = htmlspecialchars($message['date_envoi']);
    $isSeen = ($message['expediteur_id'] == $currentUserId && $message['is_seen']) ? '<span class="seen-indicator">Lu</span>' : '';
    $messageClass = $message['expediteur_id'] == $currentUserId ? 'sent' : 'received';
    $html .= '<div class="message ' . $messageClass . '"><strong>' . $sender . ':</strong> ' . $text . '<br><small>' . $date . ' ' . $isSeen . '</small></div>';
    $lastMessageId = $message['id'];
}

echo json_encode(['html' => $html, 'lastMessageId' => $lastMessageId]);
?>
