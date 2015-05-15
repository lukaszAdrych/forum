<?php
session_start();

require 'konfig/baza.php';
require 'autoload.php';


 $route = new Route($_SERVER["REQUEST_URI"]);
 $route->uruchomController();
 