<?php
require_once ("cnx/connexion.php");

$cnx = connect_db();


// si la requet AJAX existe bien on rentre ds la condition
if(isset($_GET['nbr'])) {

// mt_rand correspond pour generer un chiffre de type INT aleatoire
       $nbr['a'] = mt_rand(10, 100);
       $nbr['b'] = mt_rand(10, 100);

       // pour convertir le php en JSON
       echo json_encode($nbr);

}

if(isset($_POST['tentative'])) {

    $multiplication = $_POST['multiplication'];
    $reponse = $_POST['reponse'];
    $correct = $_POST['correct'];
    $pseudo = $_POST['pseudo'];

    $requet = "INSERT INTO tentatives VALUES operation=?, reponse=?, statut=?, pseudo=?";

    $reqPreparer = $cnx-> prepare($requet);
    $reqPreparer-> execute(array($multiplication, $reponse, $correct));
    $reqPreparer->closeCursor();


}

