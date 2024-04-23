<?php 
session_start();
require_once(__DIR__ . "/../../config/mysql.php");
require_once(__DIR__ . "/../../include/functions.php");

$postData = $_POST;

if (isset($postData["ok"])) {
    test_input($postData["diplome"]);
    extract($postData, EXTR_SKIP);
    if(!empty($diplome_id) && !empty($diplome)) {
        $requeteStatement = $mysqlClient->prepare('UPDATE Diplomes SET diplome = :diplome WHERE diplome_id = :diplome_id');
        $requeteStatement->execute(
            array(
                'diplome' => $diplome,
                'diplome_id' => $diplome_id
            )
        );
        if ($requeteStatement) {
            $_SESSION['EDIT_DIPLOME_SUCCESS'] = "Votre diplome a bien été modifié";
            header("location: /CRUD/diplomes/liste_diplomes.php");
        } else {
            $_SESSION['EDIT_DIPLOME_ERROR'] = "Une erreur est survenu lors du transfert des données";
            header('location: /CRUD/diplomes/diplome_update.php?id=' . $diplome_id);
            exit();
        }
    } else {
        $_SESSION['EDIT_DIPLOME_ERROR'] = "Veuillez remplir tous les champs";
        header("location: /CRUD/diplomes/diplome_update.php?id=" . $diplome_id);
        exit();
    }
}