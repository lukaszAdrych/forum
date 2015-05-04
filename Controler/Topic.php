<?php


/**
 * Description of Topic
 *
 * Kontroler Topic uruchamiany podczas wyświetlania postów w konkretnym temacie
 */
class Controler__Topic extends Controler__Controler {
    
    /**
     * Parametr określa id tematu dla któego mają być pobrane posty
     * @var type int
     */
    private $parametr;

    public function __construct($katalog, $parametr) {  
        
        $this->parametr = (int)$parametr;
        $this->katalog = $katalog;
        parent::__construct(); 
        
    }
    
    public function wykonaj() {
       
        if(isset($this->tablica_post['tresc_postu'])) {
            $this->dodajNowyPost(addslashes($this->tablica_post['tresc_postu']));
        }
        
        if(isset($this->tablica_post['id_post'])) {
            $this->aktualizujPost();
        }
        
        $this->pobierzPosty();
        $this->generujStrone();
    }
    /**
     * Funkcja pobierająca posty na podstawie zadanego parametru
     */
    private function pobierzPosty() {
        
        if(is_int($this->parametr)) {
            
            if(isset($this->tablica_session['status'])) {
                if($this->tablica_session['status'] == 'moderator') {
                    $status_usera = 'moderator';
                } else {
                    $status_usera = "";
                }
            } else {
                $status_usera = "";
            }
            
            $temat = new Model__Topic();       
            
            if($status_usera == 'moderator') {
                $temat->find(array('id' => $this->parametr,));
            } else {
                $temat->find(array('id' => $this->parametr, 'status' => "'aktywny'",));
            }
            
            
            if($temat->getId() == null) {
                
                header('Location: /blad');
            }
            
            $posty = $temat->getPosts($status_usera);
            $this->smarty->assign('nazwa_tematu', $temat->getNazwa());
            $this->smarty->assign('posty', $posty);
            
        } else {
            //zrobic przekierowanie na blad
            header('Location: /blad');
        }
    }
    
    /**
     * Dodaje nowy post do serwisu zgodny z parametrem treść
     * @param string $tresc
     */
    private function dodajNowyPost($tresc) {
        $post = new Model__Post();
        $post->setTresc($tresc);
        $post->setData(date("Y-m-d H:i:s"));
        $post->setStatus("aktywny");
        $post->setId_topic($this->parametr);
        $post->setId_user($this->tablica_session['id']);
        
        $post->save();
        
        $portal = new Model__Portal();
        $portal->getPortal();
        $portal->dodajPost();
        $portal->update();
    }
    
    /**
     * Aktualizuje status postu
     */
    private function aktualizujPost() {
        
        if((int)$this->tablica_post['id_post']) {
            $post = new Model__Post();
            $post->find(array('id' => $this->tablica_post['id_post']));
            
            $post->setStatus(addslashes($this->tablica_post['status_post']));
            
            $post->update();
        }
    }
}
