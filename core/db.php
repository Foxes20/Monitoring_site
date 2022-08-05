<?php
namespace core;

class DB {
    public $connect;
    public function __construct()
    {
        $config = include CUR_DIR.'/config.php';

        $this->connect = mysqli_connect($config['database']['servername'], $config['database']['username'], $config['database']['password'], $config['database']['dbname'], $config['database']['port']);
        mysqli_set_charset( $this->connect , "utf8");

        if (! $this->connect) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function escape($value)
    {
        return (mysqli_real_escape_string($this->connect, $value));

    }
}
