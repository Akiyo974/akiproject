<?php
require 'requete/db.php'; // Assurez-vous que ce fichier contient la connexion à votre base de données

// Vérifiez si les données du formulaire ont été soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collectez les données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Préparez la requête SQL pour vérifier l'email et récupérer le mot de passe
    $sql = "SELECT id, password FROM Utilisateurs WHERE email = ?";

    try {
        // Préparez et exécutez la requête
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        if ($user = $stmt->fetch()) {
            // Vérifiez le mot de passe
            if (password_verify($password, $user['password'])) {
                // Si le mot de passe est correct, démarrez la session et stockez l'ID utilisateur
                session_start();
                $_SESSION['user_id'] = $user['id'];

                // Vérifier si l'utilisateur a déjà un profil
                $id_utilisateur = $user['id'];
                $sql = "SELECT COUNT(*) AS count FROM Profils_Utilisateurs WHERE utilisateur_id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$id_utilisateur]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($row['count'] > 0) {
                    // Rediriger vers la page de l'espace de travail
                    header('Location: workspace.php');
                    exit; // Assurez-vous d'arrêter l'exécution du script après la redirection
                } else {
                    // Rediriger vers la page de création de profil
                    header('Location: create-profile.php');
                    exit; // Assurez-vous d'arrêter l'exécution du script après la redirection
                }
                
            } else {
                // Si le mot de passe est incorrect, redirigez avec un message d'erreur
                header('Location: connexion.php?error=Le mot de passe est incorrect');
                exit();
            }
        } else {
            // Si aucun utilisateur n'est trouvé avec cet email
            header('Location: connexion.php?error=email non trouvé');
            exit();
        }
    } catch (PDOException $e) {
        // Gérez les erreurs de requête SQL ou de connexion
        header("Location: connexion.php?error=" . urlencode($e->getMessage()));
        exit();
    }
}
?>