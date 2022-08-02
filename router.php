<?php
//$url = $_GET['url'];
$url = getRequestPath();
$class = 'controllers\\' . $url;

if (!class_exists($class)) {
    $class = 'controllers\\error404';
}
$o = new $class;
$o->run();
