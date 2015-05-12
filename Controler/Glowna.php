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
        

        

        $this->generujStrone();
    }
    

    

    


}
