<?php
require_once ("cnx/connexion.php");
require_once ("header.php");
session_start();
$connexion=connect_db();


if(isset($_POST['envoyer'])) {
    // 1)le code sera executer si seulement le formulaire est envoyer
//if(!empty($_POST['pseudo']) || !empty($_POST['mdp']) || !empty($_POST['mdpConfirm']) || !empty($_POST['cgu']) ){

    //2)declarations des variables
    $pseudo     = htmlspecialchars(trim($_POST['pseudo']));
    $mdp        = trim($_POST['mdp']);
    $mdpConfirm =  trim($_POST['mdpConfirm']);



       //a)le champs pseudo obligatoire

    if(empty($pseudo)){

        header('Location: register.php?error=1&login=1');
        die();
    }

        //b)verification des mdp identiques
    if($mdp != $mdpConfirm){
        header('Location: register.php?error=1&pass=1');
        die();
    }

    if(!isset($_POST['cgu'])) {

        header('Location: register.php?error=1&cgu=1');
        die();
    }


    //3)test si pseudo est deja utiliser
$req = $connexion->prepare("SELECT count(*) as pseudo FROM users WHERE pseudo = ? ");
$req->execute(array($pseudo));

//parcourir tt les element de la requete pr verifier si le pseudo est deja utiliser
while ($pseudoVerification = $req->fetch()){
    if($pseudoVerification['pseudo'] !=0){
        header('Location: register.php?error=1&pseudo=1');
    }
}
    //cryptage du mdp
    $mdp = "abc".sha1($mdp."007")."123";


    //envoi de la requete ds la bdd pr creer un nouveau membre
    $req = $connexion->prepare("INSERT INTO users(pseudo, mdp) VALUES (?,?)");
    $req->execute(array($pseudo,$mdp));

header('Location: login.php');



}
 // fin du isset




        //b)afficher le msg d'erreur indiquant que les mdp ne sont pas identiques
     if(isset($_GET['error'])){

         if(isset($_GET['login'])) {

             echo'<p id="error">pseudo requis .</p>';
         }

         if(isset($_GET['pass'])){
    echo'<p id="error">Les mots de passe ne sont pas identiques.</p>';
         }
         elseif (isset($_GET['pseudo'])===1){
             echo'<p id="error">Ce pseudo est deja utiliser !!</p>';
         }
         if(isset($_GET['cgu']) ) {

             echo'<p id="error">CGU requis .</p>';
         }
     }

?>


    <div class="blog">
    <div class="tof">
        <img src="images/images.jpg" height="360" width="290" >
    </div>


    <form action="" method="post" class="container" >


        <h5>creer un compte</h5>

        <div class="form-groupe ">

        <div>
            <input type="text" class="form-control" id="exampleInputPseudo" name="pseudo" placeholder="entrez votre pseudo">
        </div>
        <div class="form-group ">

            <input type="password" class="form-control" id="exampleInputPassword" name="mdp" placeholder="entrez votre mdp">
        </div>
        <div class="form-group ">

            <input type="password" class="form-control" id="exampleInputPassword1" name="mdpConfirm" placeholder="confirmez mdp">
        </div>


        <div class="form-group form-check ">
            <input type="checkbox" class="form-check-input" name="cgu" id="exampleCheck1" checked>
            <label class="form-check-label" for="exampleCheck1">J'accepte les termes d'utilisation.</label>
        </div>

            <p>Vous avez deja un compte ? Connectez vous <a href="login.php">ici.</a> </p>

            <div class="form-group form-submit ">
                <button type="submit" name="envoyer" class="btn">S'enregistrer</button>

            </div>
    </form>
    </div>

<?php
require_once ("footer.php");