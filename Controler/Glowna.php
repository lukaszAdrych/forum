<?php

/**
 * Description of Glowna
 *
 * Kontroler odpowiedzialny za działanie strony głównej systemu
 */
class Controler__Glowna extends Controler__Controler {
    
    
    public function __construct($katalog) {  
        
        $this->katalog = $katalog;
        $this->sciezka_css = "style.css";
        parent::__construct(); 
    }
    
    public function wykonaj() {
        
        if(isset($this->tablica_post['nazwa_tematu'])) {
            $this->dodajNowyTemat(addslashes($this->tablica_post['nazwa_tematu']));
        }
        
        if(isset($this->tablica_post['id_topic'])) {
            $this->aktualizujTemat();
        }
        
        
        $this->pobierzTematy();
        $this->wyswietlDanePortal();
        $this->generujStrone();
    }
    
    /**
     * Pobiera tematy z bazy do wyświetlenia
     */
    private function pobierzTematy() {
        $portal = new Model__Portal();
        $portal->getPortal();
        
        if(isset($this->tablica_session['status'])) {
            if($this->tablica_session['status'] == 'moderator') {
                $tematy = $portal->getTopics();
            } else {
                $tematy = $portal->getTopics(array('status' => 'aktywny'));
            }
        } else {
            $tematy = $portal->getTopics(array('status' => 'aktywny'));
        }
        
        
        $this->smarty->assign('tematy', $tematy);
        
    }
    
    /**
     * Dodaje nowy temat do portalu
     * @param string $nazwa_tematu
     */
    private function dodajNowyTemat($nazwa_tematu) {
        
        $nowy_temat = new Model__Topic();
        $nowy_temat->setNazwa($nazwa_tematu);
        $nowy_temat->setId_user($this->tablica_session['id']);
        $nowy_temat->setStatus('aktywny');
        $nowy_temat->save();
        
        $portal = new Model__Portal();
        $portal->getPortal();
        $portal->dodajTemat();
        $portal->update();
    }
    
    /**
     * Zmienia status tematu, na przekazany w tablicy post
     */
    private function aktualizujTemat() {
        if((int)$this->tablica_post['id_topic']) {
            $temat = new Model__Topic();
            $temat->find(array('id' => $this->tablica_post['id_topic']));
            
            $temat->setStatus($this->tablica_post['status_temat']);
            $temat->update();
        }
    }
    
    /**
     * Pobiera dane dotyczące portalu
     */
    private function wyswietlDanePortal() {
        $portal = new Model__Portal();
        $portal->getPortal();
        $this->smarty->assign('portal', $portal);
    }
}
