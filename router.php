<?php
$url = $_GET['url'];
$class = 'controllers\\' . $url;

if (!class_exists($class)) {
    $class = 'controllers\\error404';
}
$o = new $class;
$o->run();