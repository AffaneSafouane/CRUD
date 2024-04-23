<?php session_start();

require_once(__DIR__ . "/../config/mysql.php");
require_once(__DIR__ . "/../include/variables.php");
$today = date("Y-m-d");
$min = date('Y-m-d', strtotime('18 years ago'));
$lim = date('Y-m-d', strtotime('40 years ago'));

$getData = $_GET;

if (!isset($getData['id']) || !is_numeric($getData['id'])) {
    $_SESSION['ID_ERROR'] = "Il faut un identifiant d'élève pour le modifier";
    header("location: index.php");
    exit();
} else {
    $retrieveEleveStatement = $mysqlClient->prepare('SELECT * FROM eleve WHERE eleve_id = :id');
    $retrieveEleveStatement->execute([
        'id' => $getData['id'],
    ]);

    $eleve = $retrieveEleveStatement->fetch(PDO::FETCH_ASSOC);

    // si l'élève n'est pas trouvé, renvoyer un message d'erreur
    if (!$eleve) {
        $_SESSION['NO_ELEVE'] = "Aucun élève trouvé avec cette ID " . $getData['id'];
        header("location: index.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification d'élèves</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php include_once($rootPath . "/CRUD/include/header.php"); ?>
    <div class="container">
        <h1 class="mt-2 mb-3">Modifier les informations de <?php echo ($eleve['nom'] . " " . $eleve['prenom']); ?></h1>
        <form action="<?php echo ($rootUrl . 'eleves/checking/post_update.php'); ?>" method="POST">
            <?php if (isset($_SESSION['EDIT_ELEVE_ERROR'])) : ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['EDIT_ELEVE_ERROR'];
                    unset($_SESSION['EDIT_ELEVE_ERROR']); ?>
                </div>
            <?php endif; ?>
            <div class="mb-3 visually-hidden">
                <label for="id" class="form-label">Identifiant de l'élève</label>
                <input type="hidden" class="form-control" id="eleve_id" name="eleve_id" value="<?php echo ($getData['id']); ?>">
            </div>
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" id="nom" name="nom" class="form-control" value="<?php echo strip_tags($eleve['nom']); ?>">
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" id="prenom" name="prenom" class="form-control" value="<?php echo strip_tags($eleve['prenom']); ?>">
            </div>
            <div class="mb-3">
                <label for="ville" class="form-label">Ville</label>
                <input type="text" id="ville" name="ville" class="form-control" value="<?php echo strip_tags($eleve['ville']); ?>">
            </div>
            <div class="mb-3">
                <label for="sexe" class="form-label">Sexe</label>
                <select name="sexe" id="sexe" class="form-select">
                    <option value="" selected disabled>Séléctionenr une option</option>
                    <option value="H" <?php echo $eleve['sexe'] == "H" ? 'selected' : ''; ?>>Homme</option>
                    <option value="F" <?php echo $eleve['sexe'] == "F" ? 'selected' : ''; ?>>Femme</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="naissance" class="form-label">Date de naissance</label>
                <input type='date' id='naissance' name='naissance' class='form-control' max="<?php echo $min; ?>" min="<?php echo $lim; ?>" value="<?php echo ($eleve['naissance']); ?>">
            </div>
            <div class="mb-3">
                <label for="classe" class="form-label">Classe</label>
                <select name="classe_id" id="classe_id" class="form-select">
                    <option value="" selected disabled>Sélectionner une classe</option>
                    <?php foreach ($classes as $classe) : ?>
                        <option value="<?php echo $classe["classe_id"]; ?>" <?php echo $eleve['classe_id'] == $classe["classe_id"] ? 'selected' : ''; ?>><?php echo $classe["classe"]; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="ok">Envoyer</button>
        </form>
        <br />
    </div>
</body>

</html>