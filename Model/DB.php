<?php

require 'konfig/baza.php';
/**
 * Description of DB
 *
 * @author aich
 */



abstract class Model__DB {
    
    protected $id;
    
    protected $pdo;
    
    protected $table;



    public function __construct() {
        
        $host = $GLOBALS['host'];
        $nazwa_bazy = $GLOBALS['nazwa_bazy'];
        $user = $GLOBALS['user'];
        $haslo = $GLOBALS['haslo'];
        
        $dns = 'mysql:host=' . $host . ';dbname=' . $nazwa_bazy . ';';
        
        try {
            $this->pdo = new PDO($dns, $user, $haslo);
        } catch (PDOException $ex) {
            //przekierowanie na strone bledu
            //echo 'trzeba naprawic' . $ex->getMessage();
            header('Location: /blad');
        }
        
        
    }
    
    public function delete() {
        $stmt = $this->pdo->prepare("DELETE FROM $this->table WHERE id = $this->id");
        $stmt->execute();
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    public function getId() {
        return $this->id;
    }
}
