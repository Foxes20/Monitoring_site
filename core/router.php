<?php
namespace core;

class router
{
    public $paths = [];

    public function get($path, $callback)
    {
        $this->paths[$path]['GET'] = $callback;
    }

    public function post($path, $callback)
    {
        $this->paths[$path]['POST'] = $callback;
    }

    public function resolve()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = getRequestPath();

//var_dump($this->paths[$path][$method]);


        if (isset($this->paths[$path][$method])) {
            call_user_func($this->paths[$path][$method]);
            return;
        } else {
            header("HTTP/1.0 404 Not Found");
            $view = new \core\view('404');
            $view->render();
        }
    }
}
