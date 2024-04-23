<?php 
session_start();
require_once(__DIR__ . "/../../config/mysql.php");
require_once(__DIR__ . "/../../include/functions.php");

$postData = $_POST;

if (isset($postData["ok"])) {
    test_input($postData["classe"]);
    extract($postData, EXTR_SKIP);
    if(!empty($classe_id) && !empty($classe)) {
        $requeteStatement = $mysqlClient->prepare('UPDATE classes SET classe = :classe WHERE classe_id = :classe_id');
        $requeteStatement->execute(
            array(
                'classe' => $classe,
                'classe_id' => $classe_id
            )
        );
        if ($requeteStatement) {
            $_SESSION['EDIT_CLASSE_SUCCESS'] = "Votre classe a bien été modifié";
            header("location: /CRUD/classes/liste_classe.php");
        } else {
            $_SESSION['EDIT_CLASSE_ERROR'] = "Une erreur est survenu lors du transfert des données";
            header('location: /CRUD/classes/classe_update.php?id=' . $classe_id);
            exit();
        }
    } else {
        $_SESSION['EDIT_CLASSE_ERROR'] = "Veuillez remplir tous les champs";
        header("location: /CRUD/classes/classe_update.php?id=" . $classe_id);
        exit();
    }
}