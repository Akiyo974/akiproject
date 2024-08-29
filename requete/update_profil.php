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

    // Vérifie si un fichier a été téléchargé
    if(isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        // Chemin du répertoire de téléversement
        $uploadDirectory = 'uploads/';

        // Nom du fichier téléversé
        $filename = $_FILES['profile_image']['name'];

        // Chemin complet du fichier téléversé
        $uploadFilePath = $uploadDirectory . $filename;

        // Déplacer le fichier téléversé vers le répertoire de téléversement
        if(move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadFilePath)) {
            // Mettre à jour le chemin de l'image de profil dans la base de données
            $sqlUpdateImage = "UPDATE Profils_Utilisateurs SET image_profil = :image_profil WHERE utilisateur_id = :user_id";
            $stmtUpdateImage = $pdo->prepare($sqlUpdateImage);
            $stmtUpdateImage->bindParam(':image_profil', $uploadFilePath, PDO::PARAM_STR);
            $stmtUpdateImage->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmtUpdateImage->execute();
        } else {
            // Gérer les erreurs de téléversement
            echo "Une erreur s'est produite lors du téléversement du fichier.";
        }
    }

    // Requête pour mettre à jour les autres informations du profil dans la base de données
    $sqlUpdateProfile = "UPDATE Utilisateurs u
                        INNER JOIN Profils_Utilisateurs p ON u.id = p.utilisateur_id
                        SET 
                            u.nom = :nom, 
                            u.prenom = :prenom, 
                            p.bio = :bio, 
                            u.profession = :profession, 
                            u.email = :email 
                        WHERE u.id = :user_id";
    
    // Préparation de la requête
    $stmtUpdateProfile = $pdo->prepare($sqlUpdateProfile);
    
    // Liaison des paramètres
    $stmtUpdateProfile->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
    $stmtUpdateProfile->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
    $stmtUpdateProfile->bindParam(':bio', $_POST['about'], PDO::PARAM_STR);
    $stmtUpdateProfile->bindParam(':profession', $_POST['job'], PDO::PARAM_STR);
    $stmtUpdateProfile->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    $stmtUpdateProfile->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    
    // Exécution de la requête
    $stmtUpdateProfile->execute();

    // Redirection vers la page de profil après la mise à jour
    header("Location: ../profile.php");
    exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
} else {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion ou affichez un message d'erreur
    header("Location: ../login.php");
    exit();
}
?>
