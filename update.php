<?php session_start();

include_once('config/mysql.php');
include_once('include/variables.php');
$today=date("Y-m-d");
$min=date('Y-m-d',strtotime('18 years ago'));
$lim=date('Y-m-d',strtotime('40 years ago'));

$getData = $_GET;

if (!isset($getData['id']) && is_numeric($getData['id'])) {
	$_SESSION['ID_ERROR'] = "Il faut un identifiant d'élève pour le modifier";
    header("location: index.php");
    exit();
}	

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

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification d'élèves</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="d-flex flex-column min-vh-100 bg-dark text-light">
    <div class="container">
    <?php include_once(__DIR__ . '/include/header.php') ?>
        <h1>Modifier les informations de <?php echo($eleve['nom'] . " " . $eleve['prenom']); ?></h1>
        <form action="post_update.php" method="POST">
            <div class="mb-3 visually-hidden">
                <label for="id" class="form-label">Identifiant de l'élève</label>
                <input type="hidden" class="form-control" id="eleve_id" name="eleve_id" value="<?php echo($getData['id']); ?>">
            </div>
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" id="nom" name="nom" class="form-control bg-dark text-light" value="<?php echo strip_tags($eleve['nom']); ?>">
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" id="prenom" name="prenom" class="form-control bg-dark text-light" value="<?php echo strip_tags($eleve['prenom']); ?>">
            </div>
            <div class="mb-3">
                <label for="ville" class="form-label">Ville</label>
                <input type="text" id="ville" name="ville" class="form-control bg-dark text-light" value="<?php echo strip_tags($eleve['ville']); ?>">
            </div>
            <div class="mb-3">
                <label for="sexe" class="form-label">Sexe</label>
                <select name="sexe" id="sexe" class="form-select bg-dark text-light">
                    <option value="" selected disabled>Séléctionenr une option</option>
                    <option value="H" <?php echo $eleve['sexe']=="H"?'selected':''; ?>>Homme</option>
                    <option value="F" <?php echo $eleve['sexe']=="F"?'selected':''; ?>>Femme</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="naissance" class="form-label">Date de naissance</label>
                <input type='date' id='naissance' name='naissance' class='form-control bg-dark text-light' max="<?php echo $min; ?>" min="<?php echo $lim; ?>" value="<?php echo ($eleve['naissance']); ?>">
            </div>
            <div class="mb-3">
                <label for="classe" class="form-label">Classe</label>
                <select name="classe_id" id="classe_id" class="form-select bg-dark text-light">
                    <option value="" selected disabled>Sélectionner une classe</option>
                    <option value="1" <?php echo $eleve['classe_id']=="1"?'selected':''; ?>>BTS</option>
                    <option value="2" <?php echo $eleve['classe_id']=="2"?'selected':''; ?>>Terminal</option>
                    <option value="3" <?php echo $eleve['classe_id']=="3"?'selected':''; ?>>Première</option>
                    <option value="4" <?php echo $eleve['classe_id']=="4"?'selected':''; ?>>Seconde</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="ok">Envoyer</button>
        </form>
        <br />
    </div>
</body>
</html>
