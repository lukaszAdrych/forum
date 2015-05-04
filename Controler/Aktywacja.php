<?php


/**
 * Description of Aktywacja
 *
 *  Kontroler Aktywacja, jest uruchamiany w momencie aktywacji konta użytkownika
 */
class Controler__Aktywacja extends Controler__Controler {
    public function __construct($katalog) {  
        
        $this->katalog = $katalog;
        parent::__construct();
    }
    
    public function wykonaj() {
        
        if($this->tablica_get['aktywacja'] == 'tak') {
            $this->aktywujKonto(addslashes($this->tablica_get['kod']));
        }
        
        $this->generujStrone();
    }
    
    /**
     * 
     * @param string $kod - kod akttwacyjny
     */
    
    private function aktywujKonto($kod) {
        $kod = "'" . $kod . "'";
        $user = new Model__User();
        $user->find(array('kod_aktywacja=' => $kod, 'status=' => "'nowy'"));
        
        if($user->getId() != null) {
            $user->setStatus('czytelnik');
            $user->update();
            
            $rezultat = true;
        } else {
            $rezultat = false;
        }
        
        $this->smarty->assign('rezultat', $rezultat);
    }
}
