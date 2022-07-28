<?php
class DB {
    public $conect;
    public $servername = "Localhost";
    public $username   = "service_dev_user";
    public $password   = "bR3gX4uX0jtV2n";
    public $dbname     = "service_dev";

    public function __construct() {
        $this->conect = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
            mysqli_set_charset( $this->conect , "utf8");
            if (! $this->conect) {
                die("Connection failed: " . mysqli_connect_error());
            }
    }
}
