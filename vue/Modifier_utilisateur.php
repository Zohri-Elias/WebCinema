<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modifier un Utilisateur</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f4f4;
      color: #333;
    }
    .sidebar {
      width: 250px;
      height: 100vh;
      background-color: #333;
      border-right: 1px solid #444;
      position: fixed;
      overflow-y: auto;
      padding-top: 20px;
    }
    .sidebar-header {
      padding: 20px;
      font-size: 1.5em;
      font-weight: bold;
      color: white;
      text-align: center;
      background-color: #222;
    }
    .sidebar-menu {
      list-style-type: none;
      padding: 0;
    }
    .sidebar-menu li {
      padding: 15px;
      text-align: center;
      color: white;
      cursor: pointer;
      transition: background 0.3s;
    }
    .sidebar-menu li:hover {
      background-color: #555;
    }
    .content {
      margin-left: 250px;
      padding: 40px;
    }
    h1 {
      font-size: 2em;
      color: #444;
    }
    .form-container {
      background-color: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      width: 60%;
      margin: auto;
    }
    .form-container input, .form-container select, .form-container button {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1em;
    }
    .form-container button {
      background-color: #007bff;
      color: white;
      cursor: pointer;
    }
    .form-container button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

<div class="sidebar">
  <div class="sidebar-header">MATERIAL ADMIN PRO</div>
  <ul class="sidebar-menu">
    <li onclick="window.location.href='Administration.html'">Menu</li>
  </ul>
</div>

<div class="form-container">
  <div class="form-header">
    <h2>Modifier un Utilisateur</h2>
    <p>Créez votre compte en quelques étapes simples</p>
  </div>
  <form method="POST" action="../src/traitement/ModifierUtilisateurTrt.php">
    <div class="mb-3">
      <label for="idUtilisateur" class="form-label">Id:</label>
      <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-person"></i>
                </span>
        <input type="text" class="form-control" id="idUtilisateur" name="idUtilisateur" placeholder="Entrez l'id de l'utilisateur" required>
      </div>
    </div>
    <div class="mb-3">
      <label for="nom" class="form-label">Nom</label>
      <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-person"></i>
                </span>
        <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez le nom" required>
      </div>
    </div>
    <div class="mb-3">
      <label for="prenom" class="form-label">Prénom</label>
      <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-person"></i>
                </span>
        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrez le prénom" required>
      </div>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Adresse Email</label>
      <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-envelope"></i>
                </span>
        <input type="email" class="form-control" id="email" name="email" placeholder="Entrez le email" required>
      </div>
    </div>
    <div class="mb-3">
      <label for="mdp" class="form-label">Mot de passe</label>
      <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-lock"></i>
                </span>
        <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Entrez le mot de passe" required>
      </div>
    </div>
      <div class="mb-3">
          <label for="role" class="form-label">Role</label>
          <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-person"></i>
                </span>
              <input type="text" class="form-control" id="role" name="role" placeholder="Entrez le role" required>
          </div>
      </div>
    <button type="submit" class="btn btn-primary w-100" name ="ok">Envoyer</button>
  </form>

    <h2>Liste des Utilisateurs</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Email</th>
        </tr>
        <?php
        require_once '../src/bdd/Bdd.php';
        $database = new Bdd();
        $bdd = $database->getBdd();

        $sql = "SELECT id_utilisateur, nom, prenom, email FROM utilisateur";
        $stmt = $bdd->query($sql);

        while ($utilisateur = $stmt->fetch()) {
        echo "<tr><td>" . htmlspecialchars($utilisateur['id_utilisateur']) . "</td><td>" . htmlspecialchars($utilisateur['nom']) . "</td><td>" . htmlspecialchars($utilisateur['prenom']) . "</td><td>" . htmlspecialchars($utilisateur['email']) . "</td><td>" ;    }
        ?>
    </table>
</div>

</body>
</html>