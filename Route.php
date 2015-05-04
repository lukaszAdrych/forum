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
            case "rejestracja":
                $controler = new Controler__Rejestracja($this->katalog);
                $controler->wykonaj();
                
                break;
            case "temat":
                
                $controler = new Controler__Topic($this->katalog, $this->parametr);
                $controler->wykonaj();
                
                break;
            case "konto":
                
                $controler = new Controler__Konto($this->katalog, $this->parametr);
                $controler->wykonaj();
                
                break;
            case "aktywacja":
                
                $controler = new Controler__Aktywacja($this->katalog);
                $controler->wykonaj();
                break;
            
            default :
                $controler = new Controler__Blad($this->katalog);
                $controler->wykonaj();
                break;
            
        }
    }
}
