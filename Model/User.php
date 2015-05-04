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
    private $email;
    
    /**
     *
     * @var type string
     */
    private $hash_haslo;
    
    /**
     *
     * @var type string
     */
    private $kod_aktywacja;
    
    /**
     *
     * @var type string
     */
    private $status;
    
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

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setHash_haslo($hash_haslo) {
        $this->hash_haslo = $hash_haslo;
    }

    public function setKod_aktywacja($kod_aktywacja) {
        $this->kod_aktywacja = $kod_aktywacja;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
    public function getId() {
        return $this->id;
    }

    public function getNick() {
        return strip_tags($this->nick);
    }

    public function getEmail() {
        return strip_tags($this->email);
    }

    public function getHash_haslo() {
        return strip_tags($this->hash_haslo);
    }

    public function getKod_aktywacja() {
        return strip_tags($this->kod_aktywacja);
    }

    public function getStatus() {
        return strip_tags($this->status);
    }

    /**
     * Zapisuje obecnego użytkownika w bazie danych
     */
    public function save() {
        
        if (strlen($this->nick) > 0 &&
            strlen($this->email) > 0 &&
            strlen($this->hash_haslo) > 0) {
            
            $stmt = $this->pdo->prepare("
                INSERT into user (nick, email, hash_haslo, kod_aktywacja, status)
                VALUES (:nick, :email, :hash_haslo, :kod_aktywacja, :status)"
                );
            
            $stmt->execute(array(':nick' => $this->nick,
                ':email' => $this->email,
                ':hash_haslo' => $this->hash_haslo,
                ':kod_aktywacja' => $this->kod_aktywacja,
                ':status' => $this->status,
                ));  
                     
        }
            
    }
    
    /**
     * Aktualizuje dane obecnego użytkownika
     */
    public function update() {
        
        $stmt = $this->pdo->prepare("
                UPDATE user SET nick=:nick, email=:email, hash_haslo=:hash_haslo,
                kod_aktywacja=:kod_aktywacja, status=:status WHERE id = $this->id"
                );
        
        $stmt->bindValue(':nick', $this->nick, PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);  
        $stmt->bindValue(':hash_haslo', $this->hash_haslo, PDO::PARAM_STR);  
        $stmt->bindValue(':kod_aktywacja', $this->kod_aktywacja, PDO::PARAM_STR);  
        $stmt->bindValue(':status', $this->status, PDO::PARAM_STR);  
        
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
            $this->email = strip_tags($uzytkownik[0]['email']);
            $this->hash_haslo = strip_tags($uzytkownik[0]['hash_haslo']);
            $this->kod_aktywacja = strip_tags($uzytkownik[0]['kod_aktywacja']);
            $this->status = strip_tags($uzytkownik[0]['status']);
            
            return true;
        }
        return false;
    }
    
    /**
     * Zwraca posty aktualnego użytkownika
     * @return type array Model_Post
     */
    public function getPosts() {
        
        $stmt = $this->pdo->prepare("SELECT * FROM post WHERE id_user = $this->id");
        $stmt->execute();
        
        $posty = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $this->zmienNaObiekty($posty);
    }
    
    /**
     * Zamienia tablicę z kluczami na tablicę obeiktów
     * @param type $posty
     * @return \Model__Post
     */
    private function zmienNaObiekty($posty) {
        $tablica_postow = array();
        foreach ($posty as $val) {
            $post = new Model__Post();
            $post->setId($val['id']);
            $post->setTresc(strip_tags($val['tresc']));
            $post->setData(strip_tags($val['data']));
            $post->setStatus(strip_tags($val['status']));
            $post->setId_user(strip_tags($val['id_user']));
            $post->setId_topic(strip_tags($val['id_topic']));
            
            $tablica_postow[] = $post;
        }
        return $tablica_postow;
    }

}
