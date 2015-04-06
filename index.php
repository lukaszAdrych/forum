<?php
session_start();

var_dump($_SESSION);


function __autoload( $classname ) {
    
    if ($classname == "Smarty") {
        require('./Smarty/Smarty.class.php');
    } else if(substr($classname, 0, 6) == "Smarty") {
        require('./Smarty/sysplugins/' . strtolower($classname) . '.php');
    } else {
        
        $classname = str_replace( '__', DIRECTORY_SEPARATOR, $classname );
        require_once( $classname . '.php' );
    }
 }
 
 
 
 
 $route = new Route($_SERVER["REQUEST_URI"]);
 $route->uruchomController();
 