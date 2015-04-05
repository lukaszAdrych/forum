<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Topic
 *
 * @author aich
 */
class Model__Topic extends Model__DB {
    //put your code here
    private $nazwa;
    
    private $status;
    
    private $id_user;
    
    public function __construct() {
        $this->table = strtolower(substr(__CLASS__, 7));
        parent::__construct();
    }
    
    public function setNazwa($nazwa) {
        $this->nazwa = $nazwa;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
    
    public function setId_user($id_user) {
        $this->id_user = $id_user;
    }
    public function getId_user() {
        return $this->id_user;
    }    
    
    public function getNazwa() {
        return $this->nazwa;
    }

    public function getStatus() {
        return $this->status;
    }

    public function save() {
        
        if (strlen($this->nazwa) > 0) {
            
            $stmt = $this->pdo->prepare("
                INSERT into topic (nazwa, status, id_user)
                VALUES (:nazwa, :status, :id_user)"
                );
            
            $stmt->execute(array(':nazwa' => $this->nazwa,
                ':status' => $this->status,
                ':id_user' => $this->id_user,
                ));  
                     
        }
            
    }
    
    public function update() {
        
        $stmt = $this->pdo->prepare("
                UPDATE topic SET nazwa=:nazwa, status=:status, id_user=:id_user WHERE id = $this->id
                ");
        
        $stmt->bindValue(':nazwa', $this->nazwa, PDO::PARAM_STR);
        $stmt->bindValue(':status', $this->status, PDO::PARAM_STR);  
        $stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_STR);   
        
        $stmt->execute(); 
    }
    
    public function find($parametry) {
        $zapytanie = "SELECT * FROM $this->table WHERE ";
        
        foreach ($parametry as $key => $val) {
            if(isset($key)) {
                
                $zapytanie = $zapytanie . $key . "=" . $val . " AND ";
            }
        }
        
        $zapytanie = substr($zapytanie, 0, strlen($zapytanie) - 4);
        $zapytanie = $zapytanie . "LIMIT 1";
        
        $stmt = $this->pdo->prepare($zapytanie);
        $stmt->execute();
        
        $topic = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($topic) == 1) {
            $this->id = $topic[0]['id'];
            $this->nick = $topic[0]['nazwa'];
            $this->email = $topic[0]['status'];
            $this->hash_haslo = $topic[0]['id_user'];
            
            return true;
        }
        return false;
    }
    
    public function getPosts() {
        
        $stmt = $this->pdo->prepare("SELECT * FROM post WHERE id_topic = $this->id");
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
