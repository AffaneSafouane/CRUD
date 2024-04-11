<?php
session_start();
require_once(__DIR__ . "/config/mysql.php");
require_once(__DIR__ . "/include/functions.php");

$postData = $_POST;

if (isset($postData['ok'])) {
    test_input($postData['nom']);
    test_input($postData['prenom']);
    test_input($postData['ville']);
    extract($postData, EXTR_SKIP);
    if (!empty($eleve_id) && !empty($nom) && !empty($prenom) && !empty($ville) && !empty($sexe) && !empty($naissance) && !empty($classe_id)) {
        $requeteStatement = $mysqlClient->prepare('UPDATE eleve SET nom = :nom, prenom = :prenom, ville = :ville, sexe = :sexe, naissance = :naissance, classe_id = :classe_id WHERE eleve_id = :eleve_id');
        $requeteStatement->execute(
            array(
                'nom' => $nom,
                'prenom' => $prenom,
                'ville' => $ville,
                'sexe' => $sexe,
                'naissance' => $naissance,
                'classe_id' => $classe_id,
                'eleve_id' => $eleve_id
            )
        );
        if ($requeteStatement) {
            $_SESSION['EDIT_SUCCESS'] = "Votre élève a bien été modifié";
            header("location: index.php");
        } else {
            $_SESSION['EDIT_ERROR'][] = "Une erreur est survenu lors du transfert des données";
            header('location: update.php');
            exit();
        }
    } else {
        $_SESSION['EDIT_ERROR'][] = "Veuillez remplir tous les champs avec des informations valides";
        header("location: update.php");
        exit();
    }
}