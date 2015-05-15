<?php

/**
 * Description of User
 *
 * Klasa reprezentująca użytkownika w systemie
 */
class Model__User extends Model__DB {
    
    /**
     *
     * @var type string
     */
    private $nick;
    
    /**
     *
     * @var type string
     */
    private $hash_haslo;
    

    public function __construct() {
        $this->table = strtolower(substr(__CLASS__, 7));
        parent::__construct();
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNick($nick) {
        $this->nick = $nick;
    }


    public function setHash_haslo($hash_haslo) {
        $this->hash_haslo = $hash_haslo;
    }

    public function getId() {
        return $this->id;
    }

    public function getNick() {
        return strip_tags($this->nick);
    }


    public function getHash_haslo() {
        return strip_tags($this->hash_haslo);
    }



    /**
     * Zapisuje obecnego użytkownika w bazie danych
     */
    public function save() {
        
        if (strlen($this->nick) > 0 &&
            strlen($this->hash_haslo) > 0) {
            
            $stmt = $this->pdo->prepare("
                INSERT into user (nick, hash_haslo)
                VALUES (:nick, :hash_haslo)"
                );
            
            $stmt->execute(array(':nick' => $this->nick,
                ':hash_haslo' => $this->hash_haslo,
                ));  
                     
        }
            
    }
    
    /**
     * Aktualizuje dane obecnego użytkownika
     */
    public function update() {
        
        $stmt = $this->pdo->prepare("
                UPDATE user SET nick=:nick, hash_haslo=:hash_haslo,
                WHERE id = $this->id"
                );
        
        $stmt->bindValue(':nick', $this->nick, PDO::PARAM_STR);
        $stmt->bindValue(':hash_haslo', $this->hash_haslo, PDO::PARAM_STR);  

        $stmt->execute(); 
    }
    
    /**
     * Szuka użytkownika na podstawie prarametrów przekazanych do metody
     * @param type $parametry
     * @return boolean
     */
    public function find($parametry) {
        $zapytanie = "SELECT * FROM $this->table WHERE ";
        
        foreach ($parametry as $key => $val) {
            if(isset($key)) {
                
                $zapytanie = $zapytanie . $key . $val . " AND ";
            }
        }
        
        $zapytanie = substr($zapytanie, 0, strlen($zapytanie) - 4);
        $zapytanie = $zapytanie . "LIMIT 1";
        
        $stmt = $this->pdo->prepare($zapytanie);
        $stmt->execute();
        
        $uzytkownik = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($uzytkownik) == 1) {
            $this->id = $uzytkownik[0]['id'];
            $this->nick = strip_tags($uzytkownik[0]['nick']);
            $this->hash_haslo = strip_tags($uzytkownik[0]['hash_haslo']);
            
            return true;
        }
        return false;
    }

    public function getKontakty($wszystkie = false) {

        if($wszystkie == true) {
            $zapytanie = "SELECT * FROM kontakt";
        } else {
            $zapytanie = "SELECT * FROM kontakt WHERE id_user = $this->id";
        }

        $stmt = $this->pdo->prepare($zapytanie);
        $stmt->execute();
        $kontakty = $stmt->fetchAll(PDO::FETCH_ASSOC);


        return $this->zmienNaObiekty($kontakty);
    }

    private function zmienNaObiekty($kontakty) {
        $tablica_kontaktow = array();
        foreach($kontakty as $val) {
            $kontakt = new Model__Kontakt();
            $kontakt->setId($val['id']);
            $kontakt->setImie($val['imie']);
            $kontakt->setNazwisko($val['nazwisko']);
            $kontakt->setEmail($val['email']);
            $kontakt->setTelefon($val['telefon']);
            $kontakt->setDataUrodzenia($val['data_urodzenia']);
            $kontakt->setIdUser($val['id_user']);

            $tablica_kontaktow[] = $kontakt;
        }

        return $tablica_kontaktow;
    }


}
