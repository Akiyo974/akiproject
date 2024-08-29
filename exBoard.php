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
    <title>AkiProject - Mon Board</title>
    <!-- ======= Styles ======= -->
    <link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="16x16" />
    <?php
    include 'include/lienCss.php';
    ?>
    <style>
        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .blink {
            animation: blink 1s step-start 0s infinite;
        }

        .seen-indicator {
            color: green;
            font-size: 0.8em;
            margin-left: 10px;
        }
    </style>
    <!-- End Styles -->
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
    <!-- End Sidebar -->
    <!-- ======= Main Content ======= -->
    <main id="main" class="mainHeader" style="height: 100%;">
        <div class="container-fluid mt-5" style="background-color: #fefefe;">
            <div class="pagetitle">
                <h1>Mon board</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="workspace.php">Home</a></li>
                        <li class="breadcrumb-item"><?php echo ucfirst($user['prenom']); ?></li>
                        <li class="breadcrumb-item active">Mon board</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-tabs nav-fill">
                        <li class="nav-item">
                            <a class="nav-link active" href="#board" data-bs-toggle="tab"><i
                                    class="bi bi-clipboard"></i> Board</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#chat" data-bs-toggle="tab"><i class="bi bi-chat-left"></i>
                                Conversation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#calendar" data-bs-toggle="tab"><i class="bi bi-calendar"></i>
                                Calendrier</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                                aria-expanded="false"><i class="bi bi-plus-circle"></i> Plus</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Option 1</a></li>
                                <li><a class="dropdown-item" href="#">Option 2</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
    <main id="main" class="main" style="height: 100%;" m-0>

        <!-- Tabs Content -->
        <div class="tab-content">
            <!-- desactive le div -->
            <div class="tab-pane fade show active" id="board" disabled>
                <!-- Board content goes here -->
                <?php include 'include/board.php'; ?>
            </div>
            <div class="tab-pane fade" id="chat" disabled>
                <!-- Settings content goes here -->
                <?php include 'chat.php'; ?>
            </div>
            <div class="tab-pane fade" id="calendar" disabled>
                <!-- Calendar content goes here -->
                <?php include 'include/calendar.php'; ?>
            </div>
        </div>
    </main>





    <!-- End Main Content -->
    <!-- ======= Scripts ======= -->
    <?php
    include 'include/lienScript.php';
    ?>
<script>
    $(document).ready(function () {
        let currentUserId = null;
        let lastMessageId = 0;
        let pollingInterval = null;

        function loadUserList() {
            $.ajax({
                url: 'requete/fetch_users.php',
                method: 'GET',
                success: function (response) {
                    $('#userList').html(response);
                },
                error: function () {
                    $('#userList').html('<p>Impossible de charger les utilisateurs.</p>');
                }
            });
        }

        loadUserList();

        function loadChatHistory(userID) {
            $.ajax({
                url: 'requete/fetch_chat.php',
                method: 'POST',
                data: { userID: userID },
                dataType: 'json',
                success: function (response) {
                    $('#activeChat').html(response.html).show();
                    $('#messageInputContainer').show();
                    $('#sendMessageBtn').data('user-id', userID);
                    $('#activeChat').scrollTop($('#activeChat')[0].scrollHeight);
                    lastMessageId = response.lastMessageId || 0;

                    // Marquer les messages comme lus après le chargement de l'historique
                    markMessagesAsRead(userID);
                }
            });
        }

        function markMessagesAsRead(userID) {
            $.ajax({
                url: 'requete/mark_messages_read.php',
                method: 'POST',
                data: { otherUserId: userID },
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        $('.user-select[data-id="' + userID + '"]').find('.unread-count').text('(0 messages non lus)');
                    }
                },
                error: function () {
                    alert('Erreur lors de la mise à jour des messages.');
                }
            });
        }

        function pollNewMessages(userID) {
            $.ajax({
                url: 'requete/fetch_new_messages.php',
                method: 'POST',
                data: { userID: userID, lastMessageId: lastMessageId },
                dataType: 'json',
                success: function (response) {
                    if (response.html) {
                        $('#activeChat').append(response.html);
                        $('#activeChat').scrollTop($('#activeChat')[0].scrollHeight);
                        lastMessageId = response.lastMessageId;
                    }

                    // Vérifier les messages pour voir s'ils ont été vus
                    checkSeenStatus(userID);
                }
            });
        }

        function checkSeenStatus(userID) {
            $.ajax({
                url: 'requete/check_seen_status.php',
                method: 'POST',
                data: { userID: userID },
                dataType: 'json',
                success: function (response) {
                    if (response.seenMessageIds) {
                        response.seenMessageIds.forEach(function (messageId) {
                            $('#message-' + messageId + ' .seen-indicator').remove(); // Enlever les indicateurs "Lu" précédents
                            $('#message-' + messageId).append('<span class="seen-indicator">Lu</span>');
                        });
                    }
                }
            });
        }

        $(document).on('click', '.user-select', function () {
            clearInterval(pollingInterval);
            currentUserId = $(this).data('id');

            // Charger l'historique des messages
            loadChatHistory(currentUserId);

            // Démarrer le polling pour les nouveaux messages
            pollingInterval = setInterval(function () {
                pollNewMessages(currentUserId);
            }, 5000); // Vérifier les nouveaux messages toutes les 5 secondes
        });

        $(document).on('click', '#sendMessageBtn', function () {
            var userID = $(this).data('user-id');
            var message = $('#messageInput').val();
            if (!message) {
                alert('Veuillez entrer un message.');
                return;
            }
            $.ajax({
                url: 'requete/send_message.php',
                method: 'POST',
                data: { userID: userID, message: message },
                success: function (response) {
                    if (response === "Message envoyé.") {
                        $('#activeChat').append('<div class="message sent" id="message-' + lastMessageId + '"><strong>Vous:</strong> ' + message + '<br><small>Maintenant</small></div>');
                        $('#messageInput').val('');
                        $('#activeChat').scrollTop($('#activeChat')[0].scrollHeight);
                        lastMessageId++; // Incrémente l'ID du dernier message envoyé
                    } else {
                        alert('Erreur lors de l\'envoi du message.');
                    }
                },
                error: function () {
                    alert('Erreur lors de l\'envoi du message.');
                }
            });
        });

        // Gestionnaire de clic pour le bouton "Nouvelle conversation"
        $(document).on('click', '#newConversationBtn', function () {
            $.ajax({
                url: 'requete/fetch_all_users.php',
                method: 'GET',
                success: function (response) {
                    $('#userList').html(response);
                },
                error: function () {
                    $('#userList').html('<p>Impossible de charger les utilisateurs.</p>');
                }
            });
        });
    });
</script>
    <script>
        $(document).ready(function () {
            const daysInWeek = 7;
            const daysToShow = 6;

            function generateCalendar() {
                const calendarHeader = $('#calendar-header');
                const calendarBody = $('#calendar-body');
                const today = new Date();

                for (let i = 0; i < daysToShow; i++) {
                    const currentDay = new Date(today);
                    currentDay.setDate(today.getDate() + i);

                    const dayHeader = $('<div class="col"></div>').text(currentDay.toLocaleDateString('fr-FR', { weekday: 'long', day: 'numeric', month: 'long' }));
                    const dayColumn = $('<div class="col"></div>');

                    calendarHeader.append(dayHeader);
                    calendarBody.append(dayColumn);

                    // Exemple d'événement pour chaque jour
                    if (i === 0) {
                        const event = $('<div class="event">Faire l\'inventaire</div>');
                        dayColumn.append(event);
                    } else if (i === 1) {
                        const event = $('<div class="event">Coder le site</div>');
                        dayColumn.append(event);
                    } else if (i === 2) {
                        const event = $('<div class="event">Réunion avec l\'équipe</div>');
                        dayColumn.append(event);
                    }
                }
            }

            generateCalendar();
        });
    </script>


</body>

</html>