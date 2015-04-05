<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Topic
 *
 * @author aich
 */
class Controler__Topic extends Controler__Controler {
    
    private $parametr;

    public function __construct($katalog, $parametr) {  
        
        $this->parametr = (int)$parametr;
        $this->katalog = $katalog;
        parent::__construct(); 
        
    }
    
    public function wykonaj() {
       
        if(isset($this->tablica_post['tresc_postu'])) {
            $this->dodajNowyPost($this->tablica_post['tresc_postu']);
        }
        $this->pobierzPosty();
        $this->generujStrone();
    }
    
    private function pobierzPosty() {
        
        if(is_int($this->parametr)) {
            
            $temat = new Model__Topic();
            $temat->find(array('id' => $this->parametr));
            
            $posty = $temat->getPosts();
            $this->smarty->assign('posty', $posty);
            
        } else {
            //zrobic przekierowanie na blad
            var_dump("jestesmy w bledzie z parametrem");
        }
    }
    
    private function dodajNowyPost($tresc) {
        $post = new Model__Post();
        $post->setTresc($tresc);
        $post->setData(date("Y-m-d H:i:s"));
        $post->setStatus("aktywny");
        $post->setId_topic($this->parametr);
        $post->setId_user(1);
        
        $post->save();
    }
}
