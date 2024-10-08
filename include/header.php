<?php
require 'requete/db.php';





?>
<header id="header" class="header fixed-top d-flex align-items-center body-bg">

  <div class="d-flex align-items-center justify-content-center">
    <a href="workspace.php" class="logo d-flex align-items-center">
      <img src="images/logo.png" alt="">
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->


  <div class="search-bar">
    <form class="search-form d-flex align-items-center" method="POST" action="#">
      <input type="text" name="query" placeholder="Search" title="Enter search keyword">
      <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
  </div><!-- End Search Bar -->

  <nav class="header-nav ms-auto header-nav">
    <ul class="d-flex align-items-center">

      <li class="nav-item d-block d-lg-none">
        <a class="nav-link nav-icon search-bar-toggle " href="#">
          <i class="bi bi-search"></i>
        </a>
      </li><!-- End Search Icon-->

      <li class="nav-item dropdown">

        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-bell"></i>
          <span class="badge bg-primary badge-number">4</span>
        </a><!-- End Notification Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
          <li class="dropdown-header">
            Vous avez 4 nouvelles notifications
            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">Voir tout</span></a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="notification-item">
            <i class="bi bi-exclamation-circle text-warning"></i>
            <div>
              <h4>Lorem Ipsum</h4>
              <p>Quae dolorem earum veritatis oditseno</p>
              <p>30 min. ago</p>
            </div>
          </li>

          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="notification-item">
            <i class="bi bi-x-circle text-danger"></i>
            <div>
              <h4>Atque rerum nesciunt</h4>
              <p>Quae dolorem earum veritatis oditseno</p>
              <p>1 hr. ago</p>
            </div>
          </li>

          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="notification-item">
            <i class="bi bi-check-circle text-success"></i>
            <div>
              <h4>Sit rerum fuga</h4>
              <p>Quae dolorem earum veritatis oditseno</p>
              <p>2 hrs. ago</p>
            </div>
          </li>

          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="notification-item">
            <i class="bi bi-info-circle text-primary"></i>
            <div>
              <h4>Dicta reprehenderit</h4>
              <p>Quae dolorem earum veritatis oditseno</p>
              <p>4 hrs. ago</p>
            </div>
          </li>

          <li>
            <hr class="dropdown-divider">
          </li>
          <li class="dropdown-footer">
            <a href="#">Show all notifications</a>
          </li>

        </ul><!-- End Notification Dropdown Items -->

      </li><!-- End Notification Nav -->

      <li class="nav-item dropdown">
        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-chat-left-text"></i>
          <?php if ($unreadMessagesCount > 0) { ?>
            <span class="badge bg-success badge-number"><?php echo $unreadMessagesCount; ?></span>
          <?php } ?>
        </a><!-- End Messages Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
          <li class="dropdown-header">
            Vous avez <?php echo $unreadMessagesCount; ?> nouveaux messages
            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">Voir tout</span></a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <?php foreach ($unreadMessages as $message) { ?>
            <li class="message-item message-link" data-user-id="<?php echo $message['expediteur_id']; ?>">
  <a href="#">
    <img src="<?php echo htmlspecialchars($message['image_profil']); ?>" alt="Profile" class="profile-img rounded-circle">
    <div>
      <h4><?php echo htmlspecialchars($message['prenom'] . ' ' . $message['nom']); ?></h4>
      <p><?php echo htmlspecialchars(substr($message['texte'], 0, 50)) . '...'; ?></p>
      <p><?php echo date('H:i', strtotime($message['date_envoi'])); ?> hrs. ago</p>
    </div>
  </a>
</li>

            <li>
              <hr class="dropdown-divider">
            </li>
          <?php } ?>
          <li class="dropdown-footer">
            <a href="#">Voir tous les messages</a>
          </li>

        </ul><!-- End Messages Dropdown Items -->

      </li><!-- End Messages Nav -->


      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="<?php echo $profile['image_profil']; ?>" alt="Profile" class="profile-img rounded-circle">
          <span
            class="d-none d-md-block dropdown-toggle ps-2"><?php echo strtoupper(substr($user['nom'], 0, 1)) . '.' . $user['prenom']; ?></span>
        </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6><?php echo strtoupper($user['nom']) . ' ' . $user['prenom']; ?></h6>
            <span><?php echo $user['profession']; ?></span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="profile.php">
              <i class="bi bi-person"></i>
              <span>Mon Profile</span>
            </a>
          </li>

          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="deconnexion_rq.php">
              <i class="bi bi-box-arrow-right"></i>
              <span>Deconnexion</span>
            </a>
          </li>


        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->

    </ul>
  </nav><!-- End Icons Navigation -->

</header>