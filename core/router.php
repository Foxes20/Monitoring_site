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
        $callback = $this->paths[$path][$method];

        if (isset($callback)) {
            call_user_func($callback);
        } else {
            header("HTTP/1.0 404 Not Found");
            $view = new \core\view('404');
            $view->render();
        }
    }
}
