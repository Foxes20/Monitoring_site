<?php
$url = $_GET['url'];
$path = __DIR__.'/'.'scripts/'.$url.'.php';

// echo $url."<br>";
// echo $path."<br>";

//if (file_exists($path)) {
//    require_once($path);
//} else {
//    require_once('./scripts/error404.php');
//}



    $url = $_GET['url'];
    $path = __DIR__.'/'.'scripts/'.$url.'.php';



spl_autoload_register(function ($className) {
    $path = __DIR__.'/scripts/'.$className.'.php';
    if (file_exists($path)) {
        include ($path);
    }
});


if (class_exists($url)) {
    $o = new $url;
    $o->run();
} else {
    $o = new error404;
    $o->run();
}























