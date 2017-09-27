$(document).ready(function() {
    // gameConfirm('<img src="../img/pendu.png" alt="">')
    function gameConfirm(message) {

        var modalConfirm = '<div class="modal fade" id="game-confirm" tabindex="-1" role="dialog" aria-labelledby="confirm">';
        modalConfirm += '<div class="modal-dialog">';
        modalConfirm += '<div class="modal-content">';
        modalConfirm += '<div class="modal-header">';
        modalConfirm += '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
        modalConfirm += '<h4 class="modal-title text-center">Bonhomme Pendu</h4>';
        modalConfirm += '</div>';
        modalConfirm += '<div class="modal-body text-center">';
        modalConfirm += '<p>' + message + '</p>';
        modalConfirm += '</div>';
        modalConfirm += '<div class="modal-footer">';
        modalConfirm += '<button type="button" class="btn btn-default" data-dismiss="modal" data-confirm="cancel">Annuler</button>';
        modalConfirm += '<button type="button" class="btn btn-primary" data-confirm="confirm">OK</button>';
        modalConfirm += '</div>';
        modalConfirm += '</div>';
        modalConfirm += '</div>';
        modalConfirm += '</div>';

        $('body').append(modalConfirm);

        $('#game-confirm').modal('toggle');

    }

    //function de nombre aléatoire
    function rand(min, max) {

        return Math.floor(Math.random() * (max - min)) + min;
    }

    function redirecTo() {
        document.location.href = "#";
    }

    var words = [
        "autocthone", "degager", "tortue", "mangouste", "coelacanthe", "mangue","papaye",
         "litchi","mangrove", "salamandre", "lezard", "maki","cocotier","ylang ylang", "vanille", "girofle", "sultan"
    ],
        n = rand(0, words.length), //génération d'un nbr aléatoire
        find = words[n], //le mot à trouver
        wordChars = find.split(""), //mise en tableau de chaque lettre du mot
        wordCharsNbr = wordChars.length, //longueur du mot
        score = 10, //score de départ
        gameover = false, //status de la partie
        imgSlide = $('[data-slide="image"] li'), //container d'images
        charToFind = $('[data-number="n-left"]'),
        charLeft = wordCharsNbr;


    function change(o, n) {

        $('[data-img="' + parseInt(o) + '"]').css("display", "none");
        imgSlide.append('<img src="img/' + parseInt(n) + '.png" alt="pendu" data-img="' + parseInt(n) + '">').show('fast', function() {

            $('[data-char="char-number"]').text('' + score + ' chances restantes.');
        });
    }

    if (gameover) {

        location.reload();
    }

    //Affichage des données du jeu
    $('[data-char="char-number"]').text("mot de " + wordCharsNbr + " lettres");
    imgSlide.append('<img src="img/0.png" alt="pendu" data-img="0">');
    charToFind.text('Il reste ' + charLeft + ' lettres à trouver');

    for (i = 0; i < wordChars.length; i++) {
        $("#find-word").append('<li><p>' + wordChars[i] + '</p></li>');
    }

    //cache les élements li
    $('.find li p').hide();

    $('#alphabet input').on('click', function(e) {

        //recup la valeur de l'input selectionné
        var alphaSelect = $(this).val();
        //recup l'input selectionné
        var alphaInput = $(this);
        //recup le mot à verifier
        var wordCheck = $('.find li').text();

        //fonctions qui vérifie que la lettre se trouve bien dans le mot
        function verify(char, word) {

            var arrayChar = word.toUpperCase().split(""),
                g = 0, //assume que l'user n'est trouvé aucun caractères
                v = 0,
                n = 0;


            for (x = 0; x < arrayChar.length; x++) {

                if (char.toUpperCase() == arrayChar[x]) {

                    // alphaInput.hide("slow");
                    alphaInput.addClass("disabled").attr("disable", "true");
                

                    n += $(".find li:nth-child(" + (x + 1) + ") p").length;

                    $(".find li:nth-child(" + (x + 1) + ") p").show();

                    g = 1; //si au moins un caractère est trouvé alors v est = à 1
                }
                
                alphaInput.addClass("disabled").attr("disable", "true");

            } //end boucle for

            charLeft -= n;

            charToFind.text('Il reste ' + charLeft + ' lettres à trouver');

            //ainsi si g égale 0 désincrémente le score
            if (g === 0) {
                $('#wrong-char').show().fadeOut(1800);
                score--;
            }

        } //end function

        //lance la vérification
        verify(alphaSelect, wordCheck);

        //modifie l'image selon le score
        switch (score) {

            case 9: //charge l'image 1
                change(0, 1);
                break;

            case 8:
                change(1, 2);
                break;

            case 7:
                change(2, 3);
                break;

            case 6:
                change(3, 4);
                break;

            case 5:
                change(4, 5);
                break;

            case 4:
                change(5, 6);
                break;

            case 3:
                change(6, 7);
                break;

            case 2:
                change(7, 8);
                break;

            case 1:
                change(8, 9);
                $('#chance-text').text('Il vous reste 1 dernière essaie');
                break;

            case 0:
                change(9, 10);

                gameover = true;

                $('#alphabet').remove();

                break;

        } //end switch

        if (charLeft === 0) {

            $('#alphabet').remove();

            gameConfirm("Félicitation! vous avez réussis. Voulez-vous recommencer?");
            exp = gagnerDesPoints("../..", 10);
            $('[data-confirm="cancel"]').on('click', function() {
                redirecTo();
            });

            $('[data-confirm="confirm"]').on('click', function() {
                location.reload();
            });
        }

        if (gameover) {

            gameConfirm('<strong>gameover!</strong> C\'est dommage, la partie est terminée. Le mot a trouver était <span id="find-word">' + find + '</span>. <br> Voulez-vous recommencer?');

            $('[data-confirm="cancel"]').on('click', function() {
                redirecTo();
            });

            $('[data-confirm="confirm"]').on('click', function() {
                location.reload();
            });
        }
    });

});