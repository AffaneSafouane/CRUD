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
    if (!empty($nom) && !empty($prenom) && !empty($ville) && !empty($sexe) && !empty($naissance) && !empty($classe_id) && !empty($diplomes)) {
        if (count($diplomes) < 3) {
            $hasDiplome = false;
            $hasNoDiplome = false;
            foreach ($diplomes as $diplome) {
                if ($diplome == '5') {
                    $hasNoDiplome = true;
                } else {
                    $hasDiplome = true;
                }
            }
            if ($hasDiplome && $hasNoDiplome) {
                $_SESSION['ADD_ERROR'][] = "Veuillez séléctionner des options valides pour les diplômes";
                header("location: ajout.php");
                exit();
            } else {
                $hasDiplome2 = false;
                $hasDiplome3 = false;
                $hasDiplome4 = false;
                foreach ($diplomes as $diplome) {
                    switch ($diplome) {
                        case '2':
                            $hasDiplome2 = true;
                            break;
                        case '3':
                            $hasDiplome3 = true;
                            break;
                        case '4':
                            $hasDiplome4 = true;
                            break;
                    }
                }
                if ($hasDiplome2 && $hasDiplome3) {
                    $_SESSION['ADD_ERROR'][] = "Vous ne pouvez pas avoir deux baccalauréats";
                    header("location: ajout.php");
                    exit();
                } elseif ($hasDiplome2 && $hasDiplome4) {
                    $_SESSION['ADD_ERROR'][] = "Vous ne pouvez pas avoir deux baccalauréats";
                    header("location: ajout.php");
                    exit();
                } elseif ($hasDiplome3 && $hasDiplome4) {
                    $_SESSION['ADD_ERROR'][] = "Vous ne pouvez pas avoir deux baccalauréats";
                    header("location: ajout.php");
                    exit();
                } else {
                    $requete = $mysqlClient->prepare("INSERT INTO eleve (nom, prenom, ville, sexe, naissance, classe_id) VALUES (:nom, :prenom, :ville, :sexe, :naissance, :classe_id)");
                    $requete->execute(
                        array(
                            "nom" => $nom,
                            "prenom" => $prenom,
                            "ville" => $ville,
                            "sexe" => $sexe,
                            "naissance" => $naissance,
                            "classe_id" => $classe_id
                        )
                    );
                    $requeteID = $mysqlClient->query("SELECT LAST_INSERT_ID() eleve_id")->fetch();
                    $eleveID = $requeteID["eleve_id"];
                    if ($requete) {
                        foreach ($diplomes as $diplome) {
                            $requeteDiplomes = $mysqlClient->prepare("INSERT INTO possede (eleve_id, diplome_id) VALUES (:eleve_id, :diplome_id)");
                            $requeteDiplomes->execute(
                                array(
                                    "eleve_id" => $eleveID,
                                    "diplome_id" => $diplome
                                )
                            );
                        }
                    } else {
                        $_SESSION['ADD_ERROR'][] = "Une erreur est survenu lors du transfert des données";
                        header("location: ajout.php");
                        exit();
                    }
                    if ($requete && $requeteDiplomes) {
                        $_SESSION['ADD_SUCCESS'] = "Votre élève a bien été ajouté";
                        header("location: index.php");
                    } else {
                        $_SESSION['ADD_ERROR'][] = "Une erreur est survenu lors du transfert des données";
                        header("location: ajout.php");
                        exit();
                    }
                }
            }
        } else {
            $_SESSION['ADD_ERROR'][] = "Vous ne pouvez pas avoir plus de deux diplômes";
            header("location: ajout.php");
            exit();
        }
    } else {
        $_SESSION['ADD_ERROR'][] = "Veuillez remplir tous les champs avec des informations valides";
        header("location: ajout.php");
        exit();
    }
}
