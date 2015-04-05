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
    
    public function __construct($katalog) {  
        
        $this->katalog = $katalog;
        parent::__construct();
    }
    
    
    public function wykonaj() {
        
        
        $this->smarty->display('rejestracja.tpl');
    }
}
