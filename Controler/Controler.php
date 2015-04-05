<?php


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controler
 *
 * @author aich
 */
abstract class Controler__Controler {
    
    protected $smarty;
    
    protected $host;
    
    protected $katalog;
    
    protected $tablica_get = array();
    
    protected $tablica_post = array();
    
    protected $tablica_session = array();
    
    protected $sciezka_css = "./../style.css";


    public function __construct() {
        
        $this->tablica_get = $_GET;
        $this->tablica_post = $_POST;
        $this->tablica_session = &$_SESSION;
        
        $this->smarty = new Smarty;
        
        $this->smarty->template_dir = './Widoki/templates/';
        $this->smarty->compile_dir = './Widoki/templates_c/';
        $this->smarty->assign('katalog', $this->katalog);
        $this->smarty->assign('style', $this->sciezka_css);
    }
    
    public function wykonaj()
    {}
    
    protected function generujStrone() {
        $this->smarty->display('glowny.tpl');
    }
    
}
