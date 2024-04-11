<?php
require_once(__DIR__ . "/include/variables.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des élèves</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="d-flex flex-column min-vh-100 bg-dark text-light">
    <div class="container">
        <?php require_once(__DIR__ . "/include/header.php"); ?>
        <h1 class="mt-2 mb-3">Liste d'élèves</h1>
        <table class="table table-dark">
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
            <?php foreach ($elevesD as $eleveD) : ?>
                <tbody>
                    <tr>
                        <th scope="row"><?php echo $eleveD['eleve_id'] ?></th>
                        <td><?php echo $eleveD['nom']; ?></td>
                        <td><?php echo $eleveD['prenom']; ?></td>
                        <td><?php echo $eleveD['ville']; ?></td>
                        <td><?php echo $eleveD['sexe']; ?></td>
                        <td><?php echo $eleveD['naissance']; ?></td>
                        <td><?php echo $eleveD['classe']; ?></td>
                        <td><?php echo $eleveD['diplome']; ?></td>
                    </tr>
                </tbody>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>