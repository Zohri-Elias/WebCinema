<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bdd = new PDO('mysql:host=localhost;dbname=user;charset=utf8', 'root', '');

    $email = $_POST['email'];
    $password = $_POST['password'];

    $req = $bdd->prepare("SELECT * FROM utilisateur WHERE email = (:email, :password)");
    $req->execute(array('email' => $email));

    $user = $req->fetch();

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['password'] = $user['password'];

            echo 'Connexion réussie !';
            echo "<form action='index.php' method='post'>
                    <input type='submit' value='Accéder à votre compte'/><br>
                  </form>";
        } else {
            $errorMessage = 'Mot de passe incorrect.';
        }
    } else {
        $errorMessage = 'Aucun utilisateur trouvé avec cet email.';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #2c3e50;
            font-family: 'Roboto', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            animation: fadeIn 1s ease-in-out;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: #555;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px;
            font-size: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-control:focus {
            box-shadow: 0 0 8px rgba(38, 194, 129, 0.6);
            border-color: #26c281;
        }

        .btn-primary {
            background-color: #26c281;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-size: 1.1rem;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #1e9f6b;
        }

        .error {
            color: red;
            font-size: 0.875rem;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
<div class="form-container">
    <h2>Connexion</h2>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
            <div class="error" id="emailError"></div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
            <div class="error" id="passwordError"></div>
        </div>
        <button type="submit" class="btn btn-primary w-100">Se connecter</button>
    </form>

    <?php if (isset($errorMessage)): ?>
        <p style="color: red; text-align: center;"><?php echo $errorMessage; ?></p>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
