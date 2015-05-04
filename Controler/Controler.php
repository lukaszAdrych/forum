<?php
session_start();


/**
 * Description of Controler
 *
 * Klasa Controler z której dziedziczą wszystkie inne kontrolery
 */
abstract class Controler__Controler {
    
    /**
     * Obiekt Smarty który jest przekazywany do widoków
     * @var type Smarty
     */
    protected $smarty;
   
    /**
     * Host na jakim działa obecna strona
     * @var type string
     */
    protected $host;
    
    /**
     * Katalog, na podstawie którego przeprowadzany jest routing
     * @var type string
     */
    protected $katalog;
    
    /**
     *Tablica get
     * @var type array
     */
    protected $tablica_get = array();
    
    /**
     *Tablica post
     * @var type array
     */
    protected $tablica_post = array();
    
    /**
     *Tablica session
     * @var type array
     */
    protected $tablica_session = array();
    
    
    /**
     * Ścieżka do styli
     * @var type string
     */
    protected $sciezka_css = "./../style.css";
    
    /**
     * Zmienna przekazywana do widoków, dzięki której można wyświetlić komunikat o błędzie
     * @var type string
     */
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
        
        if(isset($this->tablica_session['id'])) {
            $id = $this->tablica_session['id'];
        } else {
            $id = "";
        }
        
        if(isset($this->tablica_session['status'])) {
            $czy_mod = $this->tablica_session['status'];
        } else {
            $czy_mod = "";
        }
        
        $this->smarty->assign('zalogowany',$zmienna);
        $this->smarty->assign('id', $id);
        $this->smarty->assign('czy_mod', $czy_mod);
        $this->smarty->assign('czy_blad', $this->czy_blad);
    }
    
    /**
     * Metoda wykonaj, jest uruchamiana zawsze po stworzeniu obeiktu kontrolera
     */
    public function wykonaj()
    {}
    
    /**
     * Metoda generująca stronę
     */
    protected function generujStrone() {
        $this->smarty->display('glowny.tpl');
    }
    
    /**
     * Metoda logująca użytkownika do systemu
     */
    private function zalogujUzytkownika() {
        
        $nick = "'" . addslashes($this->tablica_post['nick']) . "'";
        $haslo = "'" . addslashes(md5($this->tablica_post['haslo'])) . "'";
        
        $user = new Model__User();
        $user->find(array('nick=' => $nick,
            'hash_haslo=' => $haslo,
            'status<>' => "'nowy'",
            ));
            
        if($user->getId() != null) {
            
            $this->tablica_session['zalogowany'] = true;
            $this->tablica_session['user'] = $user->getNick();
            $this->tablica_session['id'] = $user->getId();
            $this->tablica_session['status'] = $user->getStatus();
            $this->czy_blad = false;
            
        } else {
            $this->czy_blad = true;
            //$this->tablica_session['zalogowany'] = false;
        }
        
        
        $this->smarty->assign('user', $user->getNick());
    }
    
    /**
     * Metoda wylogowująca użytkownika z systemu
     */
    private function wylogujUzytkownika() {
        $this->tablica_session['zalogowany'] = false;
        $this->tablica_session['user'] = '';
        $this->tablica_session['id'] = '';
        $this->tablica_session['status'] = '';
    }
    
}
