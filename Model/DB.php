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
        
        $this->pdo = new PDO('mysql:host=mysql.cba.pl;dbname=luuuk_cba_pl;', 'lukasz26', 'mamlokus');
        
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
