<?php
    spl_autoload_register(function ($className) {
    $path = __DIR__.'/'.str_replace('\\', DIRECTORY_SEPARATOR, $className) .'.php';
        if (file_exists($path)) {
            include ($path);
        }
    });
    spl_autoload_register(function ($className) {
        if ($className == 'SxGeo') {
            require_once './SxGeo/SxGeo.php';
        }
    });