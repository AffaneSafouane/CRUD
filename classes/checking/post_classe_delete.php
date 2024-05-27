<?php
session_start();

require_once(__DIR__ . "/../../config/mysql.php");
require_once(__DIR__ . "/../../include/variables.php");

if (!isset($_POST['id'])) {
    $_SESSION['CLASSE_ID_ERROR'] = "Il faut un identifiant d'élève pour le supprimer";
    header("location: /CRUD/classes/liste_classe.php");
    exit();
} else {
    $id = $_POST['id'];

    $deleteClasseStatement = $mysqlClient->prepare('DELETE FROM classes WHERE classe_id = :id');
    $deleteClasseStatement->execute([
        'id' => $id,
    ]);

    if ($deleteClasseStatement) {
        $_SESSION['SUPP_CLASSE'] = "La classe a bien été supprimée";
        header('location: /CRUD/classes/liste_classe.php');
    } else {
        $_SESSION['SUPP_CLASSE_ERROR'] = "Un problème est survenu lors de l'opération";
        header("location: /CRUD/classes/classe_delete.php?id=" . $id);
        exit();
    }
}
