<?php
require 'konfig/baza.php';
require 'autoload.php';

$email = addslashes($_GET['email']);
$id = (int)$_GET['id'];


if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $kontakt = new Model__Kontakt();
    $kontakt->find(array('email' => "'" .$email . "'"));

    if($kontakt->getId() == null || $kontakt->getId() == $id) {
        echo "true";
    } else {
        echo "false1";
    }
} else {
    echo "false";
}
