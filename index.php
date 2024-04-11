<?php
require_once(__DIR__ . "/include/variables.php");
require_once(__DIR__."/insertion.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="d-flex flex-column min-vh-100 bg-dark text-light">
    <div class="container">
        <?php require_once(__DIR__ . "/include/header.php"); ?>
        <?php if(isset($_SESSION['ADD_SUCCESS'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['ADD_SUCCESS'];
                unset($_SESSION['ADD_SUCCESS']); ?>
            </div>
        <?php endif; ?>
        <?php if(isset($_SESSION['ID_ERROR'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['ID_ERROR'];
                unset($_SESSION['ID_ERROR']); ?>
            </div>
        <?php endif; ?>
        <?php if(isset($_SESSION['NO_ELEVE'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['NO_ELEVE'];
                unset($_SESSION['NO_ELEVE']); ?>
            </div>
        <?php endif; ?>
        <h1 class="mt-2 mb-3">Student List</h1>
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
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <?php foreach ($eleves as $eleve) : ?>
                <tbody>
                    <tr>
                        <th scope="row"><?php echo $eleve['eleve_id'] ?></th>
                        <td><?php echo $eleve['nom']; ?></td>
                        <td><?php echo $eleve['prenom']; ?></td>
                        <td><?php echo $eleve['ville']; ?></td>
                        <td><?php echo $eleve['sexe']; ?></td>
                        <td><?php echo $eleve['naissance']; ?></td>
                        <td><?php echo $eleve['classe']; ?></td>
                        <td><a class="link-warning" href="update.php?id=<?php echo($eleve['eleve_id']); ?>">Editer</a></td>
                        <td><a class="link-danger" href="delete.php?id=<?php echo($eleve['eleve_id']); ?>">Supprimer</a></td>
                    </tr>
                </tbody>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>