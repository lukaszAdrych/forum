<?php

/**
 * Description of Topic
 *
 * Klasa Topic reprezentująca temat w systemie
 */
class Model__Topic extends Model__DB {
    
    /**
     *
     * @var type string 
     */
    private $nazwa;
    
    /**
     *
     * @var type string
     */
    private $status;
    
    /**
     *
     * @var type int
     */
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
        return strip_tags($this->nazwa);
    }

    public function getStatus() {
        return strip_tags($this->status);
    }

    /**
     * Zapisuje obecny obiekt w bazie danych
     */
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
    
    /**
     * Aktualizuje obecny obiekt w bazie danych
     */
    public function update() {
        
        $stmt = $this->pdo->prepare("
                UPDATE topic SET nazwa=:nazwa, status=:status, id_user=:id_user WHERE id = $this->id
                ");
        
        $stmt->bindValue(':nazwa', $this->nazwa, PDO::PARAM_STR);
        $stmt->bindValue(':status', $this->status, PDO::PARAM_STR);  
        $stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);   
        
        $stmt->execute(); 
    }
    
    /**
     * Wyszukuje czy istnieje obiekt o zadanych parametrach w bazie danych
     * @param type $parametry
     * @return boolean
     */
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
            $this->nazwa = strip_tags($topic[0]['nazwa']);
            $this->status = strip_tags($topic[0]['status']);
            $this->id_user = strip_tags($topic[0]['id_user']);
            
            return true;
        }
        return false;
    }
    
    /**
     * Zwraca posty dla obecnego tematu, na podstawie uprawnień użytkownika
     * @param type $status_usera
     * @return array Model_Post
     */
    public function getPosts($status_usera) {
        
        if($status_usera == "moderator") {
            $zapytanie = "SELECT * FROM post WHERE id_topic = $this->id";
        } else {
            $zapytanie = "SELECT * FROM post WHERE id_topic = $this->id AND status = 'aktywny'";
        }
        
        $stmt = $this->pdo->prepare($zapytanie);
        $stmt->execute();
        $posty = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $this->zmienNaObiekty($posty);
    }
    
    /**
     * Zamienia tablicę kluczy, na tablicę z obiektami
     * @param array $posty
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
            
            $user = new Model__User();
            $user->find(array('id= ' => $val['id_user']));
            
            $post->setUser_name(strip_tags($user->getNick()));
            
            
            $tablica_postow[] = $post;
        }
        return $tablica_postow;
    }
}
