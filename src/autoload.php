<?php 
spl_autoload_register(function($class){
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $className = __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';

    if (file_exists($className) && is_readable($className)) {
        require_once($className);
    }
});
?>