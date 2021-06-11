function verifTelephone(champ)
{
    /* var regex = /^\+?[0-9]{2})\?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;*/
    var regex = /^\+[0-9]?()[0-9](\s|\S)(\d[0-9]{8,10})$/;
    if(!regex.test(champ.value) && champ.value.length>0)
    {
        champ.style.border = "1px solid red";
        return true;
    }
    else
    {
        champ.style.border = "";
        return false;
    }
}

function verifImmatricule(champ)
{
    /*var regex = /^[A-Z]?(2)[0-9](\s|\S)(\d[0-9]{8,10})$/;
    /!*var regex = /^[A-Z]{2}' '[0-9]{4}' '[A-Z]{2}/;*!/
    if(!regex.test(champ.value) && champ.value.length>0)
    {
        champ.style.border = "1px solid red";
        return true;
    }
    else
    {
        champ.style.border = "";
        return false;
    }*/
}

function verifMail(champ)
{
    var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
    if(!regex.test(champ.value) && champ.value.length>0)
    {
        champ.style.border = "1px solid red";
        return true;
    }
    else
    {
        champ.style.border = "";
        return false;
    }
}

function surligne(champ, erreur)
{
    if(erreur)
        /*champ.style.backgroundColor = "#ff0a13";*/
        champ.style.border= "1px solid red";
    else
        champ.style.border = "";
}

function verifLibelle(champ)
{
    if(champ.value.length < 2 || champ.value.length > 25)
    {
        surligne(champ, true);
        return false;
    }
    else
    {
        surligne(champ, false);
        return true;
    }
}

function verifAge(champ)
{
    var age = parseInt(champ.value);
    if(isNaN(age) || age < 5 || age > 111)
    {
        surligne(champ, true);
        return false;
    }
    else
    {
        surligne(champ, false);
        return true;
    }

}

function surligneAvecMessage(champ, erreur,message) {
    if (erreur) {
        /*champ.style.backgroundColor = "#ff0a13";*/
        champ.style.border = "1px solid red";
        champ.focus();
        $("body").overhang({
            type: "warn",
            message: message
        });
        setTimeout(function(){
            champ.style.border = "";
        }, 7000 ); // 5 secs
    }
    else
    {
        champ.style.border = "";
    }

}