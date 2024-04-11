<?php 
$today=date("Y-m-d");
$min=date('Y-m-d',strtotime('18 years ago'));
$lim=date('Y-m-d',strtotime('40 years ago'));
require_once(__DIR__."/insertion.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un élève</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="d-flex flex-column min-vh-100 bg-dark text-light">
    <div class="container">
        <?php require_once(__DIR__ . '/include/header.php')?>
        <h1 class="mt-2 mb-3">Ajouter un élève</h1>
        <form action="insertion.php" method="POST">
            <?php if(isset($_SESSION['ADD_ERROR'])): ?>
                <?php foreach($_SESSION['ADD_ERROR'] as $e): ?>
                    <div class="alert alert-danger mt-3">
                        <?php echo $e;?>
                    </div>
                <?php endforeach; ?>
                <?php unset($_SESSION['ADD_ERROR']); ?>
            <?php endif; ?>
            <div class="mb-3">
                <label for="nom" class="form-label">Nom*</label>
                <input type="text" id="nom" name="nom" placeholder="Nom de l'élève" class="form-control bg-dark text-light" value="Doe" required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom*</label>
                <input type="text" id="prenom" name="prenom" class="form-control bg-dark text-light" placeholder="Prénom de l'élève" value="John" required>
            </div>
            <div class="mb-3">
                <label for="ville" class="form-label">Ville*</label>
                <input type="text" id="ville" name="ville" class="form-control bg-dark text-light" placeholder="Ville de l'élève" required>
            </div>
            <div class="mb-3">
                <label for="sexe" class="form-label">Sexe*</label>
                <select name="sexe" id="sexe" class="form-select bg-dark text-light" required>
                    <option value="" selected disabled>Séléctionenr une option</option>
                    <option value="H">Homme</option>
                    <option value="F">Femme</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="naissance" class="form-label">Date de naissance</label>
                <input type='date' id='naissance' name='naissance' class='form-control bg-dark text-light' max="<?php echo $min; ?>" min="<?php echo $lim; ?>" value="<?php echo $min; ?>">
            </div>
            <div class="mb-3">
                <label for="classe" class="form-label">Classe</label>
                <select name="classe_id" id="classe_id" class="form-select bg-dark text-light" required>
                    <option value="" selected disabled>Sélectionner une classe</option>
                    <option value="1">BTS</option>
                    <option value="2">Terminal</option>
                    <option value="3">Première</option>
                    <option value="4">Seconde</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="diplomes" class="form-label">Diplomes</label>
                <div class="form-check">
                    <label for="Brevet" class="form-check-label">Brevet</label>
                    <input type="checkbox" class="form-check-input" id="diplomes[]" name="diplomes[]" value="1">
                </div>
                <div class="form-check">
                    <label for="Général" class="form-check-label">Bac Général</label>
                    <input type="checkbox" class="form-check-input" id="diplomes[]" name="diplomes[]" value="2">
                </div>
                <div class="form-check">
                    <label for="Techno" class="form-check-label">Bac Technologique</label>
                    <input type="checkbox" class="form-check-input" id="diplomes[]" name="diplomes[]" value="3">
                </div>
                <div class="form-check">
                    <label for="Pro" class="form-check-label">Bac Professionnel</label>
                    <input type="checkbox" class="form-check-input" id="diplomes[]" name="diplomes[]" value="4">
                </div>
                <div class="form-check">
                    <label for="sans" class="form-check-label">Sans Diplôme</label>
                    <input type="checkbox" class="form-check-input" id="diplomes[]" name="diplomes[]" value="5">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-2 mb-4" name="ok">Ajouter</button>
        </form>
    </div>
</body>
</html>