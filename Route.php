<?php



/**
 * Description of Route
 *
 * Klasa Route jest odpowiedzialna za routing w systemie
 */
class Route {
    
    /**
     *Pierwszy człon adresu url, określa w jakiej części systemu jesteśmy
     * @var type string
     */
    private $katalog;
    
    /**
     * Parametr wykorzystywany przy niektórych modułach
     * @var type int
     */
    private $parametr;
    


    public function __construct($uri) {
        $tab = explode('/', $uri);
        
        $this->katalog = $tab[1];
        if(isset($tab[2])) {
            $this->parametr = $tab[2];
        }
        
    }
    
    /**
     * Metoda określa który kontroler ma zostać wywołany
     */
    public function uruchomController() {

        switch ($this->katalog) {
            case "":
                $controler = new Controler__Glowna($this->katalog);
                $controler->wykonaj();
                
                break;
            case "dodaj":
                $controler = new Controler__Dodaj($this->katalog);
                $controler->wykonaj();
                
                break;
            case "edytuj":
                
                $controler = new Controler__Edytuj($this->katalog, $this->parametr);
                $controler->wykonaj();
                
                break;

            
            default :
                $controler = new Controler__Blad($this->katalog);
                $controler->wykonaj();
                break;
            
        }
    }
}
