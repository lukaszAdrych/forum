<?php


error_reporting(E_ALL); // poziom raportowania, http://pl.php.net/manual/pl/function.error-reporting.php
ini_set('display_errors', 1);




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
 
 
 
 
 $route = new Route($_SERVER["REQUEST_URI"], $_SERVER['HTTP_HOST']);
 $route->uruchomController();
 