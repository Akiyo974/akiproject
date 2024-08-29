<?php
require 'db.php'; // Assurez-vous que le chemin est correct pour votre script de connexion à la base de données
session_start();

// Vérifiez si l'utilisateur est connecté.
if (!isset($_SESSION['user_id'])) {
    echo "Utilisateur non connecté.";
    exit;
}

$userId = $_SESSION['user_id'];

// Requête pour obtenir tous les utilisateurs sauf l'utilisateur actuel.
$sql = "SELECT id, nom, prenom FROM Utilisateurs WHERE id != ? ORDER BY prenom, nom";
$stmt = $pdo->prepare($sql);
$stmt->execute([$userId]);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Construction du HTML pour afficher la liste des utilisateurs.
$html = '<ul class="list-group">';
foreach ($users as $user) {
    $html .= '<li class="list-group-item user-select" data-id="' . $user['id'] . '">' . htmlspecialchars($user['prenom'] . ' ' . $user['nom']) . '</li>';
}
$html .= '</ul>';

echo $html;
?>
