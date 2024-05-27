<?php
session_start();
require_once(__DIR__ . "/../../config/mysql.php");
require_once(__DIR__ . "/../../include/functions.php");

$postData = $_POST;

if (isset($postData['ok'])) {
    test_input($postData['nom']);
    test_input($postData['prenom']);
    test_input($postData['ville']);
    extract($postData, EXTR_SKIP);
    if (!empty($etudiant_id) && !empty($nom) && !empty($prenom) && !empty($ville) && !empty($sexe) && !empty($naissance) && !empty($classe_id)) {
        $requeteStatement = $mysqlClient->prepare('UPDATE etudiant SET nom = :nom, prenom = :prenom, ville = :ville, sexe = :sexe, naissance = :naissance, classe_id = :classe_id WHERE etudiant_id = :etudiant_id');
        $requeteStatement->execute(
            array(
                'nom' => $nom,
                'prenom' => $prenom,
                'ville' => $ville,
                'sexe' => $sexe,
                'naissance' => $naissance,
                'classe_id' => $classe_id,
                'etudiant_id' => $etudiant_id
            )
        );
        if ($requeteStatement) {
            $_SESSION['EDIT_ELEVE_SUCCESS'] = "Votre étudiant a bien été modifié";
            header("location: /CRUD/index.php");
        } else {
            $_SESSION['EDIT_ELEVE_ERROR'] = "Une erreur est survenu lors du transfert des données";
            header('location: /CRUD/etudiants/update.php?id=' . $etudiant_id);
            exit();
        }
    } else {
        $_SESSION['EDIT_ELEVE_ERROR'] = "Veuillez remplir tous les champs";
        header("location: /CRUD/etudiants/update.php?id=" . $etudiant_id);
        exit();
    }
}