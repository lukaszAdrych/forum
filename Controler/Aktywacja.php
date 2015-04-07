<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Aktywacja
 *
 * @author aich
 */
class Controler__Aktywacja extends Controler__Controler {
    public function __construct($katalog) {  
        
        $this->katalog = $katalog;
        parent::__construct();
    }
    
    public function wykonaj() {
        
        if($this->tablica_get['aktywacja'] == 'tak') {
            $this->aktywujKonto($this->tablica_get['kod']);
        }
        
        $this->generujStrone();
    }
    
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
