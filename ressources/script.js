//Section Phone number
function resetPhoneMsg(){
    var errorSpan = document.getElementById("divTelephone");
    errorSpan.innerHTML = ("");
}

function verifyPhone(){
    resetPhoneMsg();
    var element = document.getElementById("Telephone");
    var errorSpan = document.getElementById("divTelephone");
    var regex = /^0[0-9]{9}$/;
    if(!regex.test(element.value)){
        errorSpan.innerHTML = ("Le numéro de téléphone est un nombre sur 10 chiffres commançant par un 0.");
        return false;
    } else {
        return true;
    }
}

//Section Password 1
function resetPassword1Msg(){
    var errorSpan = document.getElementById("divPassword1");
    errorSpan.innerHTML = ("");
}

function verifyPassword1(){
    resetPassword1Msg();
    var element = document.getElementById("password1");
    var errorSpan = document.getElementById("divPassword1");
    var regexMin = /^.*[a-z].*$/;
    var regexMaj = /^.*[A-Z].*$/;
    var regexNum = /^.*[0-9].*$/;
    var regexSpe = /^.*[.,?;:/!()*$€%+].*$/;
    if(!regexMin.test(element.value) || !regexMaj.test(element.value) 
    || !regexNum.test(element.value) || !regexSpe.test(element.value)
    || element.value.length < 8){
        errorSpan.innerHTML = ("Le mot de passe doit contenir 8 caractère dont une majuscule, une minuscule, un chiffre et un caractère spécial de la liste suivant : <b>.,?;:/!()*$€%+</b> .");
        return false;
    } else {
        return true;
    }
}

//Section Password 2
function resetPassword2Msg(){
    var errorSpan = document.getElementById("divPassword2");
    errorSpan.innerHTML = ("");
}

function verifyPassword2(){
    resetPassword2Msg();
    var element1 = document.getElementById("password1");
    var element2 = document.getElementById("password2");
    var errorSpan = document.getElementById("divPassword2");
    if(element1.value != element2.value){
        errorSpan.innerHTML = ("Confirmation impossible saisissez le meme mot de passe.");
        return false;
    } else {
        return true;
    }
}

//Section verification CGU
function resetCGUMs(){
    var errorSpan = document.getElementById("divCGU");
    errorSpan.innerHTML = ("");
}

function verifyPassword2(){
    resetCGUMs();
    var element = document.getElementById("CGU");
    var errorSpan = document.getElementById("divCGU");
    if(!element.checked){
        errorSpan.innerHTML = ("Veiller accepter les CGU.");
        return false;
    } else {
        return true;
    }
}

//validation du formulaire
function verifyForm(){
    var result = true;
    result = verifyPhone() && result;
    result = verifyPassword1() && result;
    result = verifyPassword2() && result;
    result = verifyPassword2 && result;
    
    return result;
}