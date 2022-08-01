<?php

namespace core;

class view {
    public function __construct($view, $name) {
        $this->render($view, $name);
    }
    public function render($view, $name) {
        require_once (CUR_DIR.'/views/'.$view.'.php');
    }
}
