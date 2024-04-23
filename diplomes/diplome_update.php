<?php session_start();
require_once(__DIR__ . "/../config/mysql.php");
require_once(__DIR__ . "/../include/variables.php");

$getData = $_GET;

if (!isset($getData['id']) || !is_numeric($getData['id'])) {
    $_SESSION['ID_DIPLOME_ERROR'] = "Il faut un identifiant de diplome pour la modifier";
    header("location: liste_diplome.php");
    exit();
} else {
    $retrieveDiplomeStatement = $mysqlClient->prepare('SELECT * FROM Diplomes WHERE diplome_id = :id');
    $retrieveDiplomeStatement->execute([
        'id' => $getData['id']
    ]);

    $diplome = $retrieveDiplomeStatement->fetch(PDO::FETCH_ASSOC);

    if (!$diplome) {
        $_SESSION['NO_DIPLOME'] = "Aucun diplôme trouvé avec cet ID" . $getData['id'];
        header("location: liste_diplome.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification de diplôme</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php require_once($rootPath . "/CRUD/include/header.php"); ?>
    <div class="container">
        <h1 class="mt-2 mb-3">Modifier le diplome : <?php echo ($diplome['diplome']); ?></h1>
        <form action="<?php echo ($rootUrl . 'diplomes/checking/post_diplome_update.php'); ?>" method="POST">

            <?php if (isset($_SESSION['EDIT_DIPLOME_ERROR'])) : ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['EDIT_DIPLOME_ERROR'];
                    unset($_SESSION['EDIT_DIPLOME_ERROR']); ?>
                </div>
            <?php endif; ?>

            <div class="mb-3 visually-hidden">
                <label for="id" class="form-label">Identifiant du diplome</label>
                <input type="hidden" class="form-control" id="diplome_id" name="diplome_id" value="<?php echo ($getData["id"]); ?>">
            </div>
            <div class="mb-3">
                <label for="diplome" class="form-label">Diplome</label>
                <input type="text" id="diplome" name="diplome" class="form-control" value="<?php echo strip_tags($diplome['diplome']); ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="ok">Modifier</button>
        </form>
    </div>
</body>

</html>