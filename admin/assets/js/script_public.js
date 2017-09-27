//on preaffiche l'accueil
affiche("accueil");
$("#departement_select").load("action_public.php", {
    action: "affiche_departement_select"
})

function go(destination) {
    $(document).ready(function () {
        var pos = $(destination).offset().top;
        $("body, html").animate({
            scrollTop: pos
        }, 1000);
    });
}

function load(categorie, destination) {
    $(document).ready(function () {
        $(destination).load("../action.php", {
            action: 'affiche_' + categorie
        });
    });
}

function loadAvecParams(params, destination) {
    $(document).ready(function () {
        $(destination).html("<div class='loader-container'><img alt='chargement...' src='assets/img/loader.gif'/><p>Veuillez patientez...</p></div>");
        $(destination).load("action_public.php", params);
        var pos = $(destination).offset().top;
        $('body, html').animate({
            scrollTop: pos
        }, 1000);
    });
}

function affiche(categorie, element) {
    $(document).ready(function () {
        $("#contenu .content").hide("slow");
        if (typeof (element) != "undefined") {
            var elementP = element.querySelector("p");
            $("li").removeClass("active");
            $(element.parentNode).addClass("active");
            $("#page_title").html($(elementP).html());
        }
        $("#" + categorie + ", #" + categorie + " .content").show("slow");
        load(categorie, "#" + categorie + " table tbody");
    })
}

function loadAvecForm(element, callback) {
    if (!element.form.valid)
        return false;
    var xhr = new XMLHttpRequest();
    xhr.open("post", "../action.php");
    var formulaire = new FormData(element.form);

    xhr.send(formulaire);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            if (typeof (callback) != "undefined")
                callback();
        }
    }
}

function loadJSON() {

    var xhr = new XMLHttpRequest();
    xhr.open("post", "../action.php");

    var formulaire = new FormData();
    formulaire.append("action", "affichage_note_pour_cent");

    xhr.send(formulaire);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            return JSON.parse(xhr.responseText);
        }
    }
}

function inserer(element, callback, reload) {
    if (typeof (reload) == "undefined")
        reload = true;
    if (!form_valide(element.form))
        return false;

    var xhr = new XMLHttpRequest();
    xhr.open("post", "action_public.php");
    var formulaire = new FormData(element.form);
    xhr.send(formulaire);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            if (typeof (callback) != "undefined")
                callback();

            if (xhr.responseText == "ok") {

                if (reload)
                    element.form.reset();

                $(function () {
                    $.notify({
                        icon: 'pe-7s-smile',
                        message: "<h4>Succes !</h4>l'insertion a bien été effectuée !"

                    }, {
                        type: 'success',
                        timer: 4000
                    });
                })
            } else {
                $(function () {
                    $.notify({
                        icon: 'pe-7s-attention',
                        message: "<h4>Erreur</h4>" + xhr.responseText

                    }, {
                        type: 'danger',
                        timer: 4000
                    });
                })
            }
        }
    }
    return false;
}

function supprimer(action, id, callback) {
    if (!confirm("Vous etes sure de vouloir supprimer"))
        return false;
    var xhr = new XMLHttpRequest();
    xhr.open("post", "../action.php");
    var formulaire = new FormData();
    formulaire.append("action", action);

    if (typeof (id) != "undefined")
        formulaire.append("id", id);

    xhr.send(formulaire);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            callback();
        }
    }
}

function form_valide(form) {
    var retour = true;
    $(function () {
        var champs = form.querySelectorAll("input, textarea, select");
        //parcours de tous les champs
        for (var i = 0; i < champs.length; i++) {
            var helpBlock = champs[i].parentNode.querySelector(".help-block");
            $(champs[i].parentNode).addClass("has-error");

            if (champs[i].value == "" && champs[i].required == true) {
                helpBlock.innerHTML = "Ce champ est obligatoire";
                retour = false;
            } else if (champs[i].type == "tel" && !testTel(champs[i])) {
                helpBlock.innerHTML = "Veuillez saisir un numero de telephone correcte";
                retour = false;
            } else if (champs[i].type == "email" && !testEmail(champs[i])) {
                helpBlock.innerHTML = "Veuillez saisir une addresse email correcte";
                retour = false;
            } else {
                $(champs[i].parentNode).removeClass("has-error");
                helpBlock.innerHTML = "";
            }
        }


        //fonction pour le test du numero de telephone
        function testTel(champ) {
            var telRegex = /^3[2-9][0-9]{5}$/i;
            if (!telRegex.test(champ.value) && champ.value != "")
                return false;
            else
                return true;
        }
        //fonction pour le test de l'email
        function testEmail(champ) {
            var emailRegex = /^.{3,}@[a-z]{3,}\.[a-z]{2,}$/i;
            if (!emailRegex.test(champ.value) && champ.value != "")
                return false;
            else
                return true;
        }

    })
    return retour;
}