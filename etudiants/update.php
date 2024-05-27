<?php session_start();

require_once(__DIR__ . "/../config/mysql.php");
require_once(__DIR__ . "/../include/variables.php");
$today = date("Y-m-d");
$min = date('Y-m-d', strtotime('18 years ago'));
$lim = date('Y-m-d', strtotime('40 years ago'));

$getData = $_GET;

if (!isset($getData['id']) || !is_numeric($getData['id'])) {
    $_SESSION['ID_ERROR'] = "Il faut un identifiant d'étudiant pour le modifier";
    header("location: index.php");
    exit();
} else {
    $retrieveEtudiantStatement = $mysqlClient->prepare('SELECT * FROM etudiant WHERE etudiant_id = :id');
    $retrieveEtudiantStatement->execute([
        'id' => $getData['id'],
    ]);

    $etudiant = $retrieveEtudiantStatement->fetch(PDO::FETCH_ASSOC);

    // si l'élève n'est pas trouvé, renvoyer un message d'erreur
    if (!$etudiant) {
        $_SESSION['NO_ELEVE'] = "Aucun étudiant trouvé avec cette ID " . $getData['id'];
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
        <h1 class="mt-2 mb-3">Modifier les informations de <?php echo ($etudiant['nom'] . " " . $etudiant['prenom']); ?></h1>
        <form action="<?php echo ($rootUrl . 'etudiants/checking/post_update.php'); ?>" method="POST">
            <?php if (isset($_SESSION['EDIT_ELEVE_ERROR'])) : ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['EDIT_ELEVE_ERROR'];
                    unset($_SESSION['EDIT_ELEVE_ERROR']); ?>
                </div>
            <?php endif; ?>

            <div class="mb-3 visually-hidden">
                <label for="id" class="form-label">Identifiant de l'étudiant</label>
                <input type="hidden" class="form-control" id="etudiant_id" name="etudiant_id" value="<?php echo ($getData['id']); ?>">
            </div>

            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" id="nom" name="nom" class="form-control" value="<?php echo strip_tags($etudiant['nom']); ?>">
            </div>

            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" id="prenom" name="prenom" class="form-control" value="<?php echo strip_tags($etudiant['prenom']); ?>">
            </div>

            <div class="mb-3">
                <label for="ville" class="form-label">Ville</label>
                <input type="text" id="ville" name="ville" class="form-control" value="<?php echo strip_tags($etudiant['ville']); ?>">
            </div>

            <div class="mb-3">
                <label for="sexe" class="form-label">Sexe</label>
                <select name="sexe" id="sexe" class="form-select">
                    <option value="" selected disabled>Séléctionenr une option</option>
                    <option value="H" <?php echo $etudiant['sexe'] == "H" ? 'selected' : ''; ?>>Homme</option>
                    <option value="F" <?php echo $etudiant['sexe'] == "F" ? 'selected' : ''; ?>>Femme</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="naissance" class="form-label">Date de naissance</label>
                <input type='date' id='naissance' name='naissance' class='form-control' max="<?php echo $min; ?>" min="<?php echo $lim; ?>" value="<?php echo ($etudiant['naissance']); ?>">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input class="form-control" type="email" id="email" name="email" placeholder="Votre adresse mail" 
                value="<?php if(isset($etudiant["email"])) {
                    echo strip_tags($etudiant['email']); }?>">
            </div>

            <div class="mb-3">
                <label for="téléphone" class="form-label">Numéro de téléphone</label>
                <input class="form-control" type="tel" id="phone" name="phone" pattern="[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}" placeholder="Format : 07 65 24 87 41e" 
                value="<?php if(isset($etudiant["phone"])) {
                echo strip_tags($etudiant['phone']); }?>">
            </div>

            <div class="mb-3">
                <label for="classe" class="form-label">Classe</label>
                <select name="classe_id" id="classe_id" class="form-select">
                    <option value="" selected disabled>Sélectionner une classe</option>
                    <?php foreach ($classes as $classe) : ?>
                        <option value="<?php echo $classe["classe_id"]; ?>" <?php echo $etudiant['classe_id'] == $classe["classe_id"] ? 'selected' : ''; ?>><?php echo $classe["classe"]; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary" name="ok">Envoyer</button>
        </form>
        <br />
    </div>
</body>

</html>