
//on preaffiche l'accueil
affiche("accueil");
// load("reclamation", "#reclamation_container");
// load("compte_reclamation", "#compte_reclamation");

function load2(categorie, destination) {
    var xhr = new XMLHttpRequest()
    xhr.open("POST", "action.php")
    var formulaire = new FormData();
    formulaire.append("action", "affiche_" + categorie);
    xhr.send(formulaire);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // alert(xhr.responseText);
            document.querySelector("#" + categorie + " table tbody").innerHTML = xhr.responseText;
        }
    }
}

function load(categorie, destination) {
    $(document).ready(function () {
        $(destination).load("action.php", {
            action: 'affiche_' + categorie
        }, function (data) {
            console.log(data);
        });
    });
}

function loadAvecParams(params, destination, loading) {
    if (typeof (loading) == "undefined")
        loading = 1;

    $(document).ready(function () {
        if (loading)
            $(destination).html("<div class='loader-container'><img alt='chargement...' src='../assets/img/loader.gif'/><p>Veuillez patientez...</p></div>");

        $(destination).load("action.php", params);
        var pos = $(destination).offset().top;
        $("body, html").animate({
            ScrollTop: pos
        }, 1000);
    });
}

function updateAvecParams(params, destination, fonction) {
    $(document).ready(function () {
        $(destination).html("<span class='loader-container'><img alt='chargement...' src='../assets/img/loader.gif'/></span>");
        if (typeof (fonction) == "undefined") {
            fonction = function () {
                console.log("pas de callback");
            }
        }
        $(destination).load("action.php", params, fonction);
        var pos = $(destination).offset().top;
        $("body, html").animate({
            ScrollTop: pos
        }, 1000);
    });
}

function updatePhoto(element, action, id, callbackFunction) {

    var progress = element.parentNode.parentNode.parentNode.querySelector(".progress");
    $(function () {

        $(progress).fadeIn("slow");
    });
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "action.php");
    var form = new FormData();
    form.append("action", action);
    form.append("id", id);
    form.append("photo", element.files[0]);

    xhr.upload.onprogress = function (e) {
        var pourcentage = e.loaded * 100 / e.total;
        $(function () {
            $(".progress-bar").css("width", pourcentage + "%");
        })
    };

    xhr.onload = function () {
        $(function () {

            $(progress).fadeOut("slow");
        });
    }
    xhr.send(form);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            element.parentNode.parentNode.parentNode.parentNode.querySelector("img").src = xhr.responseText;

            if (typeof (callbackFunction) != "undefined")
                callbackFunction();
        }
    }
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
        if (categorie != "accueil")
            load2(categorie, "#" + categorie + " table tbody");
        else {
            loadAvecParams({
                action: 'bilanMois',
                mois: (new Date()).getMonth()
            }, '#bilan');
        }
    })

}

function loadAvecForm(element, callback) {
    if (!element.form.valid)
        return false;
    var xhr = new XMLHttpRequest();
    xhr.open("post", "action.php");
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
    xhr.open("post", "action.php");

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
    xhr.open("post", "action.php");
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
    xhr.open("post", "action.php");
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
    console.log("retour : " + retour + " ...");
    return retour;
}

function animation(elephant, timer) {
    if (typeof (timer) == "undefined")
        var timer = 50;
    if (typeof (elephant) == "undefined")
        var elephant = document.querySelector("#animation");

    elephant.style.position = "absolute";
    elephant.style.left = "100%";
    elephant.style.top = "85%";
    elephant.style.display = "block";

    var p = 100;

    function aller() {
        if (p > -50) {
            p -= 1;
            elephant.style.left = p + "%";
            setTimeout(aller, timer);
        } else {
            elephant.style.display = "none";
        }
    }
    aller();
    setTimeout(function () {
        animation(elephant, timer)
    }, 100000);
}

function avancer(elephant, timer) {
    if (typeof (timer) == "undefined")
        var timer = 30;
    if (typeof (elephant) == "undefined")
        var elephant = document.querySelector("#animation");

    elephant.style.position = "absolute";
    elephant.style.left = "100%";
    // elephant.style.top = "85%";
    elephant.style.display = "block";

    var p = 100;

    function aller() {
        if (p > -80) {
            p -= 50;
            elephant.style.left = p + "%";
            setTimeout(aller, timer);
        } else {
            elephant.style.display = "none";
        }
    }
    aller();
    setTimeout(function () {
        avancer(elephant, timer)
    }, 100000);
}