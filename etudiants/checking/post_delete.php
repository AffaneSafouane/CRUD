<?php
session_start();

require_once(__DIR__ . "/../../config/mysql.php");
require_once(__DIR__ . "/../../include/variables.php");

if (!isset($_POST['id'])) {
	$_SESSION['ELEVE_ID_ERROR'] = "Il faut un identifiant d'élève pour le supprimer";
    header("location: /CRUD/index.php");
    exit();
}	

$id = $_POST['id'];

$deleteEtudiantStatement = $mysqlClient->prepare('DELETE FROM etudiant WHERE etudiant_id = :id');
$deleteEtudiantStatement->execute([
    'id' => $id,
]);

if ($deleteetudiantStatement) {
    $_SESSION['SUPP_ELEVE'] = "L'étudiant a bien été supprimé";
    header('Location: /CRUD/index.php');
} else {
    $_SESSION['SUPP_ELEVE_ERROR'] = "Un problème est survenu lors de l'opération";
    header("location: /CRUD/etudiants/delete.php?id=" . $id);
    exit();
}
?>