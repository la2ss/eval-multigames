
// au chargement de la page execute ce aui ce trouve ds la fonction
$(document).ready(function () {



random();

    $('#succes').hide();
    $('#danger').hide();

tentative();



})


// creation function randon avec une requette ajax pour generer chiffre aleatoire

function random(){

    $.ajax({


        method: "GET", // permet recuperer les nb ds server.php
        url: "server.php",
        data: {nbr: 1},
        cache: false,
        dataType: "json"

        // done veut dire que si la requete ses bien effectue fait la execution

    }).done(function (response) {


        // response contient le resultat de la requette AJAX converti en JSON

        let nbr1 = response.a;
        let nbr2 = response.b;

        //
        $("#nbr1").text(nbr1);
        $("#nbr2").text(nbr2);

    })


}


function tentative () {


    $('#valider').click(function () {

        let nbrSaisi = Number($('#resultat').val());

        console.log(nbrSaisi);

        let nbr1 = $("#nbr1").text();
        let nbr2 = $("#nbr2").text();
        let resultat = nbr1 * nbr2;


        if(resultat === nbrSaisi) {

            $('#resultat').val();
            $('#succes').show();
            $('#danger').hide();



        } else {

            $('#resultat').val();
            $('#succes').hide();
            $('#danger').show();

        }

            resultatTentative();
            random();
    })

}

function resultatTentative () {

    let nbr1 = $("#nbr1").text();
    let nbr2 = $("#nbr2").text();
    let small = $("#small").text();
    let resultat = nbr1 * nbr2;
    let multiplication = nbr1 + small+ nbr2;
    let reponse = Number($('#resultat').val());
    let correct = (resultat === reponse ? reponse = "OUI" : reponse= "NON");
    let pseudo = $('#pseudo');

    console.log(multiplication);
    console.log(reponse);


    $.ajax({

        method: "POST",
        url: "server.php",
        data: {tentative: 1, multiplication: multiplication, reponse: reponse, correct: correct, pseudo: pseudo }

    })

}