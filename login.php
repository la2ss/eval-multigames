<?php
require_once ("cnx/connexion.php");
require_once ("header.php");
session_start();
$connexion = connect_db();



if (isset($_POST['envoyer'])) {
    $pseudo = htmlspecialchars(trim($_POST['pseudo']));
    $mdp = trim($_POST['mdp']);


    $mdp = "abc".sha1($mdp."007")."123";

    if (!empty($pseudo) and !empty($mdp)) {




        $reqlogin = $connexion->prepare("SELECT * FROM users WHERE pseudo= ? && mdp= ?");
        $reqlogin->execute(array($pseudo, $mdp));

        $rslt = $reqlogin->rowCount();
        if ($rslt == 1) {

            $resultat = $reqlogin->fetch();
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['log'] = $rslt;



            header('Location: game.php');
        } else {
            header('Location: login.php?error=1&log=1');

        }

    } else {

        header('Location: login.php?error=1&input=1');
    }

}


?>

    <form action="" method="post" class="container" id="secondfrm">

        <?php

        if (isset($_GET['error'])) {
            if (isset($_GET['input'])) {
                echo '<p id="error">ts les champs doivent etre completes.</p>';
            } elseif (isset($_GET['log'])) {
                echo '<p id=error>pseudo ou mot de passe incorrects </p>';
            }
        }
        ?>

        <div class="form-group">
            <div class="cadenas">
                <i class="fas fa-lock-open fa-5x"></i>
            </div>

            <input type="text" class="form-control" id="exampleInputEmail1" name="pseudo"
                   placeholder="entrez votre pseudo">
        </div>
        <div class="form-group">

            <input type="password" class="form-control" id="exampleInputPassword1" name="mdp"
                   placeholder="entrez votre mdp">
        </div>

        <p>Vous n'avez de compte ? Creez en un <a href="register.php">ici</a></p>
<div>
    <button type="submit" name="envoyer" class="btn btn-primary" id="frmcnx">connexion</button>

</div>


    </form>

<?php
require_once("footer.php");
