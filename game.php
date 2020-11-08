<?php
session_start();
include 'header.php';


if(empty($_SESSION['log'])) {

    header('Location: login.php');
}

?>

<div class="container">

    bonjour <p id="pseudo"> <?php echo  $_SESSION['pseudo']?></p>

<div class="titregame">
    <h5> PAGE DE JEUX </h5>
</div>

<div class="jeux">
    <h6> Voici votre defi du jour</h6>
    <span id="nbr1">  </span>
    <small id="croix">X</small>
    <span id="nbr2"></span> <br>
    <input id="resultat" type="text"> <br>
    <button id="valider" type="submit" class="btn">VALIDER</button>

</div>


    <div id ="succes" class="alert alert-success" role="alert">
        Bravo bonne reponse!
    </div>
    <div id="danger" class="alert alert-danger" role="alert">
        Mauvaise reponse!
    </div>


</div>





<?php
require_once ("footer.php");
