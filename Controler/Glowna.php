<?php

/**
 * Description of Glowna
 *
 * Kontroler odpowiedzialny za działanie strony głównej systemu
 */
class Controler__Glowna extends Controler__Controler {
    
    
    public function __construct($katalog) {  
        
        $this->katalog = $katalog;
        $this->sciezka_css = "style.css";
        parent::__construct(); 
    }
    
    public function wykonaj() {

        if(isset($this->tablica_post['usun'])) {
            $this->usunKontakt();
        }
        
        $this->pobierzKontakty();

        $this->generujStrone();
    }

    private function pobierzKontakty() {


        $tablica_kontaktow = array();
        $user = new Model__User();

        if(isset($this->tablica_session['zalogowany']) && $this->tablica_session['zalogowany'] == true) {
            $user->setId($this->tablica_session['id']);
            $tablica_kontaktow = $user->getKontakty();
        } else {
            $tablica_kontaktow = $user->getKontakty(true);
        }

        $this->smarty->assign('kontakty', $tablica_kontaktow);
    }

    private function usunKontakt() {
        $id = (int)$this->tablica_post['usun'];

        $kontakt = new Model__Kontakt();
        $kontakt->find(array('id' => $id));

        if($kontakt->getId() != null && $kontakt->getIdUser() == $this->tablica_session['id']) {
            $kontakt->delete();
        }
    }
}
