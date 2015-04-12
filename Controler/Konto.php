<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Konto
 *
 * @author aich
 */
class Controler__Konto extends Controler__Controler {
    
    private $parametr;
    
    public $posty = array();

    public function __construct($katalog, $parametr) {  
        
        $this->parametr = (int)$parametr;
        $this->katalog = $katalog;
        parent::__construct(); 
        
    }
    
    public function wykonaj() {
        
        
        
        if(isset($this->tablica_post['stare_haslo'])) {
            $this->zmienHasloDoKonta();
        }
        
        if(isset($this->parametr)) {
            $id_parametr = $this->parametr;
            $this->pobierzPosty();
        } else {
            $id_parametr = "";
        }
        
        $ilosc_postow = count($this->posty);
        
        $this->smarty->assign('ilosc_postow', $ilosc_postow);
        $this->smarty->assign('posty', $this->posty);
        $this->smarty->assign('id_parametr', $id_parametr);
        $this->generujStrone();
    }
    
    private function zmienHasloDoKonta() {
        $user = new Model__User();
        
        $id = $this->parametr;
        $hash_stare = "'" . md5($this->tablica_post['stare_haslo']) . "'";
        
        $user->find(array('id=' => $id, 'hash_haslo=' => $hash_stare));
        
        if($user->getId() != null && $this->tablica_post['nowe_haslo1'] == $this->tablica_post['nowe_haslo2']) {
            $user->setHash_haslo(md5($this->tablica_post['nowe_haslo1']));
            $user->update();
        }
    }
    
    private function pobierzPosty() {
        $user = new Model__User();
        
        $user->find(array('id= ' => $this->parametr));
        
        $this->posty = $user->getPosts();
    }
}
