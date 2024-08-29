<?php
session_start();
include 'requete/db.php';

$userId = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bio = $_POST['bio'];
    $autresInfos = $_POST['autres_infos'];

    if (isset($_FILES['image_profil']) && $_FILES['image_profil']['error'] == 0) {
        $imageProfil = $_FILES['image_profil']['name'];
        $target = "img/" . basename($imageProfil);

        if (move_uploaded_file($_FILES['image_profil']['tmp_name'], $target)) {
            $imageProfilUrl = 'img/' . $imageProfil;

            $stmt = $pdo->prepare('INSERT INTO Profils_Utilisateurs (utilisateur_id, image_profil, bio, autres_infos) VALUES (?, ?, ?, ?)');
            if ($stmt->execute([$userId, $imageProfilUrl, $bio, $autresInfos])) {
                header('Location: workspace.php');
                exit;
            } else {
                $error = "Erreur lors de la création du profil.";
            }
        } else {
            $error = "Erreur lors du téléchargement de l'image.";
        }
    } else {
        $error = "Aucune image téléchargée ou erreur de fichier.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de Profil</title>
    <?php include 'include/lienCss.php'; ?>
</head>
<body id="gradient">
    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Création de votre profil</h5>
                                    </div>

                                    <form action="create-profile.php" method="post" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                                        <?php if (!empty($error)): ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?php echo $error; ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="col-12">
                                            <label for="image_profil">Image de profil :</label>
                                            <input type="file" class="form-control" id="image_profil" name="image_profil" accept=".png, .jpg" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="bio">Biographie :</label>
                                            <textarea class="form-control" id="bio" name="bio" required></textarea>
                                        </div>
                                        <div class="col-12">
                                            <label for="autres_infos">Autres informations :</label>
                                            <textarea class="form-control" id="autres_infos" name="autres_infos"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary w-100">Créer le profil</button>
                                        </div>
                                    </form>
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
