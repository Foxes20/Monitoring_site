<?php
namespace core;

class view {
    public $name;
    public $params;

    public function __construct($name, $params=[]) {
        $this->name = $name;
        $this->params = $params;
    }
    public function render() {
        extract( $this->params);
        require_once (CUR_DIR.'/views/'.$this->name.'.php');
    }
}
