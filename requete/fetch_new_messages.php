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
$lastMessageId = isset($_POST['lastMessageId']) ? $_POST['lastMessageId'] : 0;

$sql = "SELECT m.*, u.prenom, u.nom 
        FROM Messages m 
        JOIN Utilisateurs u ON m.expediteur_id = u.id 
        WHERE ((m.destinataire_id = ? AND m.expediteur_id = ?) OR (m.expediteur_id = ? AND m.destinataire_id = ?))
        AND m.id > ?
        ORDER BY m.date_envoi ASC";

$stmt = $pdo->prepare($sql);
$stmt->execute([$currentUserId, $otherUserId, $otherUserId, $currentUserId, $lastMessageId]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

$html = '';
foreach ($messages as $message) {
    $sender = htmlspecialchars($message['prenom'] . ' ' . $message['nom']);
    $text = htmlspecialchars($message['texte']);
    $date = htmlspecialchars($message['date_envoi']);
    $isSeen = ($message['expediteur_id'] == $currentUserId && $message['is_seen']) ? '<span class="seen-indicator">Lu</span>' : '';
    $messageClass = $message['expediteur_id'] == $currentUserId ? 'sent' : 'received';
    $html .= '<div class="message ' . $messageClass . '" id="message-' . $message['id'] . '"><strong>' . $sender . ':</strong> ' . $text . '<br><small>' . $date . ' ' . $isSeen . '</small></div>';
}

echo json_encode(['html' => $html, 'lastMessageId' => end($messages)['id']]);
?>
