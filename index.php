<?php

error_reporting(0);
ini_set('display_errors', 0); 

session_start();

    require_once "config/Autoloader.php";

    Autoloader::Autoload();

    use config\Routing;

    $route = new Routing();
    $route->get();

