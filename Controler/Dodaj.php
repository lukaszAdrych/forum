<?php
/**
 * Created by PhpStorm.
 * User: aich
 * Date: 2015-05-12
 * Time: 23:36
 */

class Controler__Dodaj extends Controler__Controler {

    public function __construct($katalog) {

        $this->katalog = $katalog;
        $this->sciezka_css = "style.css";
        parent::__construct();
    }

    public function wykonaj() {

        if(empty($this->tablica_session['id'])) {
            header('Location: /blad');
        }

        $this->smarty->assign('dodano', false);

        if(isset($this->tablica_post['imie'])) {
            $this->dodajKontakt();
        }

        $this->generujStrone();
    }

    private function dodajKontakt() {
        $imie = addslashes($this->tablica_post['imie']);
        $nazwisko = addslashes($this->tablica_post['nazwisko']);
        $email = addslashes($this->tablica_post['email']);
        $telefon = addslashes($this->tablica_post['nr_tel']);
        $data = addslashes($this->tablica_post['data']);

        $kontakt = new Model__Kontakt();
        $kontakt->setImie($imie);
        $kontakt->setNazwisko($nazwisko);
        $kontakt->setEmail($email);
        $kontakt->setTelefon($telefon);
        $kontakt->setDataUrodzenia($data);
        $kontakt->setIdUser($this->tablica_session['id']);
        
        $kontakt->save();

        $this->smarty->assign('dodano', true);
    }
}