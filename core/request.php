<?php
namespace core;

class request
{
    public array $get;
    public array $post;
    public array $session;

    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->session = $_SESSION;
    }
    public function get(string $key)
    {
        return $this->get[$key] ?? null;
    }
    public function post(string $key)
    {
        return $this->post[$key] ?? null;
    }
    public function session(string $key)
    {
        return $this->session[$key] ?? null;
    }
}
