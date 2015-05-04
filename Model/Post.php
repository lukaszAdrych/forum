<?php


/**
 * Description of Post
 *
 * Klasa reprezentująca Post
 */
class Model__Post extends Model__DB {
    
    /**
     *
     * @var type string
     */
    private $tresc;
    
    /**
     *
     * @var type date
     */
    private $data;
    
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
    
    /**
     *
     * @var type int
     */
    private $id_topic;
    
    /**
     *
     * @var type string
     */
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
        return strip_tags($this->tresc);
    }

    public function getData() {
        return strip_tags($this->data);
    }

    public function getStatus() {
        return strip_tags($this->status);
    }

    public function getId_user() {
        return $this->id_user;
    }

    public function getId_topic() {
        return $this->id_topic;
    }
    
    public function getUser_name() {
        return strip_tags($this->user_name);
    }
    
    public function setUser_name($user_name) {
        $this->user_name = $user_name;
    }

    /**
     * Zapisuje obecny obiekt do bazy danych
     */
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
    
    /**
     * Aktualizuje obiekt w bazie danych
     */
    public function update() {
        
        $stmt = $this->pdo->prepare("
                UPDATE post SET tresc=:tresc, data=:data, status=:status,
                id_user=:id_user, id_topic=:id_topic WHERE id = $this->id"
                );
        
        $stmt->bindValue(':tresc', $this->tresc, PDO::PARAM_STR);
        $stmt->bindValue(':data', $this->data, PDO::PARAM_STR);  
        $stmt->bindValue(':status', $this->status, PDO::PARAM_STR);  
        $stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);  
        $stmt->bindValue(':id_topic', $this->id_topic, PDO::PARAM_INT);  
        
        $stmt->execute(); 
    }
    
    /**
     * Szuka na podstawie parametrów obiektu w bazie danych
     * @param array $parametry
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
        
        $post = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($post) == 1) {
            $this->id = $post[0]['id'];
            $this->tresc = strip_tags($post[0]['tresc']);
            $this->data = strip_tags($post[0]['data']);
            $this->status = strip_tags($post[0]['status']);
            $this->id_user = strip_tags($post[0]['id_user']);
            $this->id_topic = strip_tags($post[0]['id_topic']);
            
            return true;
        }
        return false;
    }
    
    /**
     * Zwaraca osobę która napisała post
     * @return Model__User
     */
    public function getUser() {
        $user = new Model__User();
        return $user->find($this->id);
    }
    
    /**
     * Zwraca temat w którym został napisany post
     * @return Model__Topic
     */
    public function getTopic() {
        $topic = new Model__Topic();
        return $topic->find($this->id);
    }

}
