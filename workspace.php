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
<html lang="en" style="height: 100%;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AkiProject - Workspace</title>
    <!-- ======= Styles ======= -->
    <link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="16x16" />
    <?php
    include 'include/lienCss.php';
    ?>
    <!-- End Styles -->
</head>

<body id="gradient">
    <?php
    $unreadMessagesCount = getUnreadMessagesCount($userId);
    $unreadMessages = getUnreadMessages($userId);
    ?>
    <!-- ======= Header ======= -->
    <?php
    include 'include/header.php';
    ?>
    <!-- End Header -->
    <!-- ======= Sidebar ======= -->
    <?php
    include 'include/side.php';
    ?>
    <!-- End Sidebar -->
    <!-- ======= Main Content ======= -->
    <main id="main" class="main" style="height: 100%;">
        <div class="tata">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <p class="h3"><?php echo date('l j F'); ?></p>
                        <p class="h1">Bonjour,<br> <?php echo ucfirst($user['nom']) . ' ' . ucfirst($user['prenom']); ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Mes Boards</h3>
                            </div>
                            <div class="card-body">
                                <div class="row d-flex align-items-stretch">
                                    <!-- <div class="col-12 col-md-6 col-lg-4">
                                    <div class="card h-100">
                                        <div class="card-header">
                                            <h4 class="card-title">Board 1</h4>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">Description du board 1</p>
                                        </div>
                                        <div class="card-footer">
                                            <a href="board.php" class="btn btn-primary">Voir le board</a>
                                        </div>
                                    </div>
                                </div> -->
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="card h-100">
                                            <div class="card-header">
                                                <h4 class="card-title">Mon board</h4>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">Description du board 2</p>
                                            </div>
                                            <div class="card-footer">
                                                <a href="exBoard.php" class="btn btn-primary">Voir le board</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Déclencheur du modal -->
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div
                                            class="card h-100 d-flex justify-content-center align-items-center opacity-50">
                                            <a class="btn btn-primary btn-lg" data-bs-toggle="modal"
                                                data-bs-target="#boardCreationModal">
                                                <i class="bi bi-plus"></i> Ajouter un board
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Notifications</h3>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item">Notification 1</li>
                                    <li class="list-group-item">Notification 2</li>
                                    <li class="list-group-item">Notification 3</li>
                                    <li class="list-group-item">Notification 4</li>
                                </ul>
                            </div>
                        </div>
                    </div>
<div class="col-12 col-md-6">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Amis</h3>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Ami 1
                    <div>
                        Déconnecté
                        <span class="d-inline-block bg-danger" style="width:10px; height:10px; border-radius:50%; margin-left:5px;"></span>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Ami 2
                    <div>
                        Déconnecté
                        <span class="d-inline-block bg-danger" style="width:10px; height:10px; border-radius:50%; margin-left:5px;"></span>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Ami 3
                    <div>
                        Déconnecté
                        <span class="d-inline-block bg-danger" style="width:10px; height:10px; border-radius:50%; margin-left:5px;"></span>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Ami 4
                    <div>
                        Déconnecté
                        <span class="d-inline-block bg-danger" style="width:10px; height:10px; border-radius:50%; margin-left:5px;"></span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>




                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="boardCreationModal" tabindex="-1" aria-labelledby="boardCreationModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="boardCreationModalLabel">Créer un nouveau tableau</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Fermer"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form starts here -->
                            <form action="create-board.php" method="post">
                                <div class="mb-3">
                                    <label for="boardName" class="form-label">Nom du tableau</label>
                                    <input type="text" class="form-control" id="boardName" name="boardName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="boardDescription" class="form-label">Description</label>
                                    <textarea class="form-control" id="boardDescription" name="boardDescription"
                                        rows="3"></textarea>
                                </div>
                                <!-- Submit button inside the form to handle submission -->
                                <button type="submit" class="btn btn-primary">Créer le tableau</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>



    <!-- End Main Content -->
    <!-- ======= Scripts ======= -->

    <?php
    include 'include/lienScript.php';
    ?>

    <script>
        <script>
            $(document).ready(function() {
                // Charger la liste des utilisateurs
                function loadUserList() {
                    $.ajax({
                        url: 'fetch_users.php', // Script PHP pour récupérer les utilisateurs
                        method: 'GET',
                        success: function (response) {
                            $('#userList').html(response);
                        }
                    });
                }

    // Appel initial pour charger la liste
    loadUserList();

            // Démarrer une nouvelle conversation
            $('#newConversationBtn').click(function() {
                // Afficher une interface pour sélectionner un nouvel utilisateur ou quelque chose de similaire
            });

            // Événement de clic pour chaque utilisateur
            $('#userList').on('click', '.user', function() {
        var userID = $(this).data('id');
            $.ajax({
                url: 'fetch_chat.php', // Script pour charger le chat avec l'utilisateur sélectionné
            method: 'POST',
            data: {userID: userID },
            success: function(response) {
                $('#activeChat').show().html(response);
            }
        });
    });
});
    </script>





    <!-- End Scripts -->
</body>

</html>