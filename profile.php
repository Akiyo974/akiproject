<?php
require 'requete/db.php';
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Vérification de la variable de session
if (!isset($_SESSION['user_id'])) {
  header('Location: connexion.php');
  exit;
} else {
  $userId = $_SESSION['user_id'];
  $stmt = $pdo->prepare("SELECT * FROM Utilisateurs WHERE id = ?");
  $stmt->execute([$userId]);
  $user = $stmt->fetch();

  if (!$user) {
    // L'utilisateur n'existe pas dans la base de données
    header('Location: connexion.php');
    exit;
  } else {
    // prend les nformation du Profils_utilisateur
    $stmt = $pdo->prepare('SELECT * FROM Profils_Utilisateurs WHERE utilisateur_id = ?');
    $stmt->execute([$userId]);
    $profile = $stmt->fetch();

    if (!$profile) {
      // Si le profil n'existe pas, redirigez vers la page de création de profil
      header('Location: create-profile.php');
      exit;
    } else {
      // Le profil existe, continuer avec le traitement
    }
  }
}

function getUnreadMessagesCount($userId)
{
  global $pdo;
  $stmt = $pdo->prepare("SELECT COUNT(*) FROM Messages WHERE destinataire_id = ? AND is_read = 0");
  $stmt->execute([$userId]);
  return $stmt->fetchColumn();
}

function getUnreadMessages($userId)
{
  global $pdo;
  // Ajout de la jointure avec la table Profils_Utilisateurs pour récupérer l'image_profil
  $stmt = $pdo->prepare("
      SELECT m.*, u.prenom, u.nom, p.image_profil 
      FROM Messages m 
      JOIN Utilisateurs u ON m.expediteur_id = u.id 
      LEFT JOIN Profils_Utilisateurs p ON u.id = p.utilisateur_id
      WHERE m.destinataire_id = ? AND m.is_read = 0 
      ORDER BY m.date_envoi DESC
  ");
  $stmt->execute([$userId]);
  return $stmt->fetchAll();
}


?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AkiProject - Profile</title>
  <!-- ======= Styles ======= -->
  <link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32" />
  <link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="16x16" />
  <?php
  include 'include/lienCss.php';
  ?>
</head>

<body id="gradient">
  <!-- ======= Header ======= -->
  <?php
  $unreadMessagesCount = getUnreadMessagesCount($userId);
  $unreadMessages = getUnreadMessages($userId);
  ?>
  <?php
  include 'include/header.php';
  ?>
  <!-- End Header -->
  <!-- ======= Sidebar ======= -->
  <?php
  include 'include/side.php';
  ?>
  <!-- End Sidebar-->

  <main id="main" class="main">
    <div class="titi">
      <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="workspace.php">Home</a></li>
            <li class="breadcrumb-item"><?php echo ucfirst($user['prenom']); ?></li>
            <li class="breadcrumb-item active">Profile</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
      <section class="section profile">
        <div class="row">
          <div class="col-xl-4">

            <div class="card">
              <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                <a href="#" data-bs-toggle="modal" data-bs-target="#profileImageModal">
                  <img src="<?php echo $profile['image_profil']; ?>" alt="Profile" class="profile-img">
                </a>
                <h2 class="mt-3"><?php echo $user['nom'] . ' ' . $user['prenom']; ?></h2>
                <h3><?php echo $user['profession']; ?></h3>
                <div class="social-links mt-2">
                  <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                  <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                  <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                  <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-8">
            <div class="card">
              <div class="card-body pt-3">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">

                  <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab"
                      data-bs-target="#profile-overview">Aperçu</button>
                  </li>

                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Éditer le
                      Profile</button>
                  </li>

                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Changer le
                      mot
                      de passe</button>
                  </li>

                </ul>
                <div class="tab-content pt-2">

                  <div class="tab-pane fade show active profile-overview" id="profile-overview">
                    <h5 class="card-title">À propos de moi</h5>
                    <!-- met la bio la -->
                    <p class="small fst-italic"><?php echo $profile['bio']; ?></p>

                    <h5 class="card-title">Détails du profile</h5>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Nom complet</div>
                      <div class="col-lg-9 col-md-8"><?php echo $user['nom'] . ' ' . $user['prenom']; ?></div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Travail</div>
                      <div class="col-lg-9 col-md-8"><?php echo $user['profession']; ?></div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Email</div>
                      <div class="col-lg-9 col-md-8"><?php echo $user['email']; ?></div>
                    </div>

                  </div>

                  <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                    <!-- Profile Edit Form -->
                    <form action="requete/update_profil.php" method="POST">
                      <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Image de profile</label>
                        <div class="col-md-8 col-lg-9">
                          <img src="<?php echo $profile['image_profil']; ?>" alt="Profile" class="profile-img">
                          <div class="pt-2">
                            <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i
                                class="bi bi-upload"></i></a>
                            <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i
                                class="bi bi-trash"></i></a>
                          </div>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="Nom" class="col-md-4 col-lg-3 col-form-label">Nom</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="nom" type="text" class="form-control" id="fullName"
                            value="<?php echo $user['nom']; ?>">
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="Prenom" class="col-md-4 col-lg-3 col-form-label">Prénom</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="prenom" type="text" class="form-control" id="Prenom"
                            value="<?php echo $user['prenom']; ?>">
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="about" class="col-md-4 col-lg-3 col-form-label">À propos de moi</label>
                        <div class="col-md-8 col-lg-9">
                          <textarea name="about" class="form-control" id="about"
                            style="height: 100px"><?php echo $profile['bio']; ?></textarea>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="Job" class="col-md-4 col-lg-3 col-form-label">Travail</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="job" type="text" class="form-control" id="Job"
                            value="<?php echo $user['profession']; ?>">
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="email" type="email" class="form-control" id="Email"
                            value="<?php echo $user['email']; ?>">
                        </div>
                      </div>

                      <!-- <div class="row mb-3">
        <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin</label>
        <div class="col-md-8 col-lg-9">
            <input name="linkedin" type="text" class="form-control" id="Linkedin"
                value="https://linkedin.com/#">
        </div>
    </div> -->

                      <div class="text-center">
                        <button type="submit" class="btn btn-primary">Sauvegarder les modifications</button>
                      </div>
                    </form>


                  </div>

                  <div class="tab-pane fade pt-3" id="profile-change-password">
                    <!-- Change Password Form -->
                    <form action="requete/update_mdp.php" method="POST">
                      <div class="row mb-3">
                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Mot de passe
                          actuel</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="current_password" type="password" class="form-control" id="currentPassword"
                            required>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Nouveau mot de passe</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="new_password" type="password" class="form-control" id="newPassword" required>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Confirmer le nouveau mot de
                          passe</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="confirm_password" type="password" class="form-control" id="renewPassword"
                            required>
                        </div>
                      </div>

                      <div class="text-center">
                        <button type="submit" class="btn btn-primary">Changer le mot de passe</button>
                      </div>
                    </form>

                  </div>

                </div><!-- End Bordered Tabs -->

              </div>
            </div>

          </div>
        </div>
      </section>
      <!-- Modal -->
      <div class="modal fade" id="profileImageModal" tabindex="-1" aria-labelledby="profileImageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="profileImageModalLabel">Image de profil</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <img src="<?php echo $profile['image_profil']; ?>" alt="Profile Image" class="img-fluid">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main><!-- End #main -->

  <!-- ======= Scripts ======= -->
  <?php
  include 'include/lienScript.php';
  ?>
  <!-- End Scripts -->
</body>

</html>