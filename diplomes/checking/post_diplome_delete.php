<?php
session_start();

require_once(__DIR__ . "/../../config/mysql.php");
require_once(__DIR__ . "/../../include/variables.php");

if (!isset($_POST['id']) || $_POST['id'] == '5') {
    $_SESSION['DIPLOME_ID_ERROR'] = "Il faut un identifiant d'élève pour le supprimer";
    header("location: /CRUD/diplomes/liste_diplome.php");
    exit();
} else {
    $id = $_POST['id'];

    $deletediplomeStatement = $mysqlClient->prepare('DELETE FROM Diplomes WHERE diplome_id = :id');
    $deletediplomeStatement->execute([
        'id' => $id,
    ]);

    if ($deletediplomeStatement) {
        $_SESSION['SUPP_DIPLOME'] = "La diplome a bien été supprimée";
        header('location: /CRUD/diplomes/liste_diplomes.php');
    } else {
        $_SESSION['SUPP_DIPLOME_ERROR'] = "Un problème est survenu lors de l'opération";
        header("location: /CRUD/diplomes/diplome_delete.php?id=" . $id);
        exit();
    }
}
