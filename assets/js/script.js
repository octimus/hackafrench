function loa(formulaire, chemin) {
    if(typeof(chemin)=="undefined")
        chemin=".";

    if(typeof(reponse)=="undefined")
        reponse = formulaire.querySelector(".reponse");

    $(function() {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", chemin+"/action.php");
        var formu = new FormData(formulaire);
        xhr.send(formu);
        xhr.onreadystatechange = function() {
            if (xhr.status == 200 && xhr.readyState == 4) {
                $(reponse).html(xhr.responseText);

            if(xhr.responseText=="success")
            {
                window.location.reload();
            }
                // if (callback)
                //     callback();
                // alert(xhr.responseText);
            }
        }
    });
}

function lire(text)
{
    if ('speechSynthesis' in window) 
    {
        responsiveVoice.speak(text, "French Female");            
    }
    else
    {
        alert("Votre navigateur ne supporte pas text-to-speech");
    }
}

toggleDico = null;
function traduire (btn)
{
    var xhr = new XMLHttpRequest();
    xhr.open("post", "action.php");
    var formulaire = new FormData(btn.form);
    xhr.send(formulaire);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.querySelector(".dictionnaire .reponse").innerHTML = xhr.responseText;
        }
    }
}
$(function(){
    toggleDico=function(){
        $(".dictionnaire form").toggle();
    }
    toggleDico()
})

function displayExp()
{
    // alert(exp);
    document.querySelector("#progression-bar #progression").style.width = exp + "%";
}

// if(typeof(exp)!="undefined")
//     displayExp();