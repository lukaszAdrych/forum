

function sprawdzImie() {
    var wzorImie = /^[a-zA-ZŁŚ]{2,}$/;
    var element = document.getElementById('imie');

    if(this.value.match(wzorImie)) {
        document.getElementById("imie1").innerHTML = "Imię ok";
        document.getElementById("imie1").className = "poprawne";
    } else {
        document.getElementById("imie1").innerHTML = "Imię za krótkie";
        document.getElementById("imie1").className = "niepoprawne";
    }
}

function sprawdzNazwisko() {
    var wzorNazwisko = /^[A-ZŁŻa-ząęóżźćńłś]{2,}$/;
    if(this.value.match(wzorNazwisko)) {
        document.getElementById("nazwisko1").innerHTML = "Nazwisko ok";
        document.getElementById("nazwisko1").className = "poprawne";
    } else {
        document.getElementById("nazwisko1").innerHTML = "Nazwisko za krótkie";
        document.getElementById("nazwisko1").className = "niepoprawne";
    }
}

function sprawdzEmail() {

    var email = this.value;
    var tab = location.href.split('/');
    var id = tab[tab.length - 1];

    if (email.length == 0) {
        document.getElementById("email1").innerHTML = "Email niepoprawny";
        document.getElementById("email1").className = "niepoprawne";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("email1").innerHTML = xmlhttp.responseText;
                if(xmlhttp.responseText == "true") {
                    document.getElementById("email1").innerHTML = "Email ok";
                    document.getElementById("email1").className = "poprawne";
                } else if(xmlhttp.responseText == "false") {
                    document.getElementById("email1").innerHTML = "Email niepoprawny";
                    document.getElementById("email1").className = "niepoprawne";
                } else {
                    document.getElementById("email1").innerHTML = "Email jest zajęty";
                    document.getElementById("email1").className = "niepoprawne";
                }
            }
        }

        xmlhttp.open("GET", "..\/walidacjaEmail.php?email=" + email + "&id=" + id, true);
        xmlhttp.send();
    }

}

function sprawdzTelefon() {
    var wzorTelefon = /^[0-9]{3}-[0-9]{3}-[0-9]{3}$/;
    if(this.value.match(wzorTelefon)) {
        document.getElementById("nr_tel1").innerHTML = "Telefon ok";
        document.getElementById("nr_tel1").className = "poprawne";
    } else {
        document.getElementById("nr_tel1").innerHTML = "Źle, wzór: \"XXX-XXX-XXX\"";
        document.getElementById("nr_tel1").className = "niepoprawne";
    }
}

function sprawdzData() {
    var wzorData = /^[0-9]{4}-[0-9]{2}-[0-9]{2}$/;
    if(this.value.match(wzorData)) {
        document.getElementById("data1").innerHTML = "Data ok";
        document.getElementById("data1").className = "poprawne";
    } else {
        document.getElementById("data1").innerHTML = "Źle, wzór: \"YYYY-MM-DD\"";
        document.getElementById("data1").className = "niepoprawne";
    }
}

function sprawdzButton() {


    var spanImie = document.getElementById('imie1');
    var spanNazwisko = document.getElementById('nazwisko1');
    var spanEmail = document.getElementById('email1');
    var spanTelefon = document.getElementById('nr_tel1');
    var spanData = document.getElementById('data1');
    var pop = "poprawne";


    if(spanImie.getAttribute('class') == pop &&
        spanNazwisko.getAttribute('class') == pop &&
        spanEmail.getAttribute('class') == pop &&
        spanTelefon.getAttribute('class') == pop &&
        spanData.getAttribute('class') == pop) {


        if(document.getElementById("buttonDodaj")) {
            var dodaj = document.getElementById("buttonDodaj");
            dodaj.disabled = false;
        }
        if(document.getElementById("buttonEdytuj")) {
            var dodaj = document.getElementById("buttonEdytuj");
            dodaj.disabled = false;
        }
    }

}


var elementImie = document.getElementById('imie');
var elementNazwisko = document.getElementById('nazwisko');
var elementEmail = document.getElementById('email');
var elementTelefon = document.getElementById('nr_tel');
var elementData = document.getElementById('data');

elementImie.addEventListener('blur', sprawdzImie, false);
elementNazwisko.addEventListener('blur', sprawdzNazwisko, false);
elementEmail.addEventListener('blur', sprawdzEmail, false);
elementTelefon.addEventListener('blur', sprawdzTelefon, false);
elementData.addEventListener('blur', sprawdzData, false);


elementImie.addEventListener('blur', sprawdzButton, false);
elementNazwisko.addEventListener('blur', sprawdzButton, false);
elementEmail.addEventListener('blur', sprawdzButton, false);
elementTelefon.addEventListener('blur', sprawdzButton, false);
elementData.addEventListener('blur', sprawdzButton, false);


