<?php

error_reporting(E_ALL); // poziom raportowania, http://pl.php.net/manual/pl/function.error-reporting.php
ini_set('display_errors', 1);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author aich
 */
class Model__User extends Model__DB {
    
    private $nick;
    
    private $email;
    
    private $hash_haslo;
    
    private $kod_aktywacja;
    
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
        return $this->nick;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getHash_haslo() {
        return $this->hash_haslo;
    }

    public function getKod_aktywacja() {
        return $this->kod_aktywacja;
    }

    public function getStatus() {
        return $this->status;
    }

    public function zwrocUsera() {
        foreach ($this->pdo->query('SELECT * FROM user') as $row)
     {
     print_r($row);
     }
    }
    
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
            $this->nick = $uzytkownik[0]['nick'];
            $this->email = $uzytkownik[0]['email'];
            $this->hash_haslo = $uzytkownik[0]['hash_haslo'];
            $this->kod_aktywacja = $uzytkownik[0]['kod_aktywacja'];
            $this->status = $uzytkownik[0]['status'];
            
            return true;
        }
        return false;
    }
    
    public function getPosts() {
        
        $stmt = $this->pdo->prepare("SELECT * FROM post WHERE id_user = $this->id");
        $stmt->execute();
        
        $posty = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $this->zmienNaObiekty($posty);
    }
    
    private function zmienNaObiekty($posty) {
        $tablica_postow = array();
        foreach ($posty as $val) {
            $post = new Model__Post();
            $post->setId($val['id']);
            $post->setTresc($val['tresc']);
            $post->setData($val['data']);
            $post->setStatus($val['status']);
            $post->setId_user($val['id_user']);
            $post->setId_topic($val['id_topic']);
            
            $tablica_postow[] = $post;
        }
        return $tablica_postow;
    }

}
