<?php
require 'db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['unreadMessagesCount' => 0, 'unreadMessages' => []]);
    exit;
}

$userId = $_SESSION['user_id'];
$unreadMessagesCount = getUnreadMessagesCount($userId);
$unreadMessages = getUnreadMessages($userId);

$response = [
    'unreadMessagesCount' => $unreadMessagesCount,
    'unreadMessages' => array_map(function($message) {
        return [
            'prenom' => $message['prenom'],
            'nom' => $message['nom'],
            'texte' => $message['texte'],
            'date_envoi' => date('H:i', strtotime($message['date_envoi'])),
        ];
    }, $unreadMessages),
];

echo json_encode($response);
?>
