<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Route
 *
 * @author aich
 */
class Route {
    
    private $katalog;
    
    private $parametr;
    


    public function __construct($uri) {
        $tab = explode('/', $uri);
        
        $this->katalog = $tab[1];
        if(isset($tab[2])) {
            $this->parametr = $tab[2];
        }
        
    }
    
    public function uruchomController() {
        
        switch ($this->katalog) {
            case "":
                $controler = new Controler__Glowna($this->katalog);
                $controler->wykonaj();
                
                break;
            case "rejestracja":
                $controler = new Controler__Rejestracja($this->katalog);
                $controler->wykonaj();
                
                break;
            case "temat":
                
                $controler = new Controler__Topic($this->katalog, $this->parametr);
                $controler->wykonaj();
                
                break;
            case "konto":
                
                $controler = new Controler__Konto($this->katalog);
                $controler->wykonaj();
                
                break;
            case "aktywacja":
                
                break;
            
            default :
                
                break;
            
        }
    }
}
