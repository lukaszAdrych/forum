<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Portal
 *
 * @author aich
 */
class Model__Portal extends Model__DB {
    
    private $ilosc_postow;
    
    private $ilosc_tematow;
    
    private $ilosc_uzytkownikow;
    
    public function __construct() {
        $this->table = strtolower(substr(__CLASS__, 7));
        parent::__construct();
    }
    
    public function setIlosc_postow($ilosc_postow) {
        $this->ilosc_postow = $ilosc_postow;
    }

    public function setIlosc_tematow($ilosc_tematow) {
        $this->ilosc_tematow = $ilosc_tematow;
    }

    public function setIlosc_uzytkownikow($ilosc_uzytkownikow) {
        $this->ilosc_uzytkownikow = $ilosc_uzytkownikow;
    }

    public function getIlosc_postow() {
        return $this->ilosc_postow;
    }

    public function getIlosc_tematow() {
        return $this->ilosc_tematow;
    }

    public function getIlosc_uzytkownikow() {
        return $this->ilosc_uzytkownikow;
    }
    
    public function save() {
        
       
            $stmt = $this->pdo->prepare("
                INSERT into post (ilosc_postow, ilosc_tematow, ilosc_uzytkownikow)
                VALUES (:ilosc_postow, :ilosc_tematow, :ilosc_uzytkownikow)"
                );
            
            $stmt->execute(array(':ilosc_postow' => $this->ilosc_postow,
                ':ilosc_tematow' => $this->ilosc_tematow,
                ':ilosc_uzytkownikow' => $this->ilosc_uzytkownikow,
                ));  
                       
    }
    
    public function update() {
        
        $stmt = $this->pdo->prepare("
                UPDATE portal SET ilosc_postow=:ilosc_postow, ilosc_tematow=:ilosc_tematow,
                ilosc_uzytkownikow=:ilosc_uzytkownikow WHERE id = $this->id"
                );
        
        $stmt->bindValue(':ilosc_postow', $this->ilosc_postow, PDO::PARAM_STR);
        $stmt->bindValue(':ilosc_tematow', $this->ilosc_tematow, PDO::PARAM_STR);  
        $stmt->bindValue(':ilosc_uzytkownikow', $this->ilosc_uzytkownikow, PDO::PARAM_STR);    
        
        $stmt->execute(); 
    }
    
    public function getPortal() {
        $stmt = $this->pdo->prepare("SELECT * FROM portal LIMIT 1");
        $stmt->execute();
        
        $portal = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $this->id = $portal[0]['id'];
        $this->ilosc_postow = $portal[0]['ilosc_postow'];
        $this->ilosc_tematow = $portal[0]['ilosc_tematow'];
        $this->ilosc_uzytkownikow = $portal[0]['ilosc_uzytkownikow'];
    }
    
    public function getTopics($parametry) {
        $zapytanie = "SELECT * FROM topic WHERE ";
        
        foreach ($parametry as $key => $val) {
            if(isset($key)) {
                
                $zapytanie = $zapytanie . $key . "= '" . $val . "' AND ";
            }
        }
        
        $zapytanie = substr($zapytanie, 0, strlen($zapytanie) - 4);
        
        $stmt = $this->pdo->prepare($zapytanie);
        $stmt->execute();
        
        $tematy = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $this->zmienNaObiekty($tematy);
    }
    
    private function zmienNaObiekty($tematy) {
        $tablica_tematow = array();
        foreach ($tematy as $val) {
            $temat = new Model__Topic();
            $temat->setId($val['id']);
            $temat->setNazwa($val['nazwa']);
            $temat->setStatus($val['status']);
            $temat->setId_user($val['id_user']);
            
            $tablica_tematow[] = $temat;
        }
        return $tablica_tematow;
    }


}
