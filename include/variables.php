<?php
require_once(__DIR__ . "/../config/mysql.php");

// On récupére le contenu des tables avec MySQL

$classesStatement = $mysqlClient->prepare('SELECT * FROM Classes');
$classesStatement->execute();
$classes = $classesStatement->fetchAll();

$diplomesStatement = $mysqlClient->prepare('SELECT * FROM Diplomes');
$diplomesStatement->execute();
$diplomes = $diplomesStatement->fetchAll();

$rootPath = $_SERVER['DOCUMENT_ROOT'];
$rootUrl = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/CRUD/';
