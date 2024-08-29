<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start(); // Assurez-vous que la session est démarrée
require 'requete/db.php';

// Génération et stockage du token CSRF
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Vérifiez si l'utilisateur est déjà connecté
if (isset($_SESSION['user_id'])) {
    header('Location: workspace.php'); // Redirigez vers workspace.php
    exit; // Arrêtez l'exécution du script
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="16x16" />
    <!-- ======= Styles ======= -->
    <?php include 'include/lienCss.php'; ?>
    <!-- End Styles -->
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
                                        <h5 class="card-title text-center pb-0 fs-4">Créer un compte</h5>
                                        <p class="text-center small">Entrer vos informations pour vous inscrire</p>
                                    </div>

                                    <form action="inscription_rq.php" method="post" class="row g-3 needs-validation" novalidate>
                                    <?php
                                        if (isset($_SESSION['error'])) {
                                            echo '<div class="alert alert-danger" role="alert">'.
                                                    htmlspecialchars($_SESSION['error']).
                                                '</div>';
                                            unset($_SESSION['error']);
                                        }
                                        ?>
                                        <div class="form-group col-12">
                                            <input type="text" class="form-control" name="nom" placeholder="Nom" required>
                                        </div>
                                        <div class="form-group col-12">
                                            <input type="text" class="form-control" name="prenom" placeholder="Prénom" required>
                                        </div>
                                        <div class="form-group col-12">
                                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                                        </div>
                                        <div class="form-group col-12">
                                            <input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
                                        </div>
                                        <div class="form-group col-12">
                                            <input type="password" class="form-control" name="confirm_password" placeholder="Confirmez le mot de passe" required>
                                        </div>
                                        <div class="form-group col-12">
                                            <input type="text" class="form-control" name="profession" placeholder="Profession" required>
                                        </div>
                                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
                                        </div>
                                    </form>
                                    <p class="small mb-0 mt-3">Déjà inscrit? <a href="connexion.php">Connectez-vous</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <!-- ======= Scripts ======= -->
    <?php include 'include/lienScript.php'; ?>
    <!-- End Scripts -->
</body>

</html>
