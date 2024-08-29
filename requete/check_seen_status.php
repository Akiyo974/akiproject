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

$sql = "SELECT id FROM Messages WHERE expediteur_id = ? AND destinataire_id = ? AND is_seen = 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([$currentUserId, $otherUserId]);
$seenMessages = $stmt->fetchAll(PDO::FETCH_COLUMN);

echo json_encode(['seenMessageIds' => $seenMessages]);
?>
