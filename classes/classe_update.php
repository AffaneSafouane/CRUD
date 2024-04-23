<?php session_start();
require_once(__DIR__ . "/../config/mysql.php");
require_once(__DIR__ . "/../include/variables.php");

$getData = $_GET;

if (!isset($getData['id']) || !is_numeric($getData['id'])) {
    $_SESSION['ID_CLASSE_ERROR'] = "Il faut un identifiant de classe pour la modifier";
    header("location: liste_classe.php");
    exit();
} else {
    $retrieveClasseStatement = $mysqlClient->prepare('SELECT * FROM classes WHERE classe_id = :id');
    $retrieveClasseStatement->execute([
        'id' => $getData['id']
    ]);

    $classe = $retrieveClasseStatement->fetch(PDO::FETCH_ASSOC);

    if (!$classe) {
        $_SESSION['NO_CLASSE'] = "Aucune classe trouvé avec cet ID" . $getData['id'];
        header("location: liste_classe.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification de classe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php require_once($rootPath . "/CRUD/include/header.php"); ?>
    <div class="container">
        <h1 class="mt-2 mb-3">Modifier la classe : <?php echo ($classe['classe']); ?></h1>
        <form action="<?php echo ($rootUrl . 'classes/checking/post_classe_update.php'); ?>" method="POST">
            <?php if (isset($_SESSION['EDIT_CLASSE_ERROR'])) : ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['EDIT_CLASSE_ERROR'];
                    unset($_SESSION['EDIT_CLASSE_ERROR']); ?>
                </div>
            <?php endif; ?>
            <div class="mb-3 visually-hidden">
                <label for="id" class="form-label">Identifiant de la classe</label>
                <input type="hidden" class="form-control" id="classe_id" name="classe_id" value="<?php echo ($getData["id"]); ?>">
            </div>
            <div class="mb-3">
                <label for="classe" class="form-label">Classe</label>
                <input type="text" id="classe" name="classe" class="form-control" value="<?php echo strip_tags($classe['classe']); ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="ok">Modifier</button>
        </form>
    </div>
</body>

</html>