<?php
namespace controllers;

class error404
{
    function run()
    {
        header("HTTP/1.0 404 Not Found");
        $view = new \core\view('404');
        $view->render();
    }
}
