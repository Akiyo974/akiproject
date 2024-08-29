<?php
require 'db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || !isset($_POST['otherUserId'])) {
    echo json_encode(['error' => 'Données incomplètes.']);
    exit;
}

$currentUserId = $_SESSION['user_id'];
$otherUserId = $_POST['otherUserId'];

// Requête pour marquer tous les messages comme lus et vus
$sql = "UPDATE Messages SET is_read = 1, is_seen = 1 WHERE destinataire_id = ? AND expediteur_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$currentUserId, $otherUserId]);

echo json_encode(['success' => 'Messages marqués comme lus et vus.']);
?>
