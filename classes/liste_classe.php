<?php 
session_start();
require_once(__DIR__ . "/../include/variables.php");
?>

<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des classes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php require_once($rootPath . "/CRUD/include/header.php"); ?>
    <div class="container">
        <?php if(isset($_SESSION['CLASSE_SUCCESS'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['CLASSE_SUCCESS'];
                unset($_SESSION['CLASSE_SUCCESS']); ?>
            </div>
        <?php endif; ?>

        <?php if(isset($_SESSION['CLASSE_ID_ERROR'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['CLASSE_ID_ERROR'];
                unset($_SESSION['CLASSE_ID_ERROR']); ?>
            </div>
        <?php endif; ?>

        <?php if(isset($_SESSION['NO_CLASSE'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['NO_CLASSE'];
                unset($_SESSION['NO_CLASSE']); ?>
            </div>
        <?php endif; ?>

        <?php if(isset($_SESSION['EDIT_CLASSE_SUCCESS'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['EDIT_CLASSE_SUCCESS'];
                unset($_SESSION['EDIT_CLASSE_SUCCESS']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['SUPP_CLASSE'])) : ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['SUPP_CLASSE'];
                unset($_SESSION['SUPP_CLASSE']); ?>
            </div>
        <?php endif; ?>

        <h1 class="mt-2 mb-3">Class List</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Classe</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <?php foreach ($classes as $classe): ?>
                <tbody>
                    <tr>
                        <th scope="row"><?php echo $classe['classe_id']; ?></th>
                        <td><?php echo $classe["classe"]; ?></td>
                        <td><a class="link-warning" href="classe_update.php?id=<?php echo($classe["classe_id"]); ?>">Editer</a></td>
                        <td><a class="link-danger" href="classe_delete.php?id=<?php echo($classe["classe_id"]); ?>">Supprimer</a></td>
                    </tr>
                </tbody>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>