<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

spl_autoload_register(function ($className) {
    $classpath = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    require_once($classpath . '.php');
});

require_once 'Application/bootstrap.php';
