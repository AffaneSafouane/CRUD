<?php
session_start();
require_once(__DIR__ . "/../../config/mysql.php");
require_once(__DIR__ . "/../../include/functions.php");
require_once(__DIR__ . "/../../include/variables.php");

$postData = $_POST;

if (isset($postData['ok'])) {
    test_input(($postData["newClasse"]));
    extract($postData, EXTR_SKIP);
    if (!empty($newClasse)) {
        $requete = $mysqlClient->prepare("SELECT classe_id FROM Classes WHERE classe = :newClasse");
        $requete->execute(array('newClasse' => $newClasse));
        $count = $requete->rowCount();
        if ($count) {
            $_SESSION["CLASSE_CLONE_ERROR"] = "La classe " . $newClasse . " existe déjà";
            header("location: /CRUD/classes/classe.php");
            exit();
        } else {
            $requete = $mysqlClient->prepare("INSERT INTO Classes (classe) VALUES (:newClasse)");
            $requete->execute(
                array(
                    "newClasse" => $newClasse
                )
            );
            if ($requete) {
                $_SESSION["CLASSE_SUCCESS"] = "Votre classe a bien été ajoutée";
                header("location: /CRUD/classes/liste_classe.php");
            } else {
                $_SESSION["CLASSE_ERROR"] = "Un problème a été rencontré lors du transfert des données";
                header("location: /CRUD/classes/classe.php");
                exit();
            }
        }
    } else {
        $_SESSION["CLASSE_ERROR"] = "Veuillez entrer une classe à ajouter";
        header("location: /CRUD/classes/classe.php");
        exit();
    }
}
