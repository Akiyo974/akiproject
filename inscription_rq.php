<?php
require 'requete/db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
    $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $profession = filter_input(INPUT_POST, 'profession', FILTER_SANITIZE_STRING);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Email non valide.";
        header("Location: inscription.php");
        exit;
    }

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
        header("Location: inscription.php");
        exit;
    }

    // Vérifier si l'email existe déjà
    $sqlEmail = "SELECT email FROM Utilisateurs WHERE email = ?";
    $stmtEmail = $pdo->prepare($sqlEmail);
    $stmtEmail->execute([$email]);
    if ($stmtEmail->rowCount() > 0) {
        $_SESSION['error'] = "L'adresse email est déjà utilisée par un autre compte.";
        header("Location: inscription.php");
        exit;
    }

    $options = ['cost' => 12];
    $password_hash = password_hash($password, PASSWORD_DEFAULT, $options);
    $sql = "INSERT INTO Utilisateurs (nom, prenom, email, password, profession) VALUES (?, ?, ?, ?, ?)";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nom, $prenom, $email, $password_hash, $profession]);
        header('Location: connexion.php');
        exit;
    } catch (PDOException $e) {
        error_log('Erreur de base de données: ' . $e->getMessage());
        $_SESSION['error'] = "Erreur technique lors de l'inscription.";
        header("Location: inscription.php");
        exit;
    }
} else {
    $_SESSION['error'] = "Token CSRF invalide.";
    header("Location: inscription.php");
    exit;
}
?>
