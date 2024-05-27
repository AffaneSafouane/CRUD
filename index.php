<?php
session_start();
require_once(__DIR__. "/config/mysql.php");
require_once(__DIR__ . "/include/variables.php");
require_once(__DIR__ . "/include/functions.php");
$students = showEtudiant($mysqlClient);
?>

<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php include_once($rootPath . "/CRUD/include/header.php"); ?>
    <div class="container">
        <?php if (isset($_SESSION['ADD_SUCCESS'])) : ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['ADD_SUCCESS'];
                unset($_SESSION['ADD_SUCCESS']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['ELEVE_ID_ERROR'])) : ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['ELEVE_ID_ERROR'];
                unset($_SESSION['ELEVE_ID_ERROR']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['NO_ELEVE'])) : ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['NO_ELEVE'];
                unset($_SESSION['NO_ELEVE']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['EDIT_ELEVE_SUCCESS'])) : ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['EDIT_ELEVE_SUCCESS'];
                unset($_SESSION['EDIT_ELEVE_SUCCESS']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['SUPP_ELEVE'])) : ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['SUPP_ELEVE'];
                unset($_SESSION['SUPP_ELEVE']); ?>
            </div>
        <?php endif; ?>

        <h1 class="mt-2 mb-3">Student List</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Ville</th>
                    <th scope="col">Sexe</th>
                    <th scope="col">Date de naissance</th>
                    <th scope="col">Classe</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $key => $student) : ?>
                    <tr>
                        <th scope="row"><?php echo $key + 1; ?></th>
                        <td><?php echo $student['nom']; ?></td>
                        <td><?php echo $student['prenom']; ?></td>
                        <td><?php echo $student['ville']; ?></td>
                        <td><?php echo $student['sexe']; ?></td>
                        <td><?php echo $student['naissance']; ?></td>
                        <td><?php echo $student['classe']; ?></td>
                        <td><a class="link-warning" href="/CRUD/etudiants/update.php?id=<?php echo ($student['etudiant_id']); ?>">Editer</a></td>
                        <td><a class="link-danger" href="/CRUD/etudiants/delete.php?id=<?php echo ($student['etudiant_id']); ?>">Supprimer</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>