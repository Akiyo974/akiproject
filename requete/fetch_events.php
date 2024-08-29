<?php
require 'db.php'; // Assurez-vous que ce chemin est correct pour inclure votre base de données

// Assurer la session est démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo json_encode([]); // Renvoie un tableau vide si l'utilisateur n'est pas connecté
    exit;
}

$userId = $_SESSION['user_id'];

// Récupérer les événements de la base de données
$stmt = $pdo->prepare("SELECT * FROM Evenements WHERE utilisateur_id = ? AND date_debut BETWEEN ? AND ?");
$stmt->execute([$userId, $_POST['start'], $_POST['end']]);
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Convertir les événements en format attendu par FullCalendar
$result = [];
foreach ($events as $event) {
    $result[] = [
        'title' => $event['titre'],
        'start' => $event['date_debut'],
        'end' => $event['date_fin'],
        'color' => '#00B2A9' // ou une autre couleur basée sur un champ de la base de données
    ];
}

echo json_encode($result);
?>
