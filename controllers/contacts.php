<?php
namespace controllers;

class contacts {
    public function run() {


        $view = new \core\view('contact');
        $view->render();
    }
}
