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
    
    public function __construct($host) {  
        parent::__construct();
        
        
        
    }
    
    public function wykonaj() {
        
        $this->pobierzTematy();
        $this->smarty->display('glowny.tpl');
    }
    
    private function pobierzTematy() {
        $portal = new Model__Portal();
        $portal->getPortal();
        
        
        $tematy = $portal->getTopics(array('status' => 'aktywny'));
        $this->smarty->assign('tematy', $tematy);
        
    }
}
