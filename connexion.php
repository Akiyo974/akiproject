<?php
require 'requete/db.php'; // Assurez-vous que ce fichier contient la connexion à votre base de données
session_start(); // Démarrer la session

// Rediriger si l'utilisateur est déjà connecté
if (isset($_SESSION['user_id'])) {
    header('Location: workspace.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="16x16" />
    <?php include 'include/lienCss.php'; ?>
</head>
<body id="gradient">
    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="d-flex justify-content-center py-4">
                                <a href="index.php" class="logo d-flex align-items-center w-auto">
                                    <img src="images/logo.png" alt="Logo" class="img-fluid">
                                </a>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Connexion</h5>
                                    </div>

                                    <form action="connexion_rq.php" method="post" class="row g-3 needs-validation" novalidate>
                                        <div class="form-group col-12">
                                            <label for="email">Email:</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="password">Mot de passe:</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                                        </div>
                                    </form>
                                    <?php if (isset($_GET['error'])): ?>
                                        <div class="alert alert-danger mt-2" role="alert">
                                            <?php echo htmlspecialchars($_GET['error']); ?>
                                        </div>
                                    <?php endif; ?>
                                    <p class="small mb-0 mt-3">Pas encore inscrit? <a href="inscription.php">S'inscrire</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <?php include 'include/lienScript.php'; ?>
</body>
</html>
