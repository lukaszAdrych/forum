
function pobierzKontakt() {
    var id = this.getAttribute('id');
    if(document.getElementById("wyloguj")) {
        var obj = document.getElementById("wyloguj");
        } else {
        var obj = "";
    }
    if (id == 0) {
        document.getElementById("luk").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("luk").innerHTML = xmlhttp.responseText;
            }
        }

        xmlhttp.open("GET", "ajax.php?id=" + id + "&zalogowany=" + obj.value, true);
        xmlhttp.send();
    }
}



var elementy = document.getElementsByClassName('kontakt');
var tablica_elementow = Array.prototype.slice.call(elementy);



for(var i = 0; i < tablica_elementow.length; i++) {
    tablica_elementow[i].addEventListener('click', pobierzKontakt, false);
}