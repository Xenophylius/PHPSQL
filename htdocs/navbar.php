<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="bg-dark">

<nav class="navbar navbar-expand-lg bg-success mx-auto">
  <div class="container-fluid mx-auto">
    <a class="navbar-brand" href="index.php">HÔPITAL</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item mx-auto">
          <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
        </li>
        <li class="nav-item mx-auto">
          <a class="nav-link" href="ajout-patient.php">Ajouter un patient</a>
        </li>
        <li class="nav-item mx-auto">
          <a class="nav-link" href="liste-patients.php">Liste des patients</a>
        </li>
        <li class="nav-item mx-auto">
          <a class="nav-link" href="ajout-rendezvous.php">Ajouter un rendez-vous</a>
        </li>
        <li class="nav-item mx-auto">
          <a class="nav-link" href="liste-rendezvous.php">Liste des rendez-vous</a>
        </li>
        <li class="nav-item mx-auto">
          <a class="nav-link" href="ajout-patient-rendez-vous.php">Ajouter un patient et un rendez-vous</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>