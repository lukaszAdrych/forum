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
    
    private $host;


    public function __construct($uri, $host) {
        $tab = explode('/', $uri);
        
        $this->katalog = $tab[0];
        if(isset($tab[1])) {
            $this->parametr = $tab[1];
        }
        
        $this->host = $host;
    }
    
    public function uruchomController() {
        
        switch ($this->katalog) {
            case "":
                $controler = new Controler__Glowna($this->host);
                $controler->wykonaj();
                
                break;
            case "rejestracja":
                
                break;
            case "temat":
                
                break;
            case "konto":
                
                break;
            case "blad":
                
                break;
            
            default :
                
                break;
            
        }
    }
}
