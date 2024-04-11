<?php
//Fonction qui vérifie les donénes entrées
function test_input($postData)
{
    $postData = trim($postData);
    $postData = stripslashes($postData);
    $postData = htmlspecialchars($postData);
    return $postData;
}