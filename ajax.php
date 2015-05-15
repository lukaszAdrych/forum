<?php
require 'konfig/baza.php';
require 'autoload.php';

$id = $_REQUEST["id"];
$czy_zalogowany = $_REQUEST['zalogowany'];

if($czy_zalogowany != "tak") {
    $edycja = false;
} else {
    $edycja = true;
}

$kontakt = new Model__Kontakt();
$kontakt->find(array('id' => $id));


echo $id === "" ? "brak id" : $kontakt->getUserHtml($edycja);
?>