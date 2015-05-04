<?php

/**
 * Description of Blad
 *
 * Kontroler jest uruchamiany jeżeli wystąpi jakiś błąd w systemie
 */
class Controler__Blad extends Controler__Controler {
    
    public function __construct($katalog) {  
        
        $this->katalog = $katalog;
        parent::__construct();
    }
    
    public function wykonaj() {
        $this->generujStrone();
    }
}
