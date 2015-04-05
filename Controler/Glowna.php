<?php


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of Glowna
 *
 * @author aich
 */
class Controler__Glowna extends Controler__Controler {
    //put your code here
    
    public function __construct($katalog) {  
        
        $this->katalog = $katalog;
        $this->sciezka_css = "style.css";
        parent::__construct(); 
    }
    
    public function wykonaj() {
        
        if(isset($this->tablica_post['nazwa_tematu'])) {
            $this->dodajNowyTemat($this->tablica_post['nazwa_tematu']);
        }
        
        $this->pobierzTematy();      
        $this->generujStrone();
    }
    
    private function pobierzTematy() {
        $portal = new Model__Portal();
        $portal->getPortal();
        
        
        $tematy = $portal->getTopics(array('status' => 'aktywny'));
        $this->smarty->assign('tematy', $tematy);
        
    }
    
    private function dodajNowyTemat($nazwa_tematu) {
        
        $nowy_temat = new Model__Topic();
        $nowy_temat->setNazwa($nazwa_tematu);
        $nowy_temat->setId_user(1);
        $nowy_temat->setStatus('aktywny');
        $nowy_temat->save();
    }
}
