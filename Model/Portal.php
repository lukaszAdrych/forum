<?php


/**
 * Description of Portal
 *
 * Klasa modelu Model_Portal reprezentująca Portal w systemie
 */
class Model__Portal extends Model__DB {
    
    /**
     * Ilość postó w systemi
     * @var type int
     */
    private $ilosc_postow;
    
    /**
     * Ilość tematów w systemie
     * @var type int
     */
    private $ilosc_tematow;
    
    /**
     * Ilość użytkowników w systemie
     * @var type int
     */
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
        return strip_tags($this->ilosc_postow);
    }

    public function getIlosc_tematow() {
        return strip_tags($this->ilosc_tematow);
    }

    public function getIlosc_uzytkownikow() {
        return strip_tags($this->ilosc_uzytkownikow);
    }
    
    /**
     * Inkrementuje ilość postów w serwisie
     */
    public function dodajPost() {
        $this->ilosc_postow++;
    }
    
    /**
     * Inkrementuje ilość tematów w serwisie
     */
    public function dodajTemat() {
        $this->ilosc_tematow++;
    }
    
    /**
     * Inkrementuje ilość użytkowników w serwisie
     */
    public function dodajUzytkownika() {
        $this->ilosc_uzytkownikow++;
    }

    /**
     * Zapisuje nowo utworzony obiekt do bazy danych
     */
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
    
    /**
     * Aktualizuje obiekt w bazie danych
     */
    public function update() {
        
        $stmt = $this->pdo->prepare("
                UPDATE portal SET ilosc_postow=:ilosc_postow, ilosc_tematow=:ilosc_tematow,
                ilosc_uzytkownikow=:ilosc_uzytkownikow WHERE id = $this->id"
                );
        
        $stmt->bindValue(':ilosc_postow', $this->ilosc_postow, PDO::PARAM_INT);
        $stmt->bindValue(':ilosc_tematow', $this->ilosc_tematow, PDO::PARAM_INT);  
        $stmt->bindValue(':ilosc_uzytkownikow', $this->ilosc_uzytkownikow, PDO::PARAM_INT);    
        
        $stmt->execute(); 
    }
    
    /**
     * Pobiera dane do obiektu z bazy danych
     */
    public function getPortal() {
        $stmt = $this->pdo->prepare("SELECT * FROM portal LIMIT 1");
        $stmt->execute();
        
        $portal = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $this->id = $portal[0]['id'];
        $this->ilosc_postow = $portal[0]['ilosc_postow'];
        $this->ilosc_tematow = $portal[0]['ilosc_tematow'];
        $this->ilosc_uzytkownikow = $portal[0]['ilosc_uzytkownikow'];
    }
    
    /**
     * Zwraca tematy na podstawie parametrów przekazanych w tablicy
     * @param array $parametry 
     * @return type array Model_Topic object
     */
    public function getTopics($parametry = array()) {
        $zapytanie = "SELECT * FROM topic WHERE ";
        
        foreach ($parametry as $key => $val) {
            if(isset($key)) {
                
                $zapytanie = $zapytanie . $key . "= '" . $val . "' AND ";
            }
        }
        if(strlen($zapytanie) == 22) {
            $zapytanie = substr($zapytanie, 0, strlen($zapytanie) - 3);
        }
        $zapytanie = substr($zapytanie, 0, strlen($zapytanie) - 4);
        
        $stmt = $this->pdo->prepare($zapytanie);
        $stmt->execute();
        
        $tematy = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $this->zmienNaObiekty($tematy);
    }
    
    /**
     * Zamienia tablicę z kluczami na tablicę obiektów
     * @param array $tematy
     * @return \Model__Topic
     */
    private function zmienNaObiekty($tematy) {
        $tablica_tematow = array();
        foreach ($tematy as $val) {
            $temat = new Model__Topic();
            $temat->setId($val['id']);
            $temat->setNazwa(strip_tags($val['nazwa']));
            $temat->setStatus(strip_tags($val['status']));
            $temat->setId_user(strip_tags($val['id_user']));
            
            $tablica_tematow[] = $temat;
        }
        return $tablica_tematow;
    }


}
