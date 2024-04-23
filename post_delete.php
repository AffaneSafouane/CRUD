<?php
session_start();

include_once('config/mysql.php');
include_once('include/variables.php');

if (!isset($_POST['id'])) {
	$_SESSION['ID_ERROR'] = "Il faut un identifiant d'élève pour le supprimer";
    header("location: delete.php");
    exit();
}	

$id = $_POST['id'];

$deleteEleveStatement = $mysqlClient->prepare('DELETE FROM eleve WHERE eleve_id = :id');
$deleteEleveStatement->execute([
    'id' => $id,
]);

header('Location: index.php');
?>