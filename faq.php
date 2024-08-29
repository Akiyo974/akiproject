<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - AkiProject</title>
    <link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="16x16" />
    <!-- ======= Styles ======= -->
    <?php include 'include/lienCss.php'; ?>
    <!-- End Styles -->
</head>

<body>
    <!-- ======= Header ======= -->
    <?php include 'include/headerIndex.php'; ?>
    <!-- End Header -->

    <!-- ======= Main ======= -->
    <main class="container mt-5 pt-3">
        <h1 class="text-center mb-4">Foire aux questions - AkiProject</h1>
        <div class="accordion" id="faqAccordion">
            <!-- Question 1 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Comment démarrer avec AkiProject ?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Pour commencer à utiliser AkiProject, créez simplement un compte et suivez le guide
                        d'intégration pour configurer votre premier projet. Vous pouvez ajouter des tâches, assigner des
                        membres à des équipes et commencer à suivre l'avancement de votre projet en temps réel.
                    </div>
                </div>
            </div>
            <!-- Question 2 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Quelles sont les principales fonctionnalités d'AkiProject ?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        AkiProject offre une variété de fonctionnalités telles que la gestion de tâches, la
                        planification des projets, la collaboration en temps réel, et des tableaux de bord
                        personnalisables qui vous permettent de suivre les progrès et les métriques clés de manière
                        efficace.
                    </div>
                </div>
            </div>
            <!-- Question 3 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Comment AkiProject assure-t-il la sécurité des données ?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        La sécurité est une priorité chez AkiProject. Nous utilisons des protocoles de chiffrement
                        avancés pour sécuriser vos données et nous conformons aux normes internationales de sécurité
                        pour garantir que vos informations restent protégées et confidentielles.
                    </div>
                </div>
            </div>
            <!-- Question 4 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        AkiProject peut-il s'intégrer avec d'autres outils que nous utilisons ?
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Oui, AkiProject est conçu pour s'intégrer facilement avec de nombreux outils tiers, tels que les
                        systèmes de messagerie, les outils de gestion des ressources humaines, et les plateformes de
                        communication. Cette intégration permet de centraliser votre travail et d'optimiser votre flux
                        de travail.
                    </div>
                </div>
            </div>
            <!-- Question 5 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        Que faire si j'ai besoin d'aide avec AkiProject ?
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Si vous avez besoin d'aide avec AkiProject, notre équipe de support technique est disponible
                        pour vous aider. Vous pouvez nous contacter via le formulaire de contact sur notre site, par
                        téléphone ou par e-mail. Nous offrons également une base de connaissances complète et des
                        tutoriels vidéo pour vous aider à résoudre les problèmes courants.
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- ======= Footer ======= -->
    <?php include 'include/footerIndex.php'; ?>
    <!-- ======= Scripts ======= -->
    <?php include 'include/lienScript.php'; ?>
    <!-- End Scripts -->
</body>

</html>