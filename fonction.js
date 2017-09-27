function displayExp()
{
    if(typeof(exp)=="undefined")
        return false;
    // alert(exp);
    document.querySelector("#progression-bar #progression").style.width = 1 + "%";
    // document.querySelector("#progression-bar #progression").style.width = (exp/1000)*100 + "%";
}
// displayExp();

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

function gagnerDesPoints(chemin, gain)
{
    if(typeof(chemin)=="undefined")
        chemin=".";

    var xhr = new XMLHttpRequest();
    xhr.open("POST", chemin+"/action.php");

    var formu = new FormData();
    formu.append("action", "pointer");
    formu.append("gain", gain);

    xhr.send(formu);
    xhr.onreadystatechange = function() {
        if (xhr.status == 200 && xhr.readyState == 4) {
            return xhr.responseText;
        }
    }
}

(function ()
{
    if(typeof(exp)=="undefined")
        return false;
    var rond = document.createElement("div");
    rond.className = "exp";
    rond.style.position = "fixed";
    rond.style.top = "70px";
    rond.style.left = "5px";
    rond.style.padding = "10px";
    rond.style.borderRadius = "12px";
    rond.style.fontWeight = "bolder";
    rond.style.fontSize = "0.8em";
    rond.style.background = "rgba(32, 211, 70, 0.39)";

    rond.innerHTML = "Exp : "+exp;
    document.querySelector("body").appendChild(rond);
})()
