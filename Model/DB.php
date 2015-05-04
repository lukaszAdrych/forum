<?php

require 'konfig/baza.php';
/**
 * Description of DB
 *
 * Główna klasa modelu, z której dziedziczą wszystkie nowo stworzone modele
 */

abstract class Model__DB {
    /**
     * Id nowego obiektu
     * @var int $id 
     */
    protected $id;
    
    /**
     * Uchwyt do połączenia z bazą danych
     * @var type PDO
     */
    protected $pdo;
    
    /**
     * Nazwa tabeli dla której jest stworzony obiekt klasy dziedziczącej
     * @var type string
     */
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
            header('Location: /blad');
        }
        
    }
    
    /**
     * Metoda usuwa dany obiekt z bazy danych
     */
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
