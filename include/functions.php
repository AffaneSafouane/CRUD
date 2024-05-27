<?php
//Fonction qui vérifie les données entrées
function test_input($postData) {
    $postData = trim($postData);
    $postData = stripslashes($postData); 
    $postData = htmlspecialchars($postData);
    return $postData;
}

function showEtudiant($mysqlClient) {
    $etudiantStatement = $mysqlClient->prepare('SELECT e.etudiant_id, e.nom, e.prenom, e.ville, e.sexe, e.naissance, cl.classe
        FROM etudiant e
        JOIN Classes cl ON e.classe_id = cl.classe_id
        ORDER BY e.etudiant_id');
    $etudiantStatement->execute();
    $etudiants = $etudiantStatement->fetchAll();
    return $etudiants;
}

function showDiplome($mysqlClient) {
    $diplomeEtudiantStatement = $mysqlClient->prepare('SELECT e.etudiant_id, e.nom, e.prenom, e.ville, e.sexe, e.naissance, d.diplome, cl.classe
        FROM etudiant e
        JOIN Possede po ON e.etudiant_id = po.etudiant_id
        JOIN Diplomes d ON d.diplome_id = po.diplome_id
        JOIN Classes cl ON e.classe_id = cl.classe_id
        ORDER BY e.etudiant_id');
    $diplomeEtudiantStatement->execute();
    $etudiantsDi = $diplomeEtudiantStatement->fetchAll(PDO::FETCH_ASSOC);
    return $etudiantsDi;
}