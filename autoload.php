<?php


spl_autoload_register(function ($class) {
   
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $file = ROOT . (!empty($file) ? '' : DIRECTORY_SEPARATOR) . $file . '.php';

    if (file_exists($file)) {
        require_once $file;
    }

});
