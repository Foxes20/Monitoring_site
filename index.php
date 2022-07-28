<?php
$url = $_GET['url'];
$path = __DIR__.'/'.'scripts/'.$url.'.php';

spl_autoload_register(function ($className) {
    $path = __DIR__.'/scripts/'.$className.'.php';
    if (file_exists($path)) {
        include ($path);
    }

});

spl_autoload_register(function ($className) {
    if ($className == 'SxGeo') {
        require_once './SxGeo/SxGeo.php';
    }
});

if (class_exists($url)) {
    $o = new $url;
    $o->run();
} else {
    $o = new error404;
    $o->run();
}

