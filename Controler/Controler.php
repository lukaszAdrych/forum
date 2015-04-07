<?php
session_start();


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
    
    public $czy_blad;


    public function __construct() {
        
        $this->tablica_get = $_GET;
        $this->tablica_post = $_POST;
        $this->tablica_session = &$_SESSION;
        
        $this->smarty = new Smarty;
        
        $this->smarty->template_dir = './Widoki/templates/';
        $this->smarty->compile_dir = './Widoki/templates_c/';
        $this->smarty->assign('katalog', $this->katalog);
        $this->smarty->assign('style', $this->sciezka_css);
        
        
        if(isset($this->tablica_post['wyloguj'])) {
            $this->wylogujUzytkownika();
        }
        
        if( isset($this->tablica_post['nick'])) {
            var_dump("logowanie");
            $this->zalogujUzytkownika();
        } else {
            if(isset($this->tablica_session['user'])) {
                $this->smarty->assign('user', $this->tablica_session['user']);
            } else {
                //$this->tablica_session['zalogowany'] = false;
            }
            $this->czy_blad = false;
        }
        if(isset($this->tablica_session['zalogowany'])) {
            $zmienna = $this->tablica_session['zalogowany'];
        } else {
            $zmienna = false;
        }
        
        $this->smarty->assign('zalogowany',$zmienna);
        $this->smarty->assign('czy_blad', $this->czy_blad);
    }
    
    public function wykonaj()
    {}
    
    protected function generujStrone() {
        $this->smarty->display('glowny.tpl');
    }
    
    private function zalogujUzytkownika() {
        
        $nick = "'" . $this->tablica_post['nick'] . "'";
        $haslo = "'" . md5($this->tablica_post['haslo']) . "'";
        
        $user = new Model__User();
        $user->find(array('nick=' => $nick,
            'hash_haslo=' => $haslo,
            'status<>' => "'nowy'",
            ));
            
        if($user->getId() != null) {
            
            $this->tablica_session['zalogowany'] = true;
            $this->tablica_session['user'] = $user->getNick();
            $this->czy_blad = false;
            
        } else {
            $this->czy_blad = true;
            //$this->tablica_session['zalogowany'] = false;
        }
        
        
        $this->smarty->assign('user', $user->getNick());
    }
    
    private function wylogujUzytkownika() {
        $this->tablica_session['zalogowany'] = false;
        $this->tablica_session['user'] = '';
    }
    
}
