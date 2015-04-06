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
        
        if(isset($this->tablica_post['nick'])) {
            $this->rejestracja();
        }
        
        $this->generujStrone();
    }
    
    private function rejestracja() {
        $user = new Model__User();
        
        $user->setNick($this->tablica_post['nick']);
        $user->setEmail($this->tablica_post['email']);
        $user->setHash_haslo(md5($this->tablica_post['haslo1']));
        $user->setKod_aktywacja("dfddsfsdf");
        $user->setStatus("nowy");
        
        $user->save();
        
        
        //dopisac wysywanie emaila z aktywacja itp.
    }
    
   
}
