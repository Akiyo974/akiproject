<?php
require 'db.php'; // Assurez-vous que ce fichier contient la connexion à votre base de données

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Validation basique pour s'assurer que tous les champs sont remplis
    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['profession'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $profession = htmlspecialchars($_POST['profession']);

        // Préparation de la requête SQL
        $sql = "INSERT INTO Utilisateurs (nom, prenom, email, password, profession) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$nom, $prenom, $email, $password, $profession])) {
            header("Location: connexion.php"); // Redirection vers la page de connexion
            exit();
        } else {
            $error = "Une erreur s'est produite lors de l'inscription.";
        }
    } else {
        $error = "Tous les champs doivent être remplis.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- ======= Styles ======= -->
    <?php
      include '../include/lienCss.php';
    ?>
    <!-- End Styles -->
</head>
<body id="gradient">
<div class="container mt-5">
    <div class="registration-form">
        <h2>Inscrivez-vous</h2>
        <form action="register.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="nom" placeholder="Nom" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="prenom" placeholder="Prénom" required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="profession" placeholder="Profession" required>
            </div>
            <button type="submit" class="btn btn-primary">S'inscrire</button>
        </form>
    </div>
</div>

    <!-- ======= Scripts ======= -->
    <?php
      include '../include/lienScript.php';
    ?>
    <!-- End Scripts -->
</body>
</html>
