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
        
        $dns = $GLOBALS['dns'];
        $user = $GLOBALS['user'];
        $haslo = $GLOBALS['haslo'];
        
        try {
            $this->pdo = new PDO($dns, $user, $haslo);
        } catch (PDOException $ex) {
            //przekierowanie na strone bledu
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
