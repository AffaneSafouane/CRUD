<?php
session_start();
$today = date("Y-m-d");
$min = date('Y-m-d', strtotime('18 years ago'));
$lim = date('Y-m-d', strtotime('40 years ago'));
require_once("../include/variables.php");
?>

<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un élève</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php include_once($rootPath . "/CRUD/include/header.php"); ?>
    <div class="container">
        <h1 class="mt-2 mb-3">Ajouter un élève</h1>
        <form action="<?php echo ($rootUrl . 'eleves/checking/insertion.php'); ?>" method="POST">
            <?php if (isset($_SESSION['ADD_ERROR'])) : ?>
                <div class="alert alert-danger mt-3">
                    <?php echo $_SESSION['ADD_ERROR'];
                    unset($_SESSION['ADD_ERROR']); ?>
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="nom" class="form-label">Nom*</label>
                <input type="text" id="nom" name="nom" placeholder="Nom de l'élève" class="form-control" value="Doe" required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom*</label>
                <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Prénom de l'élève" value="John" required>
            </div>
            <div class="mb-3">
                <label for="ville" class="form-label">Ville*</label>
                <input type="text" id="ville" name="ville" class="form-control" placeholder="Ville de l'élève" required>
            </div>
            <div class="mb-3">
                <label for="sexe" class="form-label">Sexe*</label>
                <select name="sexe" id="sexe" class="form-select" required>
                    <option value="" selected disabled>Séléctionenr une option</option>
                    <option value="H">Homme</option>
                    <option value="F">Femme</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="naissance" class="form-label">Date de naissance</label>
                <input type='date' id='naissance' name='naissance' class='form-control' max="<?php echo $min; ?>" min="<?php echo $lim; ?>" value="<?php echo $min; ?>">
            </div>
            <div class="mb-3">
                <label for="classe" class="form-label">Classe</label>
                <select name="classe_id" id="classe_id" class="form-select" required>
                    <option value="" selected disabled>Sélectionner une classe</option>
                    <?php foreach ($classes as $classe) : ?>
                        <option value="<?php echo $classe["classe_id"]; ?>"><?php echo $classe["classe"]; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="diplomes" class="form-label">Diplomes</label>
                <?php foreach ($diplomes as $diplome) : ?>
                    <div class="form-check">
                        <label for="diplome" class="form-check-label"><?php echo $diplome["diplome"]; ?></label>
                        <input type="checkbox" class="form-check-input" id="diplomes" name="diplomes[]" value="<?php echo $diplome["diplome_id"]; ?>">
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="submit" class="btn btn-primary mt-2 mb-4" name="ok">Ajouter</button>
        </form>
    </div>
</body>

</html>