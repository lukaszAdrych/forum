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


    public function __construct() {
        $this->smarty = new Smarty;
        
        $this->smarty->template_dir = './Widoki/templates/';
        $this->smarty->compile_dir = './Widoki/templates_c/';
    }
    
    public function wykonaj()
    {}
    
}
