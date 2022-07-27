<?php

$url = $_GET['url'];

$path = __DIR__.'/'.'scripts/'.$url.'.php';

// echo $url."<br>";
// echo $path."<br>";

if (file_exists($path)) {

    require_once(__DIR__.'/'.'scripts/'.$url.'.php');

} else {
    require_once('./scripts/error404.php');
}

