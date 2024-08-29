<?php
require 'db.php'; // Assurez-vous que le chemin est correct pour votre script de connexion à la base de données
session_start();

if (!isset($_SESSION['user_id']) || !isset($_POST['userID']) || !isset($_POST['message'])) {
    echo "Données incomplètes.";
    exit;
}

$expediteurId = $_SESSION['user_id'];
$destinataireId = $_POST['userID'];
$message = $_POST['message'];

// Insertion du message dans la base de données
$sql = "INSERT INTO Messages (expediteur_id, destinataire_id, texte) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);
if ($stmt->execute([$expediteurId, $destinataireId, $message])) {
    echo "Message envoyé.";
} else {
    echo "Erreur lors de l'envoi du message.";
}
?>
