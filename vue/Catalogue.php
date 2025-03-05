<?php
require_once "../src/bdd/Bdd.php";
require_once "../src/modele/Film.php";
require_once "../src/repository/FilmRepository.php";
require_once "../src/repository/reservationRepository.php";

$filmRepository = new FilmRepository();
$films = $filmRepository->afficherCatalogue();
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Movie Room</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../assets/css/styles2.css" rel="stylesheet" />
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="#!">Movie Room</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="../index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#affiche">À voir</a></li>
            </ul>
            <form class="d-flex">
                <button class="btn btn-outline-dark" type="button">
                    <i class="bi-cart-fill me-1"></i>
                    <a class="link-dark text-decoration-none" href="Panier.php">Panier</a>
                    <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                </button>
            </form>
        </div>
    </div>
</nav>

<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Catalogue des Films</h1>
            <p class="lead fw-normal text-white-50 mb-0">Les films disponibles que vous pouvez regarder au Movie Room.</p>
        </div>
    </div>
</header>

<!-- Catalogue-->
<section class="py-1" id="affiche">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-3 gx-lg-4 row-cols-1 row-cols-md-2 row-cols-xl-3 justify-content-center">
            <?php foreach ($films as $film) { ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Image du film -->
                        <img class="card-img-top"
                             src="<?= htmlspecialchars($film->getImage() ? $film->getImage() : '../assets/img/64c4552214012a590dae8b9469b0eb62.jpeg') ?>"
                             alt="<?= htmlspecialchars($film->getNomFilm()) ?>" />

                        <!-- Détails du film -->

                        <div class="card-body p-4">
                            <div class="text-center">
                                <h5 class="fw-bolder"><?= htmlspecialchars($film->getNomFilm()) ?></h5>
                                <div class="text-muted"><?= htmlspecialchars($film->getGenre()) ?></div>
                                <div class="text-muted"><?= htmlspecialchars($film->getDuree()) ?> min</div>
                                <p class="mt-2"><?= nl2br(htmlspecialchars($film->getDescription())) ?></p>
                            </div>
                        </div>
                        <!-- Bouton Ajouter au Panier -->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <form method="POST" action="Panier.php">
                                    <input type="hidden" name="film_nom" value="<?= htmlspecialchars($film->getNomFilm()) ?>">
                                    <input type="hidden" name="film_image" value="<?= htmlspecialchars($film->getImage()) ?>">
                                    <button type="submit" class="btn btn-outline-dark mt-auto" name="ajouter_panier">Ajouter au Panier</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">© 2024 Movie Room</p></div>
</footer>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="../assets/js/scripts2.js"></script>
</body>
</html>
