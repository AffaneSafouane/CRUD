<?php
require_once(__DIR__ . "/../config/mysql.php");

// On récupére le contenu des tables avec MySQL

 $eleveStatement = $mysqlClient->prepare('SELECT e.eleve_id, e.nom, e.prenom, e.ville, e.sexe, e.naissance, cl.classe
    FROM Eleve e
    JOIN Classes cl ON e.classe_id = cl.classe_id
    ORDER BY e.eleve_id');
    $eleveStatement->execute();
    $eleves = $eleveStatement->fetchAll();

 $eleveDiStatement = $mysqlClient->prepare('SELECT e.eleve_id, e.nom, e.prenom, e.ville, e.sexe, e.naissance, d.diplome, cl.classe
    FROM Eleve e
    JOIN Possede po ON e.eleve_id = po.eleve_id
    JOIN Diplomes d ON d.diplome_id = po.diplome_id
    JOIN Classes cl ON e.classe_id = cl.classe_id
    ORDER BY e.eleve_id');
    $eleveDiStatement->execute();
    $elevesDi = $eleveDiStatement->fetchAll();


$classesStatement = $mysqlClient->prepare('SELECT * FROM Classes');
$classesStatement->execute();
$classes = $classesStatement->fetchAll();

$diplomesStatement = $mysqlClient->prepare('SELECT * FROM Diplomes');
$diplomesStatement->execute();
$diplomes = $diplomesStatement->fetchAll();

$rootPath = $_SERVER['DOCUMENT_ROOT'];
$rootUrl = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/CRUD/';
