<?php
const CUR_DIR = __DIR__ ;
$url = $_GET['url'];
$path = __DIR__.'/'.'controllers/'.$url.'.php';

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
$class = 'controllers\\' . $url;
if (class_exists($class)) {
    $o = new $class;
    $o->run();
} else {
    $className = new controllers\error404;
    $className->run();
}
