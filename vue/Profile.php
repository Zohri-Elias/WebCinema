//require_once "../src/bdd/Bdd.php";
//require_once "../src/modele/Utilisateur.php";
//require_once "../src/repository/UtilisateurRepository.php";
//$users = new Utilisateur();
//$user = $users->afficherCatalogue();

<!doctype html>
<html>
<head>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <title>Profil Utilisateur</title>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet'>
  <style>
    body { background: rgb(0, 0, 0); color: white; }
    .container { background: #222; padding: 20px; border-radius: 10px; }
    .labels { font-size: 14px; font-weight: bold; color: #bbb; }
    .profile-value { font-size: 16px; color: #ddd; padding: 5px; }
  </style>
</head>
<body>

<div class="container rounded mt-5 mb-5">
  <div class="row">
    <div class="col-md-3 border-right text-center">
      <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
      <h4 class="mt-3">Edogaru</h4>
      <p class="text-muted">edogaru@mail.com.my</p>
    </div>
    <div class="col-md-5 border-right">
      <div class="p-3 py-5">
        <h4>Informations du Profil</h4>
        <div class="mt-3">
          <p class="labels">Nom: <span class="profile-value"><?php echo $user['name']; ?></span></p>
          <p class="labels">Prénom: <span class="profile-value"><?php echo $user['surname']; ?></span></p>
            <p class="labels">Email: <span class="profile-value"><?php echo $user['email']; ?></span></p>
          <p class="labels">Mot de Passe: <span class="profile-value"><?php echo $user['mdp']; ?></span></p>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>