<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription</title>
    <!-- Lien CSS Bootstrap -->
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<section class="bg-light p-3 p-md-4 p-xl-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-xxl-11">
                <div class="card border-light-subtle shadow-sm">
                    <div class="row g-0">
                        <div class="col-12 col-md-6">
                            <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy" src="./assets/img/logo-img-1.webp" alt="Welcome back you've been missed!">
                        </div>
                        <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                            <div class="col-12 col-lg-11 col-xl-10">
                                <div class="card-body p-3 p-md-4 p-xl-5">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-5">
                                                <div class="text-center mb-4">
                                                    <a href="#!">
                                                        <img src="./assets/img/bsb-logo.svg" alt="BootstrapBrain Logo" width="175" height="57">
                                                    </a>
                                                </div>
                                                <h2 class="h4 text-center">Registration</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="#!">
                                        <div class="row gy-3 overflow-hidden">
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="firstName" id="firstName" placeholder="First Name" required>
                                                    <label for="firstName" class="form-label">First Name</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="lastName" id="lastName" placeholder="First Name" required>
                                                    <label for="lastName" class="form-label">Last Name</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                                                    <label for="email" class="form-label">Email</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password" required>
                                                    <label for="password" class="form-label">Password</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" name="iAgree" id="iAgree" required>
                                                    <label class="form-check-label text-secondary" for="iAgree">
                                                        I agree to the <a href="#!" class="link-primary text-decoration-none">terms and conditions</a>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button class="btn btn-dark btn-lg" type="submit">Sign up</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="mb-0 mt-5 text-secondary text-center">Already have an account? <a href="#!" class="link-primary text-decoration-none">Sign in</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bdd = new PDO('mysql:host=localhost;dbname=user;charset=utf8', 'root', '');

    $req = $bdd->prepare("SELECT * FROM user WHERE nom = :nom");
    $req->execute(array(
        'nom' => $_POST['nom']
    ));

    $res = $req->fetch();

    if ($res) {
        echo "Inscription échouée. L'utilisateur existe déjà";
        echo '<form action="Inscription.php">
        <input type="submit"  value="Retour"/><br>
        </form>';
    } else {
        $req = $bdd->prepare("INSERT INTO user (nom, prenom, email , password) VALUES (:nom, :prenom, :email, :password)");

        $a = $req->execute(array(
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'email' => $_POST['email'],
            'password' => $_POST['password']

        ));

        if ($a) {
            echo 'Inscription réussie';
            echo "<form action='Connexion.php'>
            <input type='submit' value='Retour'/><br>
            </form>";
        } else {
            echo 'Inscription échouée';
            echo '<form action="Inscription.php">
            <input type="submit"  value="Retour"/><br>
            </form>';
        }
    }
}
?>

</body>
</html>