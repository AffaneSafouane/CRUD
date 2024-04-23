<?php
session_start();
require_once(__DIR__ . "/../../config/mysql.php");
require_once(__DIR__ . "/../../include/functions.php");
require_once(__DIR__ . "/../../include/variables.php");

$postData = $_POST;

if (isset($postData['ok'])) {
    test_input(($postData["newDiplome"]));
    extract($postData, EXTR_SKIP);
    if (!empty($newDiplome)) {
        $requete = $mysqlClient->prepare("SELECT diplome_id FROM Diplomes WHERE diplome = :newDiplome");
        $requete->execute(array('newDiplome' => $newDiplome));
        $count = $requete->rowCount();
        if ($count) {
            $_SESSION["DIPLOME_CLONE_ERROR"] = "Le diplôme " . $newDiplome . " existe déjà";
            header("location: /CRUD/diplomes/diplome.php");
            exit();
        } else {
            $requete = $mysqlClient->prepare("INSERT INTO Diplomes (diplome) VALUES (:newDiplome)");
            $requete->execute(
                array(
                    "newDiplome" => $newDiplome
                )
            );
            if ($requete) {
                $_SESSION["DIPLOME_SUCCESS"] = "Votre diplome a bien été ajouté";
                header("location: /CRUD/diplomes/liste_diplomes.php");
            } else {
                $_SESSION["DIPLOME_ERROR"] = "Un problème a été rencontré lors du transfert des données";
                header("location: /CRUD/diplomes/diplome.php");
                exit();
            }
        }
    } else {
        $_SESSION["DIPLOME_ERROR"] = "Veuillez entrer un diplome à ajouter";
        header("location: /CRUD/diplomes/diplome.php");
        exit();
    }
}