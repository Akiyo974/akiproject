<?php
// Vérifie si la session n'est pas déjà démarrée
if (session_status() == PHP_SESSION_NONE) {
    // Si elle n'est pas démarrée, démarrez-la
    session_start();
}

// Vérifie si l'utilisateur est connecté en vérifiant s'il y a une variable de session contenant son ID
if(isset($_SESSION['user_id'])) {
    // Si l'utilisateur est connecté, récupérez son ID
    $user_id = $_SESSION['user_id'];

    // Incluez le fichier de connexion à la base de données
    require 'db.php';

    // Vérifie si les champs du formulaire sont définis et non vides
    if(isset($_POST['current_password'], $_POST['new_password'], $_POST['confirm_password']) && !empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
        // Récupère les mots de passe entrés dans le formulaire
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Requête pour récupérer le mot de passe actuel de l'utilisateur à partir de la base de données
        $sql = "SELECT password FROM Utilisateurs WHERE id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifie si le mot de passe actuel correspond à celui entré dans le formulaire
        if(password_verify($current_password, $user['password'])) {
            // Vérifie si le nouveau mot de passe correspond à la confirmation
            if($new_password === $confirm_password) {
                // Hache le nouveau mot de passe
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Requête pour mettre à jour le mot de passe dans la base de données
                $sql_update_password = "UPDATE Utilisateurs SET password = :hashed_password WHERE id = :user_id";
                $stmt_update_password = $pdo->prepare($sql_update_password);
                $stmt_update_password->bindParam(':hashed_password', $hashed_password, PDO::PARAM_STR);
                $stmt_update_password->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $stmt_update_password->execute();

                // Redirection vers la page de profil après la mise à jour du mot de passe
                header("Location: ../profile.php");
                exit();
            } else {
                echo "Les nouveaux mots de passe ne correspondent pas.";
            }
        } else {
            echo "Mot de passe actuel incorrect.";
        }
    } else {
        echo "Tous les champs du formulaire doivent être remplis.";
    }
} else {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion ou affichez un message d'erreur
    header("Location: ../login.php");
    exit();
}
?>
