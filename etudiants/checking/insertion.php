<?php
session_start();
require_once(__DIR__ . "/../../config/mysql.php");
require_once(__DIR__ . "/../../include/functions.php");

$postData = $_POST;

if (isset($postData['ok'])) {
    test_input($postData['nom'], $postData['prenom'], $postData['ville']);
    extract($postData, EXTR_SKIP);
    if (!empty($nom) && !empty($prenom) && !empty($ville) && !empty($sexe) && !empty($naissance) && !empty($classe_id) && !empty($diplomes)) {
        $hasDiplome = false;
        $hasNoDiplome = false;
        foreach ($diplomes as $diplome) {
            if ($diplome == '1') {
                $hasNoDiplome = true;
            } else {
                $hasDiplome = true;
            }
        }
        if ($hasDiplome && $hasNoDiplome) {
            $_SESSION['ADD_ERROR'] = "Veuillez séléctionner des options valides pour les diplômes";
            header("location: /CRUD/etudiants/ajout.php");
            exit();
        } else {
            $requete = $mysqlClient->prepare("INSERT INTO etudiant (nom, prenom, ville, sexe, naissance, email, phone, classe_id) VALUES (:nom, :prenom, :ville, :sexe, :naissance, :classe_id)");
            $requete->execute(
                [
                    "nom" => $nom,
                    "prenom" => $prenom,
                    "ville" => $ville,
                    "sexe" => $sexe,
                    "naissance" => $naissance,
                    "email" => $email,
                    "phone" => $phone,
                    "classe_id" => $classe_id
                ]
            );
            $requeteID = $mysqlClient->query("SELECT LAST_INSERT_ID() etudiant_id")->fetch();
            $etudiantID = $requeteID["etudiant_id"];
            if ($requete) {
                foreach ($diplomes as $diplome) {
                    $requeteDiplomes = $mysqlClient->prepare("INSERT INTO possede (etudiant_id, diplome_id) VALUES (:etudiant_id, :diplome_id)");
                    $requeteDiplomes->execute(
                        [
                            "etudiant_id" => $etudiantID,
                            "diplome_id" => $diplome
                        ]
                    );
                }
            } else {
                $_SESSION['ADD_ERROR'] = "Une erreur est survenu lors du transfert des données";
                header("location: /CRUD/etudiants/ajout.php");
                exit();
            }
            if ($requete && $requeteDiplomes) {
                $_SESSION['ADD_SUCCESS'] = "Votre étudiant a bien été ajouté";
                header("location: /CRUD/index.php");
            } else {
                $_SESSION['ADD_ERROR'] = "Une erreur est survenu lors du transfert des données";
                header("location: /CRUD/etudiants/ajout.php");
                exit();
            }
        }
    } else {
        $_SESSION['ADD_ERROR'] = "Veuillez remplir tous les champs avec des informations valides";
        header("location: /CRUD/etudiants/ajout.php");
        exit();
    }
}
