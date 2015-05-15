<?php
/**
 * Created by PhpStorm.
 * User: aich
 * Date: 2015-05-12
 * Time: 23:37
 */

class Controler__Edytuj extends Controler__Controler {

    public function __construct($katalog, $parametr) {

        $this->parametr = (int)$parametr;
        $this->katalog = $katalog;
        parent::__construct();

    }

    public function wykonaj() {

        if(empty($this->tablica_session['id'])) {
            header('Location: /blad');
        }

        if(isset($this->tablica_post['imie'])) {
            $this->edytujKontakt();
        }

        $kontakt = new Model__Kontakt();
        $kontakt->find(array('id' => $this->parametr));

        if($kontakt->getId() == null || $kontakt->getIdUser() != (int)$this->tablica_session['id']) {
            header('Location: /blad');
        }


        $this->smarty->assign('kontakt', $kontakt);

        $this->generujStrone();
    }

    private function edytujKontakt() {

        $imie = addslashes($this->tablica_post['imie']);
        $nazwisko = addslashes($this->tablica_post['nazwisko']);
        $email = addslashes($this->tablica_post['email']);
        $telefon = addslashes($this->tablica_post['nr_tel']);
        $data = addslashes($this->tablica_post['data']);

        $kontakt = new Model__Kontakt();
        $kontakt->setId($this->parametr);
        $kontakt->setImie($imie);
        $kontakt->setNazwisko($nazwisko);
        $kontakt->setEmail($email);
        $kontakt->setTelefon($telefon);
        $kontakt->setDataUrodzenia($data);
        $kontakt->setIdUser($this->tablica_session['id']);

        $kontakt->update();
    }

}