<?php 
session_start();
require_once(__DIR__ . "/../include/variables.php");
?>

<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une classe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php require_once($rootPath . "/CRUD/include/header.php"); ?>
    <div class="container">
        <h1 class="mt-2 mb-3">Ajouter une classe</h1>
        
        <?php if(isset($_SESSION["CLASSE_ERROR"])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION["CLASSE_ERROR"];
                unset($_SESSION["CLASSE_ERROR"]); ?>
            </div>
        <?php endif; ?>

        <?php if(isset($_SESSION["CLASSE_CLONE_ERROR"])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION["CLASSE_CLONE_ERROR"];
                unset($_SESSION["CLASSE_CLONE_ERROR"]); ?>
            </div>
        <?php endif; ?>

        <form action="<?php echo ($rootUrl . 'classes/checking/post_classe.php'); ?>" method="POST">
            <div class="mb-3">
                <label for="classe" class="form-label">Classe*</label>
                <input type="text" id="classe" name="newClasse" class="form-control" placeholder="Veuillez entrer une nouvelle classe" required>
            </div>
            <button type="submit" class="btn btn-primary" name="ok">Ajouter</button>
        </form>
    </div>
</body>
</html>