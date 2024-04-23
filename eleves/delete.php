<?php session_start();

require_once(__DIR__ . "/../config/mysql.php");
require_once(__DIR__ . "/../include/variables.php");

$getData = $_GET;

if (!isset($getData['id']) || !is_numeric($getData['id'])) {
    $_SESSION['ELEVE_ID_ERROR'] = "Il faut un identifiant d'élève pour le supprimer";
    header("location: /CRUD/index.php");
    exit();
} else {
    $retrieveEleveStatement = $mysqlClient->prepare('SELECT * FROM eleve WHERE eleve_id = :id');
    $retrieveEleveStatement->execute([
        'id' => $getData['id'],
    ]);

    $eleve = $retrieveEleveStatement->fetch(PDO::FETCH_ASSOC);

    // Si l'élève n'est pas trouvé, renvoyer un message d'erreur
    if (!$eleve) {
        $_SESSION['NO_ELEVE'] = "Aucun élève trouvé avec cette ID " . $getData['id'];
        header("location: /CRUD/index.php");
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
    <title>Supprimer un élève</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php include_once($rootPath . "/CRUD/include/header.php"); ?>
    <div class="container">
        <?php if (isset($_SESSION['ID_ELEVE_ERROR'])) : ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['ID_ELEVE_ERROR'];
                unset($_SESSION['ID_ELEVE_ERROR']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['SUPP_ELEVE_ERROR'])) : ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['SUPP_ELEVE_ERROR'];
                unset($_SESSION['SUPP_ELEVE_ERROR']); ?>
            </div>
        <?php endif; ?>

        <h1 class="mt-2 mb-3">Supprimer l'élève ?</h1>
        <form action="<?php echo ($rootUrl . 'eleves/checking/post_delete.php'); ?>" method="POST">
            <div class="mb-3 visually-hidden">
                <label for="id" class="form-label">Identifiant de l'élève</label>
                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $_GET['id']; ?>">
            </div>
            <button type="submit" class="btn btn-danger">La suppression est définitive</button>
        </form>
    </div>
</body>

</html>