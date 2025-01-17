<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription</title>
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
    <h2>Inscription</h2>
    <form id="registrationForm">
        <div class="mb-3">
            <label for="firstName" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="firstName" name="firstName" required>
            <div class="error" id="firstNameError"></div>
        </div>
        <div class="mb-3">
            <label for="lastName" class="form-label">Nom</label>
            <input type="text" class="form-control" id="lastName" name="lastName" required>
            <div class="error" id="lastNameError"></div>
        </div>
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
        <div class="mb-3">
            <label for="age" class="form-label">Âge</label>
            <input type="number" class="form-control" id="age" name="age" min="18" max="120" required>
            <div class="error" id="ageError"></div>
        </div>
        <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<script>
    document.getElementById("registrationForm").addEventListener("submit", function(event) {
        event.preventDefault();
        let isValid = true;
        document.querySelectorAll(".error").forEach(error => {
            error.textContent = "";
        });

        const firstName = document.getElementById("firstName").value.trim();
        if (!firstName) {
            document.getElementById("firstNameError").textContent = "Le prénom est requis.";
            isValid = false;
        }

        const lastName = document.getElementById("lastName").value.trim();
        if (!lastName) {
            document.getElementById("lastNameError").textContent = "Le nom est requis.";
            isValid = false;
        }

        const email = document.getElementById("email").value.trim();
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!email || !emailPattern.test(email)) {
            document.getElementById("emailError").textContent = "L'email n'est pas valide.";
            isValid = false;
        }

        const password = document.getElementById("password").value.trim();
        if (password.length < 6) {
            document.getElementById("passwordError").textContent = "Le mot de passe doit comporter au moins 6 caractères.";
            isValid = false;
        }

        const age = document.getElementById("age").value;
        if (age < 18 || age > 120) {
            document.getElementById("ageError").textContent = "Veuillez entrer un âge valide entre 18 et 120.";
            isValid = false;
        }

        if (isValid) {
            alert("Inscription réussie!");
            document.getElementById("registrationForm").submit();
        }
    });
</script>
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
        $req = $bdd->prepare("INSERT INTO utilisateur (nom, prenom, email , password, age) VALUES (:nom, :prenom, :email, :password, :age)");

        $a = $req->execute(array(
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'age' => $_POST['age']

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