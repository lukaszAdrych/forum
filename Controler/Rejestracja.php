<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rejestracja
 *
 * @author aich
 */
class Controler__Rejestracja extends Controler__Controler {
    
    public $blad_rejestracja;


    public function __construct($katalog) {  
        
        $this->katalog = $katalog;
        parent::__construct();
    }
    
    public function wykonaj() {
        
        if(isset($this->tablica_post['nickRej'])) {
            $this->rejestracja();
            
        } else {
            $this->blad_rejestracja = false;
        }
        
        $this->smarty->assign('czy_blad_rej', $this->blad_rejestracja);
        $this->generujStrone();
    }
    
    private function rejestracja() {
        $user = new Model__User();
        $nick = "'" . $this->tablica_post['nickRej'] . "'";
        $email = "'" . $this->tablica_post['email'] . "'";
        
        $user->find(array('nick=' => $nick));
        $id_user = $user->getId();
        
        $user->find(array('email=' => $email));
        
        
        if($id_user == null && $user->getId() == null && $this->tablica_post['haslo1'] == $this->tablica_post['haslo2']) {
        
            $kod_aktywacja = uniqid();
        
            $user->setNick($this->tablica_post['nickRej']);
            $user->setEmail($this->tablica_post['email']);
            $user->setHash_haslo(md5($this->tablica_post['haslo1']));
            $user->setKod_aktywacja($kod_aktywacja);
            $user->setStatus("nowy");
        
            $user->save();
            $this->blad_rejestracja = false;
            
            $portal = new Model__Portal();
            $portal->getPortal();
            $portal->dodajUzytkownika();
            $portal->update();
        
            $this->wyslijEmailAktywacyjny($user->getEmail(), $kod_aktywacja);
        } else {
            $this->blad_rejestracja = true;
        }
    }
    
    private function wyslijEmailAktywacyjny($mail, $kod) {
        $teamt = "Aktywacja konta na forum";
        
        $link = $_SERVER['HTTP_HOST'] . "/aktywacja/?aktywacja=tak&kod=$kod";
        
        $tresc = "  Witaj, adres ten został podany podczas rejestracji w serwisie forum...
        Aby dokończyć proces aktywacji konta kliknij w poniższy link:
        $link
        Jeżeli nie rejestrowałeś się w serwisie forum, zignoruj tą ziadomość    
        ";
        
        mail($mail, $teamt, $tresc);
    }
    
   
}
