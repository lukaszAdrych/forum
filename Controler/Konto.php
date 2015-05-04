<?php

/**
 * Description of Konto
 *
 * Kontroler odpowiedzialny za wyświetlanie danych o koncie
 */
class Controler__Konto extends Controler__Controler {
    
    /**
     *Parametr przekazany w URL, identyfikujący konto
     * @var type string
     */
    private $parametr;
    
    /**
     * Posty konkretnego użytkownika do wyświetlenia
     * @var type array
     */
    public $posty = array();

    public function __construct($katalog, $parametr) {  
        
        $this->parametr = (int)$parametr;
        $this->katalog = $katalog;
        parent::__construct(); 
        
    }
    
    public function wykonaj() {
        
        
        
        if(isset($this->tablica_post['stare_haslo'])) {
            $this->zmienHasloDoKonta();
        }
        
        if(isset($this->parametr)) {
            $id_parametr = $this->parametr;
            $this->pobierzPosty();
        } else {
            $id_parametr = "";
        }
        
        $ilosc_postow = count($this->posty);
        
        $this->smarty->assign('ilosc_postow', $ilosc_postow);
        $this->smarty->assign('posty', $this->posty);
        $this->smarty->assign('id_parametr', $id_parametr);
        $this->generujStrone();
    }
    
    /**
     * Zmienia hasło do konta, jeżeli użytkownik wykonał taką czynność
     */
    private function zmienHasloDoKonta() {
        $user = new Model__User();
        
        $id = $this->parametr;
        $hash_stare = "'" . addslashes(md5($this->tablica_post['stare_haslo'])) . "'";
        
        $user->find(array('id=' => $id, 'hash_haslo=' => $hash_stare));
        
        if($user->getId() != null && addslashes($this->tablica_post['nowe_haslo1']) == addslashes($this->tablica_post['nowe_haslo2'])) {
            $user->setHash_haslo(md5($this->tablica_post['nowe_haslo1']));
            $user->update();
        }
    }
    
    /**
     * Pobiera posty użytkownika
     */
    private function pobierzPosty() {
        $user = new Model__User();
        
        $user->find(array('id= ' => $this->parametr));
        
        $this->posty = $user->getPosts();
    }
}
