<?php session_start();

include_once('config/mysql.php');
include_once('include/variables.php');

$getData = $_GET;

if (!isset($getData['id']) && is_numeric($getData['id'])) {
	$_SESSION['ID_ERROR'] = "Il faut un identifiant d'élève pour le supprimer";
    header("location: index.php");
    exit();
}	

$retrieveEleveStatement = $mysqlClient->prepare('SELECT * FROM eleve WHERE eleve_id = :id');
$retrieveEleveStatement->execute([
    'id' => $getData['id'],
]);

$eleve = $retrieveEleveStatement->fetch(PDO::FETCH_ASSOC);

// Si l'élève n'est pas trouvé, renvoyer un message d'erreur
if (!$eleve) {
    $_SESSION['NO_ELEVE'] = "Aucun élève trouvé avec cette ID " . $getData['id'];
    header("location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un élève</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="d-flex flex-column min-vh-100 bg-dark text-light">
    <div class="container">
        <?php include_once(__DIR__ . '/include/header.php')?>
        <?php if(isset($_SESSION['ID_ERROR'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['ID_ERROR'];
                unset($_SESSION['ID_ERROR']); ?>
            </div>
        <?php endif; ?>
        <h1 class="mb-3">Supprimer l'élève ?</h1>
        <form action="post_delete.php" method="POST">
            <div class="mb-3 visually-hidden">
                <label for="id" class="form-label">Identifiant de l'élève</label>
                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $_GET['id']; ?>">
            </div>
            <button type="submit" class="btn btn-danger">La suppression est définitive</button>
        </form>
    </div>
</body>
</html>