<?php
require_once(__DIR__. "/../config/mysql.php");
require_once(__DIR__ . "/../include/variables.php");
require_once(__DIR__ . "/../include/functions.php");
$listStudents=showDiplome($mysqlClient);
?>

<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des élèves</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body class="d-flex flex-column min-vh-100t">
    <?php include_once($rootPath . "/CRUD/include/header.php"); ?>
    <div class="container">
        <h1 class="mt-2 mb-3">Liste d'élèves</h1>
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
                    <th scope="col">Diplomes</th>
                </tr>
            </thead>
            <?php foreach ($listStudents as $listStudent) : ?>
                <tbody>
                    <tr>
                        <th scope="row"><?php echo $listStudent['etudiant_id'] ?></th>
                        <td><?php echo $listStudent['nom']; ?></td>
                        <td><?php echo $listStudent['prenom']; ?></td>
                        <td><?php echo $listStudent['ville']; ?></td>
                        <td><?php echo $listStudent['sexe']; ?></td>
                        <td><?php echo $listStudent['naissance']; ?></td>
                        <td><?php echo $listStudent['classe']; ?></td>
                        <td><?php echo $listStudent['diplome']; ?></td>
                    </tr>
                </tbody>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>