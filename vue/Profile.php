<?php
require_once '../src/bdd/Bdd.php';
require_once '../src/repository/utilisateurRepository.php';

session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin: 50px; }
        .container { max-width: 400px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; box-shadow: 2px 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #333; }
        p { font-size: 18px; }
        a { display: inline-block; margin-top: 20px; padding: 10px 20px; text-decoration: none; background: red; color: white; border-radius: 5px; }
        a:hover { background: darkred; }
    </style>
</head>
<body>

<div class="container">
    <h1>Bienvenue, <?php echo htmlspecialchars($_SESSION['nom']); ?>
        <?php echo htmlspecialchars($_SESSION['prenom']); ?>!</h1>
    <form action="../src/repository/UtilisateurRepository.php" method="POST">
        <label for="nom">Nouveau nom :</label>
        <input type="text" id="nom" name="nom"><br>

        <label for="prenom">Nouveau prénom :</label>
        <input type="text" id="prenom" name="prenom"><br>

        <p><strong>ID :</strong> <?php echo $_SESSION['user_id']; ?></p>
        <input type="text" id="user_id" name="user_id"><br>

        <p><strong>Email :</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
        <input type="email" id="email" name="email"><br>

        <p><strong>Rôle :</strong> <?php echo htmlspecialchars($_SESSION['role']); ?></p>
        <input type="text" id="role" name="role"><br>

        <button type="submit">Mettre à jour</button>
    </form>
</div>


<a href="../src/traitement/Logout.php">Déconnexion</a>
    </div>

</body>
</html>
