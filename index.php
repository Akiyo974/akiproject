<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AkiProject</title>
    <link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="16x16" />
    <!-- ======= Styles ======= -->
    <?php include 'include/lienCss.php'; ?>
    <style>
        .imgScroll {
            position: sticky;
            top: 50px;
        }
    </style>
    <!-- End Styles -->
</head>

<body>
    <!-- ======= Header ======= -->
    <?php include 'include/headerIndex.php'; ?>
    <!-- End Header -->
    <!-- ======= Main ======= -->
    <main>
        <div class="container mt-5 pt-2 pb-5">
            <div class="row">
                <div class="col-12">
                    <h1>Libérez votre potentiel collaboratif et transformez vos idées en succès.</h1>
                    <div class="row">
                        <div class="col-12 col-md-4 d-flex">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            <p>Simplifiez votre gestion de projet avec AkiProject. Planifiez, suivez et collaborez
                                facilement pour concrétiser vos idées.</p>
                        </div>
                        <div class="col-12 col-md-4 d-flex">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            <p>Personnalisez votre expérience avec AkiProject. Créez des tableaux de bord sur mesure
                                pour une organisation efficace.</p>
                        </div>
                        <div class="col-12 col-md-4 d-flex">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            <p>Collaborez sans limites avec AkiProject. Communiquez et travaillez en équipe, où que
                                vous soyez, pour atteindre vos objectifs.</p>
                        </div>
                    </div>
                    <button class="btn btn-primary">Commencez dès maintenant !</button>
                </div>
            </div>
        </div>
        <div class="container-fluid pt-5 pb-5 mt-4" style="background-color: #D9D9D9;">
            <div class="container">
                <div class="row justify-content-center mt-4">
                    <div class="col-12 col-md-8">
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="images/board.png" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="images/board.png" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="images/board.png" class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-12">
                    <h2>Comment ça marche ?</h2>
                    <p>Notre plateforme vous offre une expérience unique pour gérer vos projets en toute simplicité.
                        Découvrez comment AkiProject peut vous aider à atteindre vos objectifs.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Planifiez</h4>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Organisez vos projets en toute simplicité avec des tableaux de bord
                                personnalisés pour une gestion optimale.</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Collaborez</h4>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="card-body" style="display: none;">
                            <p class="card-text">Travaillez en équipe, partagez des idées et communiquez en temps
                                réel pour une collaboration efficace.</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Réussissez</h4>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="card-body" style="display: none;">
                            <p class="card-text">Transformez vos idées en succès en planifiant, collaborant et
                                suivant vos projets avec AkiProject.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <img src="images/workspace.png" class="img-fluid imgScroll" alt="Planifiez" style="display: block;">
                    <img src="images/board.png" class="img-fluid imgScroll" alt="Collaborez" style="display: none;">
                    <img src="images/calendrier.png" class="img-fluid imgScroll" alt="Réussissez" style="display: none;">
                </div>

            </div>
        </div>
        </div>
        <div class="container-fluid pt-5 pb-5 mt-5" style="background-color: #D9D9D9;">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h2>Commencez dès maintenant avec AkiProject</h2>
                        <p>Optimisez la gestion de vos projets dès aujourd’hui. Découvrez comment AkiProject peut aider
                            votre équipe à collaborer de manière plus efficace. Inscrivez-vous dès maintenant</p>
                    </div>
                    <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center">
                        <a href="connexion.php" class="btn btn-primary mb-2">En savoir plus sur AkiProject</a>
                        <a href="inscription.php" class="btn btn-primary">Inscrivez-vous gratuitement</a>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'include/footerIndex.php'; ?>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center active"><i
                class="bi bi-arrow-up-short"></i></a>
    </main>
    <!-- ======= Scripts ======= -->
    <?php include 'include/lienScript.php'; ?>

    <script>
$(document).ready(function () {
    var intervalTime = 5000; // Temps entre les changements de carte en millisecondes
    var cards = $('.card-body'); // Sélection des corps des cartes
    var progressBars = $('.progress-bar'); // Sélection des barres de progression
    var images = $('.imgScroll'); // Utilisation de la classe pour la sélection des images

    cards.hide().first().show(); // Cache toutes les cartes sauf la première
    progressBars.parent().hide(); // Cache tous les conteneurs de barre de progression
    progressBars.first().parent().show(); // Montre seulement la première barre de progression
    images.hide().first().show(); // Cache toutes les images sauf la première

    var currentCardIndex = 0;
    var totalCards = cards.length;

    function showCard(index) {
        var nextIndex = (index + 1) % totalCards;

        var currentBar = progressBars.eq(index);
        currentBar.css('width', '0%').attr('aria-valuenow', 0);

        cards.eq(index).fadeOut(function () {
            cards.eq(nextIndex).fadeIn();
            progressBars.parent().hide();
            progressBars.eq(nextIndex).parent().show();
            images.hide().eq(nextIndex).show(); // Affiche l'image correspondante
            updateProgressBar(progressBars.eq(nextIndex));
        });
        currentCardIndex = nextIndex;
    }

    function updateProgressBar(bar) {
        var width = 0;
        var interval = setInterval(function () {
            width++;
            bar.css('width', width + '%').attr('aria-valuenow', width);
            if (width >= 100) {
                clearInterval(interval);
                showCard(currentCardIndex);
            }
        }, intervalTime / 100); // Durée de la transition de la barre de progression
    }

    updateProgressBar(progressBars.eq(0)); 
});

    </script>

    <!-- End Scripts -->
</body>

</html>