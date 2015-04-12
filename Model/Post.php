<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Post
 *
 * @author aich
 */
class Model__Post extends Model__DB {
    //put your code here
    private $tresc;
    
    private $data;
    
    private $status;
    
    private $id_user;
    
    private $id_topic;
    
    private $user_name;


    public function __construct() {
        $this->table = strtolower(substr(__CLASS__, 7));
        parent::__construct();
    }
    
    public function setTresc($tresc) {
        $this->tresc = $tresc;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setId_user($id_user) {
        $this->id_user = $id_user;
    }

    public function setId_topic($id_topic) {
        $this->id_topic = $id_topic;
    }

    public function getTresc() {
        return $this->tresc;
    }

    public function getData() {
        return $this->data;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getId_user() {
        return $this->id_user;
    }

    public function getId_topic() {
        return $this->id_topic;
    }
    
    public function getUser_name() {
        return $this->user_name;
    }
    
    public function setUser_name($user_name) {
        $this->user_name = $user_name;
    }

    public function save() {
        
        if (strlen($this->tresc) > 0) {
            
            $stmt = $this->pdo->prepare("
                INSERT into post (tresc, data, status, id_user, id_topic)
                VALUES (:tresc, :data, :status, :id_user, :id_topic)"
                );
                
            $stmt->execute(array(':tresc' => $this->tresc,
                ':data' => $this->data,
                ':status' => $this->status,
                ':id_user' => $this->id_user,
                ':id_topic' => $this->id_topic,
                ));  
                     
        }
            
    }
    
    public function update() {
        
        $stmt = $this->pdo->prepare("
                UPDATE post SET tresc=:tresc, data=:data, status=:status,
                id_user=:id_user, id_topic=:id_topic WHERE id = $this->id"
                );
        
        $stmt->bindValue(':tresc', $this->tresc, PDO::PARAM_STR);
        $stmt->bindValue(':data', $this->data, PDO::PARAM_STR);  
        $stmt->bindValue(':status', $this->status, PDO::PARAM_STR);  
        $stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_STR);  
        $stmt->bindValue(':id_topic', $this->id_topic, PDO::PARAM_STR);  
        
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
        
        $post = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($post) == 1) {
            $this->id = $post[0]['id'];
            $this->tresc = $post[0]['tresc'];
            $this->data = $post[0]['data'];
            $this->status = $post[0]['status'];
            $this->id_user = $post[0]['id_user'];
            $this->id_topic = $post[0]['id_topic'];
            
            return true;
        }
        return false;
    }
    
    public function getUser() {
        $user = new Model__User();
        return $user->find($this->id);
    }
    
    public function getTopic() {
        $topic = new Model__Topic();
        return $topic->find($this->id);
    }

}
